@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de pedidos'))</title>
<div class="card">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolCliente.pedido.index', 'method' => 'GET']) !!}
      <strong>
        {{ __('IMPORTANTE: El pedido no esta actualizado en tiempo real, favor de no comunicarse a CYA') }}.<br>
        {{ __('Para entregas fueras de la ciudad de México hay un retraso de 5 días hábiles por causa de la pandemia. Gracias por su comprensión') }}
      </strong><br><br>
        @include('global.buscador.buscador', ['ruta_recarga' => route('rolCliente.pedido.index'), 'opciones_buscador' => config('opcionesSelect.select_cliente_pedido_index')])
    {!! Form::close() !!}
    @include('rolCliente.pedido.ped_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
  </div>
</div>
@endsection