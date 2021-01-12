<td title="Ver pedido: {{ $pedido->num_pedido }}">
  <a href="{{ route('rolCliente.pedido.show', Crypt::encrypt($pedido->id)) }}" title="Detalles: {{ $pedido->num_pedido }}" class='btn btn-light border'><i class="fas fa-eye"></i> {{ __('Ver pedido') }}</a>
</td>
<td title="Detallar pedido: {{ $pedido->num_pedido }}">
  @if($pedido->estat_vent_gen == config('app.informacion_general_completa') AND $pedido->estat_vent_arm == config('app.armados_cargados') AND $pedido->estat_vent_dir == config('app.direccion_de_armados_asignado'))
  @else
    <a href="{{ route('rolCliente.pedido.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-info'><i class="fas fa-edit"></i> {{ __('Asignar direcciones a tu pedido') }}</a>
  @endif
</td>