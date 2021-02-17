<?php
namespace App\Repositories\produccion\pedidoActivo;
// Models
use App\Models\Pedido;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoActivoRepositories implements PedidoActivoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getPagination($request, $relaciones, $opc_consulta) {
    if($request->paginador == null) {
      $paginador = 50;
    }else {
      $paginador = $request->paginador;
    }
    return Pedido::pendientesPedido($opc_consulta)
      ->with($relaciones)
      ->where('estat_produc', '!=', config('app.en_almacen_de_salida_terminado'))
      /*
      ->where(function ($query) {
        $query->where('estat_produc', config('app.asignar_lider_de_pedido'))
        ->orWhere('estat_produc', config('app.en_espera_de_almacen'))
        ->orWhere('estat_produc', config('app.productos_completos'))
        ->orWhere('estat_produc', config('app.en_produccion'));
      })
      */
      ->buscar($request->opcion_buscador, $request->buscador)
      ->orderBy('fech_estat_produc', 'DESC')
      ->paginate($paginador);
  }
  public function pedidoActivoProduccionFindOrFailById($id_pedido, $relaciones, $accion) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $consulta = Pedido::with($relaciones);
    
    if($accion == 'edit') {
      $consulta->where(function ($query) {
        $query->where('estat_produc', config('app.asignar_lider_de_pedido'))
          ->orWhere('estat_produc', config('app.en_espera_de_almacen'))
          ->orWhere('estat_produc', config('app.productos_completos'))
          ->orWhere('estat_produc', config('app.en_produccion'));
      });
    }
   
    return $consulta->findOrFail($id_pedido);
  }
  public function update($request, $id_pedido) {
    try { DB::beginTransaction();
      $pedido                    = $this->pedidoActivoProduccionFindOrFailById($id_pedido, [], 'edit');
      $pedido->lid_de_ped_produc = $request->lider_de_pedido_produccion;
      $pedido->bod               = $request->bodega_donde_se_armara;
      $pedido->coment_produc     = $request->comentario_produccion;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Producción (Pedidos activos)', // Módulo
          'produccion.pedidoActivo.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Líder de pedido producción', 'Bodega donde se armara', 'Comentario producción'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('lid_de_ped_produc', 'bod', 'coment_produc') // Nombre de los campos en la BD
        );
        $pedido->updated_at_ped = Auth::user()->email_registro;
      }
      $pedido->save();
      Pedido::getEstatusPedido($pedido, 'Todos');

      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
  public function getPendientes() {
    $fecha = date("Y-m-d");
    $mas_dia = date("Y-m-d", strtotime('+3 day', strtotime(date("Y-m-d"))));
    $menos_un_dia = date("Y-m-d", strtotime('-1 day', strtotime(date("Y-m-d"))));
    $menos_dia = date("Y-m-d", strtotime('-5 day', strtotime(date("Y-m-d"))));
    $nom_tabla = (new \App\Models\Pedido())->getTable();
    
    $consulta = DB::table('pedidos')->select(
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (fech_de_entreg BETWEEN '$fecha' AND '$mas_dia')) as porEntregar"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (fech_de_entreg BETWEEN '$menos_dia' AND '$menos_un_dia')) as yaCaducados"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (estat_pag != '".config('app.pagado')."')) as pteDePago"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (estat_pag = '".config('app.pago_rechazado')."')) as pagoRechazado"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (urg = '".config('opcionesSelect.es_pedido_urgente.Si')."')) as urgente")
    )->first();
    if($consulta == null) { 
      $consulta = (object) array('porEntregar' => 0, 'yaCaducados' => 0, 'pteDePago' => 0, 'pagoRechazado' => 0, 'urgente' => 0);
    }

    return $consulta; 
  }
}