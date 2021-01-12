@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar producto').' '.$producto->produc)</title>
<div class="card {{ empty($producto->stock < $producto->min_stock) ? config('app.color_card_primario') : config('app.color_card_warning') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($producto->stock < $producto->min_stock) ? config('app.color_bg_primario') : config('app.color_bg_warning') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('almacen.producto.show')
        <a href="{{ route('almacen.producto.show', Crypt::encrypt($producto->id)) }}" class="text-white">{{ $producto->produc }}</a>
      @else
        {{ $producto->produc }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($producto->stock < $producto->min_stock) ? config('app.color_bg_primario') : config('app.color_bg_warning') }}"> 
      <small>{{ $producto->id }}</small>
    </div>
  </div>
</div>
@include('almacen.producto.stock_producto.alm_pro_stoPro_edit')
@can('almacen.producto.edit')
  <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['almacen.producto.update', Crypt::encrypt($producto->id)], 'method' => 'patch', 'id' => 'almacenProductoUpdate', 'files' => true]) !!}
        @include('almacen.producto.alm_pro_editFields')
      {!! Form::close() !!}
    </div>
  </div>
@endcan
@include('almacen.producto.proveedor_producto.alm_pro_proPro_index')
@include('almacen.producto.sustitutos_producto.alm_pro_susPro_index')
@can('almacen.producto.edit')
  @include('almacen.producto.precios.pre_index')
@endcan
@include('layouts.private.plugins.priv_plu_select2')
@endsection