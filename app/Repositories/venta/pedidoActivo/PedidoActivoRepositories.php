<?php
namespace App\Repositories\venta\pedidoActivo;
// Models
use App\Models\Pedido;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoActivoRepositories implements PedidoActivoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  } 
  public function pedidoAsignadoFindOrFailById($id_pedido, $relaciones) { // 'usuario', 'unificar', 'armados', 'pago'
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)->where('estat_log', '!=', config('app.entregado'))->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones, $opc_consulta) { // 'usuario', 'unificar'
    return Pedido::pendientesPedido($opc_consulta)
                  ->Where('estat_log', '!=', config('app.entregado'))
                  ->with($relaciones)
                  ->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)
                  ->buscar($request->opcion_buscador, $request->buscador)
                  ->orderBy('id', 'DESC')
                  ->paginate($request->paginador);
  }
  public function update($request, $id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoAsignadoFindOrFailById($id_pedido, ['armados']);
      $pedido->fech_de_entreg     = $request->fecha_de_entrega;
      $pedido->se_pued_entreg_ant = $request->se_puede_entregar_antes;
      if($pedido->se_pued_entreg_ant == 'Si') {
        $pedido->cuant_dia_ant    = $request->cuantos_dias_antes;
      } elseif($pedido->se_pued_entreg_ant == 'No') {
        $pedido->cuant_dia_ant    = null;
      }
      $pedido->urg                = $request->es_pedido_urgente;
      $pedido->stock              = $request->es_pedido_de_stock;
      $pedido->coment_vent        = $request->comentarios_ventas;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Ventas (Pedidos activos)', // Módulo
          'venta.pedidoActivo.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Fecha de entrega', '¿Se puede entregar antes?', '¿Cuántos días antes?', '¿Es pedido urgente?', '¿Es pedido de STOCK?', 'Comentarios ventas'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('fech_de_entreg', 'se_pued_entreg_ant', 'cuant_dia_ant', 'urg', 'stock', 'coment_vent') // Nombre de los campos en la BD
        ); 
        $pedido->updated_at_ped  = Auth::user()->email_registro;
      }
      $fecha_original = $pedido->getOriginal('fech_de_entreg');
      $fecha_nueva    = $pedido->getAttribute('fech_de_entreg');
      $pedido->save();
      Pedido::getEstatusVentas($pedido);
      $this->unificarPedido($pedido, $fecha_original, $fecha_nueva);
      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoAsignadoFindOrFailById($id_pedido, []);
      $pedido->delete();
      // EN AUTOMATICO ELIMINA LA UNIFICACION QUE TIENE CON LOS DEMAS PEDIDOS

      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Ventas pedido activo', // Nombre del módulo del sistema
        'registro'    => $pedido->num_pedido, // Información a mostrar en la papelera
        'tab'         => 'pedidos', // Nombre de la tabla en la BD
        'id_reg'      => $pedido->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);

      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getArmadosPedidoPagination($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
  public function getMontoDePagosAprobados($pedido) {
    return $pedido->pagos()->where('estat_pag', config('app.aprobado'))->sum('mont_de_pag');
  }
  public function getPagosPedidoPagination($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->pagos()->with('pedido')->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->pagos()->with('pedido')->paginate($request->paginador);
  }
  public function getPedidoFindOrFail($id_pedido, $relaciones) {// 'armados', 'unificar'
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)->findOrFail($id_pedido);
    return $pedido;
  }
  public function getEstatusPagoPedido($pedido) {

    //  Redondea en valor del pedido si solo hay diferencia menos a 1 peso
    $sum_pagos_aprobados1  = $pedido->pagos()->where('estat_pag', config('app.aprobado'))->sum('mont_de_pag');
    $monto_restante = $pedido->mont_tot_de_ped  - $sum_pagos_aprobados1;
    if($monto_restante <= 1 AND $monto_restante > 0.00) {
      $pago = new \App\Models\Pago();
      $pago->cod_fact       = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
      $pago->estat_pag      = config('app.aprobado');
      $pago->mont_de_pag    = $monto_restante;
      $pago->user_aut       = 'Automático por el sistema';
      $pago->coment_pag_vent  = 'Este comentario es generado automáticamente por el sistema. Pago registrado automáticamente para cuadrar total del pedido, ya que se tenia una diferencia por centavos.';
      $pago->pedido_id      = $pedido->id;   
      $pago->user_id        = $pedido->user_id; 
      $pago->created_at_pag = 'Automático por el sistema';
      $pago->save();
      $pago->cod_fact .= $pago->id;
    }

    $pagos_rechazado      = $pedido->pagos()->where('estat_pag', config('app.rechazado'))->get();
    $pagos_pendientes     = $pedido->pagos()->where('estat_pag', config('app.pendiente'))->get();
    $sum_pagos_aprobados  = $pedido->pagos()->where('estat_pag', config('app.aprobado'))->sum('mont_de_pag');
    
    $count_pagos_rechazado  = count($pagos_rechazado);
    $count_pagos_pendientes = count($pagos_pendientes);

    // ESTATUS PENDIENTE
    if($count_pagos_pendientes == 0) {
      $pedido->estat_pag = config('app.pendiente');
    }

    // ESTATUS PENDIENTE DE APROBAR
    if($count_pagos_pendientes > 0) {
      $pedido->estat_pag = config('app.pago_pendiente_de_aprobar');
    }

    // ESTATUS RECHAZADO
    if($count_pagos_rechazado > 0) {
      $pedido->estat_pag = config('app.pago_rechazado');
    }

    // ESTATUS PAGADO
    if($sum_pagos_aprobados == $pedido->mont_tot_de_ped) {
      $pedido->estat_pag = config('app.pagado');
    }

    $pedido->save();
  }
  public function unificarPedido($pedido, $fecha_original, $fecha_nueva) {
    if($fecha_original != $fecha_nueva) {
      $this->eliminarUnificacionDelPedido($pedido->id);
    }
    $pedidos_a_unificar = Pedido::with('unificar')->where('fech_de_entreg', $pedido->fech_de_entreg)->where('user_id', $pedido->user_id)->where('id', '!=', $pedido->id)->orderby('serie', 'DESC')->get();
    $num_pedidos_a_unificar = count($pedidos_a_unificar);
    if($num_pedidos_a_unificar > 0) { 
      $hastaC = $num_pedidos_a_unificar - 1;

      // Agrupa todos los ids que tienen relacion en la misma fecha de entrega y mismo cliente
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $ids_pedidos[$pedidos_a_unificar[$contador2]->id] = $pedidos_a_unificar[$contador2]->id;
      }
      $pedido->unificar()->sync($ids_pedidos); // Elimina toda relación con los pedidos

      // Crea la relación de los demas pédidos con el pedido que esta ejecutando la función
      $ids_pedidos[$pedido->id] = $pedido->id;
      $nuev_ids_pedidos  = $ids_pedidos;
      for($contador3 = 0; $contador3 <= $hastaC; $contador3++) {
        $ids_pedidos_menos = $nuev_ids_pedidos;
        unset($ids_pedidos_menos[$pedidos_a_unificar[$contador3]->id]);
        $pedidos_a_unificar[$contador3]->unificar()->sync($ids_pedidos_menos);
      }
    }
  }
  public function eliminarUnificacionDelPedido($id_pedido) {
    $pedido = $this->getPedidoFindOrFail($this->serviceCrypt->encrypt($id_pedido), ['unificar']);
    $pedidos_a_eliminar_unificacion = $pedido->unificar;
    $num_pedidos_a_eliminar_unificacion = count($pedidos_a_eliminar_unificacion);

    if($num_pedidos_a_eliminar_unificacion > 0) { 
      // Agrupa todos los ids que tiene relación con el pedido menos el id del pedido que esta ejecutando la función
      $hastaC = $num_pedidos_a_eliminar_unificacion - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $ids_pedidos[$contador2] = $pedidos_a_eliminar_unificacion[$contador2]->id;
      }
      $pedido->unificar()->detach($ids_pedidos);
      
      // Elimina la relación de los demas pédidos con el pedido que esta ejecutando la función
      $ids_pedidos[$pedido->id] = $pedido->id;
      for($contador3 = 0; $contador3 <= $hastaC; $contador3++) {
        $pedidos_a_eliminar_unificacion[$contador3]->unificar()->detach($pedido->id);
      }
    }
  }
  public function getPendientes() {
    $fecha = date("Y-m-d");
    $mas_dia = date("Y-m-d", strtotime('+3 day', strtotime(date("Y-m-d"))));
    $menos_un_dia = date("Y-m-d", strtotime('-1 day', strtotime(date("Y-m-d"))));
    $menos_dia = date("Y-m-d", strtotime('-5 day', strtotime(date("Y-m-d"))));
    $nom_tabla = (new \App\Models\Pedido())->getTable();
    
    $consulta = DB::table('pedidos')->select(
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log != '".config('app.entregado')."') AND (fech_de_entreg BETWEEN '$fecha' AND '$mas_dia')) as porEntregar"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log != '".config('app.entregado')."') AND (fech_de_entreg BETWEEN '$menos_dia' AND '$menos_un_dia')) as yaCaducados"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log != '".config('app.entregado')."') AND (estat_pag != '".config('app.pagado')."')) as pteDePago"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log != '".config('app.entregado')."') AND (estat_pag = '".config('app.pago_rechazado')."')) as pagoRechazado"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log != '".config('app.entregado')."') AND (estat_vent_gen != '".config('app.falta_informacion_general')."' OR estat_vent_dir != '".config('app.falta_detallar_direccion')."')) as pteDeInformacion"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."') as sinEntregaPorFaltaDeInformacion"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE estat_log = '".config('app.intento_de_entrega_fallido')."') as intentoDeEntregaFallido"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log != '".config('app.entregado')."') AND (urg = '".config('opcionesSelect.es_pedido_urgente.Si')."')) as urgente")
    )->first();
    if($consulta == null) { 
      $consulta = (object) array('porEntregar' => 0, 'yaCaducados' => 0, 'pteDePago' => 0, 'pagoRechazado' => 0, 'pteDeInformacion' => 0, 'sinEntregaPorFaltaDeInformacion' => 0, 'intentoDeEntregaFallido' => 0, 'urgente' => 0);
    }

    return $consulta; 
  }
}