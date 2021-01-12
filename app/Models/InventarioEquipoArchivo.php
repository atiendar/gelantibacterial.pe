<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class InventarioEquipoArchivo extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;
  
  protected $table = 'inventario_equipos_archivos';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  // protected $softCascade = ['']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function inventario() {
    return $this->belongsTo('App\Models\InventarioEquipo', 'inventario_equipo_id')->orderBy('id', 'DESC');
  }
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
}
