<?php
namespace App\Repositories\armado\stock;
// Models
use App\Models\Armado;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class StockRepositories implements StockInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function stockFindOrFailById($id_stock, $relaciones) {
    $id_stock = $this->serviceCrypt->decrypt($id_stock);
    return Armado::with($relaciones)->findOrFail($id_stock);
  }
  public function getPagination($request) {
    return Armado::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }

  public function aumentarStock($request, $id_stock) {
    $stock = $this->stockFindOrFailById($id_stock, []);
    $stock->stock += $request->aumentar_stock;
    if(strlen($stock->stock) >= 10) {return false;}
    if($stock->isDirty()) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadRegistrada::dispatch(
        'Stock Armado', // Módulo
        'armado.stock.show', // Nombre de la ruta
        $id_stock, // Id del registro debe ir encriptado
        $this->serviceCrypt->decrypt($id_stock), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
        array('Aumentar stock'), // Nombre de los inputs del formulario
        $stock, // Request
        array('stock') // Nombre de los campos en la BD
      ); 
      $stock->updated_at_arm = Auth::user()->email_registro;
    }
    $stock->save();
    return $stock;
  }
  public function disminuirStock($request, $id_stock) {
    $stock = $this->stockFindOrFailById($id_stock, []);
    $stock->stock -= $request->disminuir_stock;
    if($stock->stock < 0) {return false;}
    if($stock->isDirty()) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadRegistrada::dispatch(
        'Stock Armado', // Módulo
        'armado.stock.show', // Nombre de la ruta
        $id_stock, // Id del registro debe ir encriptado
        $this->serviceCrypt->decrypt($id_stock), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
        array('Disminuir stock'), // Nombre de los inputs del formulario
        $stock, // Request
        array('stock') // Nombre de los campos en la BD
      ); 
      $stock->updated_at_arm = Auth::user()->email_registro;
    }
    $stock->save();
    return $stock;
  }
}