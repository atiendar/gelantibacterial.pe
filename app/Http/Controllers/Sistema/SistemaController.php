<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\sistema\sistema\UpdateSistemaRequest;
// Repositories
use App\Repositories\sistema\sistema\SistemaRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\serie\SerieRepositories;

class SistemaController extends Controller {
  protected $sistemaRepo;
  protected $plantillaRepo;
  protected $serieRepo;
  public function __construct(SistemaRepositories $sistemaRepositories, PlantillaRepositories $plantillaRepositories, SerieRepositories $serieRepositories) { // Interfaz para implementar solo [metodos]
    $this->sistemaRepo    = $sistemaRepositories;
    $this->plantillaRepo  = $plantillaRepositories;
    $this->serieRepo      = $serieRepositories;
  }
  public function edit() {
    $ser_cotizaciones         = $this->serieRepo->getAllInputSeriesPlunk('Cotizaciones (Serie)');
    $ser_pedidos              = $this->serieRepo->getAllInputSeriesPlunk('Pedidos (Serie)');
    $plantillas_usu_bien      = $this->plantillaRepo->getAllPlantillasModuloPluck('Usuarios (Bienvenida)');
    $plantillas_cli_bien      = $this->plantillaRepo->getAllPlantillasModuloPluck('Clientes (Bienvenida)');
    $plantillas_per_camb_pass = $this->plantillaRepo->getAllPlantillasModuloPluck('Perfil (Cambio de contraseña)');
    $plantillas_sis_rest_pass = $this->plantillaRepo->getAllPlantillasModuloPluck('Sistema (Restablecimiento de contraseña)');
    $plantillas_cot_env_cot   = $this->plantillaRepo->getAllPlantillasModuloPluck('Cotizaciones (Enviar cotización)');
    $plantillas_vent_reg_ped  = $this->plantillaRepo->getAllPlantillasModuloPluck('Ventas (Registrar pedido)');
    $plantillas_vent_ped_can  = $this->plantillaRepo->getAllPlantillasModuloPluck('Ventas (Pedido cancelado)');
    $plantillas_pag_reg_pag   = $this->plantillaRepo->getAllPlantillasModuloPluck('Pagos (Registrar pago)');
    $plantillas_pag_pag_rech  = $this->plantillaRepo->getAllPlantillasModuloPluck('Pagos (Pago rechazado)');
    return view('sistema.sistema.sis_sis_index', compact('ser_cotizaciones', 'ser_pedidos', 'plantillas_usu_bien', 'plantillas_cli_bien', 'plantillas_per_camb_pass', 'plantillas_sis_rest_pass', 'plantillas_cot_env_cot', 'plantillas_vent_reg_ped', 'plantillas_vent_ped_can', 'plantillas_pag_reg_pag', 'plantillas_pag_pag_rech'));
  }
  public function update(UpdateSistemaRequest $request) {
    $this->sistemaRepo->update($request);
    toastr()->success('¡Información del sistema actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}