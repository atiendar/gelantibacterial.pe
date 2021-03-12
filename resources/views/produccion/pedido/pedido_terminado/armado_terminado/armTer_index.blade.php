<div class="card {{ config('app.color_card_secundario') }} card-outline">
    <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
      <h5>
        <strong>{{ __('Gel registrado') }}: </strong>@include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados'),
        <strong>{{ __('Terminados') }}: </strong> {{ Sistema::dosDecimales($armados_terminados_produccion) }}
      </h5>
    </div>
    <div class="card-body">
      {!! Form::model(Request::all(), ['route' => ['produccion.pedidoTerminado.show',Crypt::encrypt($pedido->id)],'method' => 'GET']) !!}
        @include('global.buscador.buscador', ['ruta_recarga' => route('produccion.pedidoTerminado.show',Crypt::encrypt($pedido->id)), 'opciones_buscador' => config('opcionesSelect.select_produccion_pedido_armados_index')])
      {!! Form::close() !!}
      @include('produccion.pedido.pedido_terminado.armado_terminado.armTer_table')
      @include('global.paginador.paginador', ['paginar' => $armados])
    </div>
  </div>