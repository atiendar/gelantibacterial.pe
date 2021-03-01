@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de pedidos stock'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('produccion.pedido.ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'produccion.pedido.stock.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['num_pag' => 30, 'ruta_recarga' => route('produccion.pedido.stock.index'), 'opciones_buscador' => config('opcionesSelect.select_produccion_pedido_stock_index')])
    {!! Form::close() !!}
    @include('produccion.pedido.stock.sto_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
  </div>
</div>
@endsection