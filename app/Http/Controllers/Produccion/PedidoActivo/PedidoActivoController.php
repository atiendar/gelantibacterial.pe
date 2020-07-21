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
  public function index(Request $request) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar']);
    return view('produccion.pedido.pedido_activo.pedAct_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido                        = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['usuario', 'unificar']);
    $unificados                    = $pedido->unificar()->paginate(99999999);
    $armados                       = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('produccion.pedido.pedido_activo.pedAct_show', compact('pedido', 'unificados', 'armados', 'armados_terminados_produccion'));
  }
  public function edit(Request $request, $id_pedido) {
    $pedido                         = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['unificar']);
    $unificados                     = $pedido->unificar()->paginate(99999999);
    $armados                        = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion  = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('produccion.pedido.pedido_activo.pedAct_edit', compact('pedido', 'unificados', 'armados', 'armados_terminados_produccion'));
  }
  public function update(UpdatePedidoActivoRequest $request, $id_pedido) {
    $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarOrdenDeProduccion($id_pedido) {
    $pedido   = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['usuario', 'unificar']);

    $codigoQRAlmacen = $this->generarQRRepo->qr($pedido->id, 'Almacén');
    $codigoQRProduccion = $this->generarQRRepo->qr($pedido->id, 'Producción');
    $codigoQRLogistica = $this->generarQRRepo->qr($pedido->id, 'Logística');
      
    $armados  = $pedido->armados()->with(['productos'=> function ($query) {
      $query->with('sustitutos');
    }])->get();
    $orden_de_produccion  = \PDF::loadView('produccion.pedido.pedido_activo.export.ordenDeProduccion', compact('pedido', 'armados', 'codigoQRAlmacen', 'codigoQRProduccion', 'codigoQRLogistica'));
    return $orden_de_produccion->stream();
  }
}
