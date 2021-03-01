<td width="1rem" title="Marcar como surtido: {{ $pedido->num_pedido }}">
  @if($pedido->estat == 'Pendiente')
    <form method="post" action="{{ route('produccion.pedido.stock.update', Crypt::encrypt($pedido->id)) }}" id="produccionPedidoStockUpdate{{ $pedido->id }}">
      @method('PUT')@csrf
      {!! Form::button('<i class="far fa-check-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'id' => "btnsub$pedido->id", 'onclick' => "return check('btnsub$pedido->id', 'produccionPedidoStockUpdate$pedido->id', '¡Alerta!', 'Se marcará este pedido como surtido. ¿Estás seguro que quieres realizar esta acción para el registro: $pedido->id ($pedido->num_pedido) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endif
</td>