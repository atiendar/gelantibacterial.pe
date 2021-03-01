<?php
namespace App\Repositories\produccion\pedidoStock;

interface PedidoStockInterface {
  public function pedidofindOrFailById($id_pedido, $relaciones);

  public function getPagination($request);

  public function update($request, $id_pedido);
}