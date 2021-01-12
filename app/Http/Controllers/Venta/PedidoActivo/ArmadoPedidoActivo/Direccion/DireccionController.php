<?php
namespace App\Http\Controllers\Venta\PedidoActivo\ArmadoPedidoActivo\Direccion;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\venta\pedidoActivo\armado\direccion\UpdateDireccionRequest;
use App\Http\Requests\venta\pedidoActivo\armado\direccion\UpdateTarjetaRequest;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion\DireccionArmadoRepositories;

class DireccionController extends Controller {
  protected $direccionArmadoRepo;
  public function __construct(DireccionArmadoRepositories $direccionArmadoRepositories) {
    $this->direccionArmadoRepo = $direccionArmadoRepositories;
  }
  public function show($id_direccion) {
    $direccion = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion, ['comprobantes', 'armado']);
    $comprobantes = $direccion->comprobantes;
    return view('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_show', compact('comprobantes', 'direccion'));
  }
  public function edit($id_direccion) {
    $direccion = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion, ['armado'=> function($query){
      $query->with(['pedido' => function($query) {
        $query->with(['usuario' => function($query) {
          $query->with(['direcciones']);
        }]);
      }]);
    }]);
    $direcciones = $direccion->armado->pedido->usuario->direcciones()->pluck('nom_ref_uno', 'id');
 
    return view('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_edit', compact('direccion', 'direcciones'));
  }
  public function update(UpdateDireccionRequest $request, $id_direccion) {
    $this->direccionArmadoRepo->update($request, $id_direccion);
    toastr()->success('¡Dirección actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateTarjeta(UpdateTarjetaRequest $request, $id_direccion) {
    $this->direccionArmadoRepo->updateTarjeta($request, $id_direccion);
    toastr()->success('¡Tarjeta actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}