<?php
namespace App\Repositories\produccion\pedidoStock;
// Models
use App\Models\StockPedido;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoStockRepositories implements PedidoStockInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  } 
  public function pedidofindOrFailById($id_pedido, $relaciones) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = StockPedido::with($relaciones)->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request) {
    return StockPedido::buscar($request->opcion_buscador, $request->buscador)
      ->orderBy('created_at', 'DESC')
      ->paginate($request->paginador);
  }
  public function update($request, $id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidofindOrFailById($id_pedido, []);
      $pedido->estat = 'Surtido';
      $pedido->fech_estat = now();
      $pedido->updated_at_reg = Auth::user()->email_registro;
      $pedido->save();

      // Disminuye lo ya vendido del armado original para que al aprobar la cotizacion pase a almacen y no a planta
      $armado_orig              = \App\Models\Armado::FindOrFail($pedido->id_armado);
    //  $armado_orig->ya_vendido  -= $pedido->cant;
      $armado_orig->stock       += $pedido->cant;
      $armado_orig->save();

      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}