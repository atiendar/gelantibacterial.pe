<?php
/* ===================== [ RUTAS (PRODUCCIÓN) ] ===================== */
Route::match(['GET', 'HEAD'],'', 'Produccion\ProduccionController@index')->name('produccion.index')->middleware('permission:produccion.pedidoActivo.index|produccion.pedidoActivo.show|produccion.pedidoActivo.edit|produccion.pedidoActivo.armado.show|produccion.pedidoActivo.armado.edit|produccion.pedidoTerminado.index|produccion.pedidoTerminado.show');