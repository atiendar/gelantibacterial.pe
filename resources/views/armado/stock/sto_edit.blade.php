@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar stock').' '.$stock->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('armado.stock.show')
        <a href="{{ route('armado.stock.show', Crypt::encrypt($stock->id)) }}" class="text-white">{{ $stock->nom }}</a>
      @else
        {{ $stock->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $stock->id }}</small>
    </div>
  </div>
</div>
@include('armado.stock.sto_editFields')
@endsection