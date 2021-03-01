<?php
namespace App\Http\Controllers\Armado\Stock;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\almacen\producto\UpdateAumentarStockRequest;
use App\Http\Requests\almacen\producto\UpdateDisminuirStockRequest;
// Repositories
use App\Repositories\armado\stock\StockRepositories;

class StockController extends Controller {
  protected $stockRepo;
  public function __construct(StockRepositories $stockRepositories) {
    $this->stockRepo  = $stockRepositories;
  }
  public function index(Request $request) {
    $stocks = $this->stockRepo->getPagination($request);
    return view('armado.stock.sto_index', compact('stocks'));
  }
  public function show($id_stock) {
    $stock = $this->stockRepo->stockFindOrFailById($id_stock, []);
    return view('armado.stock.sto_show', compact('stock'));
  }
  public function edit($id_stock) {
    $stock = $this->stockRepo->stockFindOrFailById($id_stock, []);
    return view('armado.stock.sto_edit', compact('stock'));
  }
  public function aumentarStock(UpdateAumentarStockRequest $request, $id_stock) {
    $this->stockRepo->aumentarStock($request, $id_stock);
    toastr()->success('¡Stock actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function disminuirStock(UpdateDisminuirStockRequest $request, $id_stock) {
    $respuesta = $this->stockRepo->disminuirStock($request, $id_stock);
    if($respuesta == false) {
      toastr()->error('¡El valor que se ingreso no fue aceptado!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    } else {
      toastr()->success('¡Stock disminuido exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    }
    return back();
  }
}