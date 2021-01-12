@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles armado').' '.$armado->cod)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Datos generales del armado') }}:</strong>
      @can('venta.pedidoActivo.armado.edit')
        <a href="{{ route('venta.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}" class="text-white">{{ $armado->cod }} ({{ Sistema::dosDecimales($armado->cant) }})</a>,
      @else
        {{ $armado->cod }},
      @endcan
     <strong>{{ __('estas en el pedido') }}:</strong> {{ $pedido->num_pedido }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $armado->cod }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('venta.pedidoActivo.show', Crypt::encrypt($armado->pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el pedido') }}</a></center>
      </div>
    </div>
  </div>
</div>
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_index')
@endsection