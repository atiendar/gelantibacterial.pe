<?php
namespace App\Repositories\armado\stock;

interface StockInterface {
  public function stockFindOrFailById($id_stock, $relaciones);

  public function getPagination($request);

  public function aumentarStock($request, $id_stock);

  public function disminuirStock($request, $id_stock);
}