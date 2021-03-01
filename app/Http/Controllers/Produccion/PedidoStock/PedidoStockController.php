<?php
namespace App\Http\Controllers\Produccion\PedidoStock;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\produccion\PedidoStock\PedidoStockRepositories;

class PedidoStockController extends Controller {
  protected $pedidoStockRepo;
  public function __construct(PedidoStockRepositories $pedidoStockRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->pedidoStockRepo    = $pedidoStockRepositories;
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoStockRepo->getPagination($request);
    return view('produccion.pedido.stock.sto_index', compact('pedidos'));
  }
  public function update(Request $request, $id_pedido) {
    $this->pedidoStockRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}