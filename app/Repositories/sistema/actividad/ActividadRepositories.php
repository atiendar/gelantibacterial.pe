<?php
namespace App\Repositories\sistema\actividad;
// Models
use App\Models\Actividades;

class ActividadRepositories implements ActividadInterface {
  public function getPagination($request) {
    return Actividades::with('usuario')
            ->buscar($request->opcion_buscador_1, $request->buscador_1)
            ->buscar($request->opcion_buscador_2, $request->buscador_2)
            ->buscar($request->opcion_buscador_3, $request->buscador_3)
            ->orderBy('id', 'DESC')->paginate(150);
  }
}