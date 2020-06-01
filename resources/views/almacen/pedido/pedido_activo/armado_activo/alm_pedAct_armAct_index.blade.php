<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    @can('almacen.pedidoActivo.edit')
      @if($pedido->lid_de_ped_alm != null)
        <div class="float-right">
          {!! Form::open(['route' => ['almacen.pedidoActivo.marcarTodoCompleto.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'almacenPedidoActivoMarcarTodoCompletoUpdate']) !!}
            <button type="submit" id="btnsubmit1" class="btn btn-info btn-sm" onclick="return check('btnsubmit1', 'almacenPedidoActivoMarcarTodoCompletoUpdate', '¡Alerta!', '¿Estás seguro, quieres marcar todos los armados como productos completos?', 'info', 'Continuar', 'Cancelar', 'false');">{{ __('Marcar todo como completo') }}</button>
          {!! Form::close() !!}
        </div>
      @endif
    @endcan
    <h5>
      <strong>{{ __('Armado registrado') }}: </strong> {{ $pedido->arm_carg }}  <strong>{{('de')}} </strong> {{ $pedido->tot_de_arm }},
      <strong>{{ __('Terminados') }}: </strong>
      {{ $armados_terminados_almacen }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => ['almacen.pedidoActivo.edit',Crypt::encrypt($pedido->id)],'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('almacen.pedidoActivo.edit',Crypt::encrypt($pedido->id)), 'opciones_buscador' => config('opcionesSelect.select_pedido_armados_index')])
    {!! Form::close() !!}
    @include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_table')
    @include('global.paginador.paginador', ['paginar' => $armados])
  </div>
</div>