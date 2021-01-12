@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pago').' '.$pago->cod_fact)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('pago.show')
        <a href="{{ route('pago.show', Crypt::encrypt($pago->id)) }}" class="text-white">{{ $pago->cod_fact }}</a>
      @else
        {{ $pago->cod_fact }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $pago->cod_fact }}</small>
    </div>
  </div>
  <div class="card-body">
    <label for="redes_sociales">{{ __('INFORMACIÓN DEL PAGO') }}</label>
    <div class="border border-primary rounded p-2">
      <div class="row">
        @include('pago.pag_showFields.numeroDePedido')
        @include('venta.pedido.pedido_activo.ven_pedAct_showFields.montoTotalDelPedido1')
      </div>
      <div class="row">
        @include('pago.pag_showFields.nota')
      </div>
      <div class="row">
        @include('pago.pag_showFields.codigoDeFacturacion')
        @include('pago.pag_showFields.estatusPago')
      </div>
      <div class="row">
        @include('pago.pag_showFields.formaDePago')
        @include('pago.pag_showFields.montoDePago')
      </div>
      <div class="row">
        @include('pago.pag_showFields.usuarioQueAutorizo')
        @include('pago.pag_showFields.folio')
      </div>
      @include('pago.pag_showFields.comentariosVentas')
    </div>
    {!! Form::open(['route' => ['pago.update', Crypt::encrypt($pago->id)], 'method' => 'patch', 'id' => 'pagoUpdate']) !!}
      @include('pago.individual.ind_editFields')
    {!! Form::close() !!}
  </div>
</div>

@include('pago.individual.pago.pag_index')
@endsection