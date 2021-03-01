@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles stock').' '.$stock->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @canany(['armado.stock.aumentarStock', 'armado.stock.disminuirStock'])
        <a href="{{ route('armado.stock.edit', Crypt::encrypt($stock->id)) }}" class="text-white">{{ $stock->nom }}</a>
      @else
        {{ $stock->nom }}
      @endcanany
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $stock->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('armado.stock.sto_showFields', ['armado' => $stock])
  </div>
</div>
@endsection