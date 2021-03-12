@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles gel activo almacén').' '.$armado->cod)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Datos generales del gel') }}:</strong>
      @can('almacen.pedidoActivo.armado.edit')
       <a href="{{ route('almacen.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}" class="text-light">{{ $armado->cod }} ({{ Sistema::dosDecimales($armado->cant) }})</a>
      @else
       {{ $armado->cod }}
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
    @include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_showFields')
  </div>
</div>
@endsection