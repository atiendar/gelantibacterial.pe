<?php
/* ===================== [ RUTAS (ARMADO) ] ===================== */
Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'', 'Armado\ArmadoController@index')->name('armado.index')->middleware('permission:armado.index|armado.create|armado.show|armado.edit|armado.destroy|armado.clon.create|armado.producto.create|armado.producto.editCantidad|armado.producto.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Armado\ArmadoController@create')->name('armado.create')->middleware('permission:armado.create');
    Route::post('almacenar', 'Armado\ArmadoController@store')->name('armado.store')->middleware('permission:armado.create');
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Armado\ArmadoController@show')->name('armado.show')->middleware('permission:armado.show');
    Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Armado\ArmadoController@edit')->name('armado.edit')->middleware('permission:armado.edit|armado.producto.create|armado.producto.editCantidad|armado.producto.destroy');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Armado\ArmadoController@update')->name('armado.update')->middleware('permission:armado.edit');
    Route::match(['DELETE'],'eliminar/{id_armado}', 'Armado\ArmadoController@destroy')->name('armado.destroy')->middleware('permission:armado.destroy');
    Route::match(['GET', 'HEAD'],'generar-catalogo-de-armados', 'Armado\ArmadoController@generarCatalogoDeArmados')->name('armado.generarCatalogoDeArmados')->middleware('permission:armado.index');

    Route::group(['prefix' => 'imagen'], function() {
        Route::post('almacenar/{id_armado}', 'Armado\ImagenArmado\ImagenArmadoController@store')->name('armado.imagen.store')->middleware('permission:armado.edit|armado.clon.edit');
        Route::match(['DELETE'],'eliminar/{id_imagen}', 'Armado\ImagenArmado\ImagenArmadoController@destroy')->name('armado.imagen.destroy')->middleware('permission:armado.edit|armado.clon.edit');
    });
    
    Route::group(['prefix' => 'producto'], function() {
        Route::post('almacenar/{id_armado}', 'Armado\ProductoArmado\ProductoArmadoController@store')->name('armado.producto.store')->middleware('permission:armado.producto.create|armado.clon.producto.create');
        Route::match(['DELETE'],'eliminar/{id_armado}/{id_producto}', 'Armado\ProductoArmado\ProductoArmadoController@destroy')->name('armado.producto.destroy')->middleware('permission:armado.producto.destroy|armado.clon.producto.destroy');  
        Route::match(['PUT', 'PATCH'],'actualizar-cantidad/{id_producto}/{id_armado}', 'Armado\ProductoArmado\ProductoArmadoController@editCantidad')->name('armado.producto.editCantidad')->middleware('permission:armado.producto.editCantidad|armado.clon.producto.editCantidad');
    });
    
    Route::group(['prefix' => 'clon'], function() {
      Route::match(['GET', 'HEAD'],'', 'Armado\ClonArmado\ClonArmadoController@index')->name('armado.clon.index')->middleware('permission:armado.clon.index|armado.clon.create|armado.clon.show|armado.clon.edit|armado.clon.destroy|armado.clon.producto.create|armado.clon.producto.editCantidad|armado.clon.producto.destroy');
      Route::match(['GET', 'HEAD'],'crear/{id_armado}', 'Armado\ClonArmado\ClonArmadoController@store')->name('armado.clon.store')->middleware('permission:armado.clon.create');
      Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Armado\ClonArmado\ClonArmadoController@show')->name('armado.clon.show')->middleware('permission:armado.clon.show');
      Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Armado\ClonArmado\ClonArmadoController@edit')->name('armado.clon.edit')->middleware('permission:armado.clon.edit|armado.clon.producto.create|armado.clon.producto.editCantidad|armado.clon.producto.destroy');
      Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Armado\ClonArmado\ClonArmadoController@update')->name('armado.clon.update')->middleware('permission:armado.clon.edit');
      Route::match(['DELETE'],'eliminar/{id_armado}', 'Armado\ClonArmado\ClonArmadoController@destroy')->name('armado.clon.destroy')->middleware('permission:armado.clon.destroy');
    });

    Route::group(['prefix' => 'stock'], function() {
      Route::match(['GET', 'HEAD'],'', 'Armado\Stock\StockController@index')->name('armado.stock.index')->middleware('permission:armado.stock.index|armado.stock.show|armado.stock.aumentarStock|armado.stock.disminuirStock');
      Route::match(['GET', 'HEAD'],'detalles/{id_stock}', 'Armado\Stock\StockController@show')->name('armado.stock.show')->middleware('permission:armado.stock.show');
      Route::match(['GET', 'HEAD'],'editar/{id_stock}', 'Armado\Stock\StockController@edit')->name('armado.stock.edit')->middleware('permission:armado.stock.aumentarStock|armado.stock.disminuirStock');
      Route::match(['PUT', 'PATCH'],'aumentar-stock/{id_stock}', 'Armado\Stock\StockController@aumentarStock')->name('armado.stock.aumentarStock')->middleware('permission:armado.stock.aumentarStock');
      Route::match(['PUT', 'PATCH'],'disminuir-stock/{id_stock}', 'Armado\Stock\StockController@disminuirStock')->name('armado.stock.disminuirStock')->middleware('permission:armado.stock.disminuirStock');
    });
});