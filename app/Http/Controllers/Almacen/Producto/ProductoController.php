<?php
namespace App\Http\Controllers\Almacen\Producto;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\almacen\producto\StoreProductoRequest;
use App\Http\Requests\almacen\producto\UpdateProductoRequest;
use App\Http\Requests\almacen\producto\UpdateAumentarStockRequest;
use App\Http\Requests\almacen\producto\UpdateDisminuirStockRequest;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\servicio\archivoGenerado\ArchivoGeneradoRepositories;
use App\Repositories\sistema\catalogo\CatalogoRepositories;

class ProductoController extends Controller {
  protected $serviceCrypt;
  protected $productoRepo;
  protected $catalogoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories, CatalogoRepositories $catalogoRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->productoRepo   = $productoRepositories;
    $this->catalogoRepo   = $catalogoRepositories;
  }
  public function index(Request $request) {
    $productos = $this->productoRepo->getPagination($request);
    return view('almacen.producto.alm_pro_index', compact('productos'));
  }
  public function create() {
    $categorias_list  = $this->catalogoRepo->getAllInputCatalogosPlunk('Productos (Categoría)');
    $etiquetas_list   = $this->catalogoRepo->getAllInputCatalogosPlunk('Productos (Etiqueta)');
    return view('almacen.producto.alm_pro_create', compact('categorias_list', 'etiquetas_list'));
  }
  public function store(StoreProductoRequest $request) {
    $producto = $this->productoRepo->store($request);
    if(auth()->user()->can('almacen.producto.edit')) {
      toastr()->success('¡Producto registrado exitosamente ahora puedes registrar sus proveedores!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('almacen.producto.edit', $this->serviceCrypt->encrypt($producto->id))); 
    }
    toastr()->success('¡Producto registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_producto) {
    $producto               = $this->productoRepo->productoAsignadoFindOrFailById($id_producto, ['sustitutos', 'proveedores']);
    $precios                = $this->productoRepo->getPreciosProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $sustitutos             = $this->productoRepo->getSustitutosProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $proveedores            = $this->productoRepo->getProveedoresProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $existencia_equivalente = $this->productoRepo->getExistenciaEquivalentePorProducto($sustitutos);
    return view('almacen.producto.alm_pro_show', compact('producto', 'precios', 'existencia_equivalente', 'sustitutos', 'proveedores'));
  }
  public function edit($id_producto) {
    $producto               = $this->productoRepo->productoAsignadoFindOrFailById($id_producto, ['precios', 'sustitutos', 'proveedores']);
    $precios                = $this->productoRepo->getPreciosProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $sustitutos_list        = $this->productoRepo->getAllSustitutosOrProductosPlunkMenos($producto->sustitutos, 'original');
    $sustitutos             = $this->productoRepo->getSustitutosProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $proveedores            = $this->productoRepo->getProveedoresProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $proveedores_list       = $producto->proveedores()->orderBy('nom_comerc', 'ASC')->pluck('nom_comerc', 'nom_comerc');
    $proveedores_list[$producto->prove] = $producto->prove;
    $existencia_equivalente = $this->productoRepo->getExistenciaEquivalentePorProducto($sustitutos);
    $categorias_list        = $this->catalogoRepo->getAllInputCatalogosPlunk('Productos (Categoría)');
    $categorias_list[$producto->categ] = $producto->categ;
    $etiquetas_list         = $this->catalogoRepo->getAllInputCatalogosPlunk('Productos (Etiqueta)');
    $etiquetas_list[$producto->etiq] = $producto->etiq;
    return view('almacen.producto.alm_pro_edit', compact('producto', 'precios', 'existencia_equivalente', 'proveedores', 'proveedores_list', 'sustitutos_list', 'sustitutos', 'categorias_list', 'etiquetas_list'));
  }
  public function update(UpdateProductoRequest $request, $id_producto) {
    $this->productoRepo->update($request, $id_producto);
    toastr()->success('¡Producto actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function aumentarStock(UpdateAumentarStockRequest $request, $id_producto) {
    $respuesta = $this->productoRepo->aumentarStock($request, $id_producto);
    if($respuesta == false) {
      toastr()->error('¡El valor que se ingreso no fue aceptado!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    } else {
      toastr()->success('¡Stock aumentado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    }
    return back();
  }
  public function disminuirStock(UpdateDisminuirStockRequest $request, $id_producto) {
    $respuesta = $this->productoRepo->disminuirStock($request, $id_producto);
    if($respuesta == false) {
      toastr()->error('¡El valor que se ingreso no fue aceptado!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    } else {
      toastr()->success('¡Stock disminuido exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    }
    return back();
  }
  public function destroy($id_producto) {
    $this->productoRepo->destroy($id_producto);
    toastr()->success('¡Producto eliminado exitosamenste!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarReporteDeCompra(ArchivoGeneradoRepositories $archivoGeneradoRepo) {
    return (new \App\Exports\almacen\producto\generarReporteDeCompraExport)->download('ReporteDeCompra-'.date('Y-m-d').'.xlsx');
  /*
    $info_archivo = (object) [
      'tip'             => 'XLSX', // Tipo de archivo (JPG, PNG, PDF, XLM, XLSX, ETC) siempre en mayusculas
      'arch_rut'        => env('PREFIX'), // Ruta de donde se guardara el archivo (Mismo que se espesifica en el archivo config/filesystems.php)
      'arch_nom'        => 'almacen/productos/archivosGenerados/ReporteDeCompra-' . date('Y-m-d') . '-' . time() . '.xlsx', // Nombre del archivo
      'arch_nom_abrev'  => 'ReporteDeCompra-' . date('Y-m-d'), // Nombre del archivo abreviado para mostrar en la campana de notificaciones
      'filesystems'     => 's3' // Nombre de la fuction espesificada en el archivo config/filesystems.php la cual se encargara de espesificar la ruta donde se guardara el archivo
    ];
    $tipo = 'generarReporteDeCompraExport'; // Nombre del archivo App\Exports\...
    $archivoGeneradoRepo->store($info_archivo, $tipo);
    toastr()->success('¡El reporte se esta generando una vez que haya terminado se mostrará en la barra superior!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  */
  }
  public function generarReporteDeStock(ArchivoGeneradoRepositories $archivoGeneradoRepo) {
    $info_archivo = (object) [
      'tip'             => 'XLSX', // Tipo de archivo (JPG, PNG, PDF, XLM, XLSX, ETC) siempre en mayusculas
      'arch_rut'        => env('PREFIX'), // Ruta de donde se guardara el archivo (Mismo que se espesifica en el archivo config/filesystems.php)
      'arch_nom'        => 'almacen/productos/archivosGenerados/ReporteDeStock-' . date('Y-m-d') . '-' . time() . '.xlsx', // Nombre del archivo
      'arch_nom_abrev'  => 'ReporteDeStock-' . date('Y-m-d'), // Nombre del archivo abreviado para mostrar en la campana de notificaciones
      'filesystems'     => 's3' // Nombre de la fuction espesificada en el archivo config/filesystems.php la cual se encargara de espesificar la ruta donde se guardara el archivo
    ];
    $tipo = 'generarReporteDeStockExport'; // Nombre del archivo App\Exports\...
    $archivoGeneradoRepo->store($info_archivo, $tipo);
    toastr()->success('¡El reporte se esta generando una vez que haya terminado se mostrará en la barra superior!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function getPrecioProveedor(Request $request) {
    if($request->ajax()) {
      $producto = $this->productoRepo->productoAsignadoFindOrFailById($request->id_producto, 'proveedores');
      $pivot    = $producto->proveedores()->where('nom_comerc', $request->nombre_del_proveedor)->first()->pivot;
      return response()->json($pivot);
    }
  }
}