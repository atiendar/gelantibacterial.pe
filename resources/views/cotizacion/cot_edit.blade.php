@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar cotización').' '.$cotizacion->cliente->email_registro )</title>
@include('cotizacion.promociones.cot_index')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    @canany(['cotizacion.index', 'cotizacion.show', 'cotizacion.edit'])
      <div class="float-right mr-5">
        <div class="btn-group dropleft">
          <button class="btn btn-light btn-sm border dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Acciones') }}
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('cotizacion.generarCotizacion', Crypt::encrypt($cotizacion->id)) }}" target="_blank"><i class="fas fa-file-pdf"></i> {{ __('Generar') }}</a>
            <form action="{{ route('cotizacion.clonar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionClonar{{ $cotizacion->id }}">
              @method('POST')@csrf
              {!! Form::button('<i class="far fa-clone"></i> Clonar', ['type' => 'submit', 'class' => 'dropdown-item', 'id' => "btnClo$cotizacion->id", 'onclick' => "return check('btnClo$cotizacion->id', 'cotizacionClonar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres clonar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
            </form>
            <form action="{{ route('cotizacion.aprobar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionAprobar{{ $cotizacion->id }}">
              @method('POST')@csrf
              {!! Form::button('<i class="fas fa-check"></i> Aprobar', ['type' => 'submit', 'class' => 'dropdown-item', 'id' => "btnApro$cotizacion->id", 'onclick' => "return check('btnApro$cotizacion->id', 'cotizacionAprobar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres aprobar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
            </form>
            <form action="{{ route('cotizacion.cancelar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionCancelar{{ $cotizacion->id }}">
              @method('POST')@csrf
              {!! Form::button('<i class="fas fa-ban"></i> Cancelar', ['type' => 'submit', 'class' => 'dropdown-item', 'id' => "btnCan$cotizacion->id", 'onclick' => "return check('btnCan$cotizacion->id', 'cotizacionCancelar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres cancelar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
            </form>
          </div>
        </div>
      </div>
    @endcanany
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('cotizacion.show')
        <a href="{{ route('cotizacion.show', Crypt::encrypt($cotizacion->id)) }}" class="text-white">{{ $cotizacion->cliente->email_registro }}</a>
      @else
        {{ $cotizacion->cliente->email_registro  }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $cotizacion->serie }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['cotizacion.update', Crypt::encrypt($cotizacion->id)], 'method' => 'patch', 'id' => 'cotizacionUpdate']) !!}
      @include('cotizacion.cot_editFields')
    {!! Form::close() !!}
  </div>
</div>
@include('cotizacion.armado_cotizacion.cot_arm_index')
@include('layouts.private.plugins.priv_plu_select2')
@endsection