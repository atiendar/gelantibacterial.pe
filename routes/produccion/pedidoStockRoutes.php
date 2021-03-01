<?php
Route::group(['prefix' => 'pedido/stock'], function() {
  Route::match(['GET', 'HEAD'],'', 'Produccion\PedidoStock\PedidoStockController@index')->name('produccion.pedido.stock.index')->middleware('permission:produccion.pedido.stock.index');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Produccion\PedidoStock\PedidoStockController@update')->name('produccion.pedido.stock.update')->middleware('permission:produccion.pedido.stock.index');
});