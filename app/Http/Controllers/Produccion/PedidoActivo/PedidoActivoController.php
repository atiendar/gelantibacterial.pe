<?php
namespace App\Http\Controllers\Produccion\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\produccion\pedidoActivo\UpdatePedidoActivoRequest;
// Repositories
use App\Repositories\produccion\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\produccion\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;

class PedidoActivoController extends Controller {
  protected $pedidoActivoRepo;
  protected $armadoPedidoActivoRepo;
  protected $generarQRRepo;
  public function __construct(PedidoActivoRepositories $PedidoActivoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, GenerarQRRepositories $generarQRRepositories) {
    $this->pedidoActivoRepo         = $PedidoActivoRepositories;
    $this->armadoPedidoActivoRepo   = $armadoPedidoActivoRepositories;
    $this->generarQRRepo            = $generarQRRepositories;
  }
  public function index(Request $request, $opc_consulta = null) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar'], $opc_consulta);
    $pen = $this->pedidoActivoRepo->getPendientes();
    return view('produccion.pedido.pedido_activo.pedAct_index', compact('pedidos', 'pen'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido                        = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['usuario', 'unificar', 'archivos'], 'show');
    $unificados                    = $pedido->unificar()->paginate(99999999);
    $archivos                      = $pedido->archivos()->paginate(99999999);
    $armados                       = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('produccion.pedido.pedido_activo.pedAct_show', compact('pedido', 'unificados', 'archivos', 'armados', 'armados_terminados_produccion'));
  }
  public function edit(Request $request, $id_pedido) {
    $pedido                         = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['unificar'], 'edit');
    $unificados                     = $pedido->unificar()->paginate(99999999);
    $armados                        = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion  = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('produccion.pedido.pedido_activo.pedAct_edit', compact('pedido', 'unificados', 'armados', 'armados_terminados_produccion'));
  }
  public function update(UpdatePedidoActivoRequest $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    if($pedido->estat_produc == config('app.en_almacen_de_salida_terminado')) {
      return redirect(route('produccion.pedidoActivo.index'));
    }
    return back();
  }
  public function generarOrdenDeProduccion($id_pedido) {
    $pedido   = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['usuario'=> function ($query) {
      $query->select('id', 'nom', 'email_registro');
    }, 'unificar' => function ($query) {
      $query->select('num_pedido');
    }, 'archivos'], 'edit');
    
    $archivos = $pedido->archivos->count();

    $codigoQRAlmacen = $this->generarQRRepo->qr($pedido->id, 'Almacén');
    $codigoQRProduccion = $this->generarQRRepo->qr($pedido->id, 'Producción');
    $codigoQRLogistica = $this->generarQRRepo->qr($pedido->id, 'Logística');
      
    $armados  = $pedido->armados()->where('estat', config('app.en_produccion'))
    ->orWhere('estat', config('app.productos_completos'))
    ->with(['productos'=> function ($query) {
      $query->with('sustitutos');
    }, 'direcciones'=> function ($query) {
      $query->select('cant', 'tip_tarj_felic', 'mens_dedic', 'pedido_armado_id', 'caj');
    }])->get();

    $orden_de_produccion  = \PDF::loadView('produccion.pedido.pedido_activo.export.ordenDeProduccion', compact('pedido', 'armados', 'archivos', 'codigoQRAlmacen', 'codigoQRProduccion', 'codigoQRLogistica'))->setPaper('a4', 'landscape');;
    return $orden_de_produccion->stream();
  }
}
