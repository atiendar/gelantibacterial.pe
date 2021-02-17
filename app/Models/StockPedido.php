<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StockPedido extends Model {
	protected $table='stock_pedido';
	protected $primaryKey='id';
	protected $guarded = [];

	protected $dates = ['deleted_at'];

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
}
