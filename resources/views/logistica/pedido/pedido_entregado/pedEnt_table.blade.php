<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pedidos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedidoUnificado')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.fechaDeEntrega')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusPago')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusProduccion')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.bodega')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusLogistica')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.cliente')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.totalDeArmados')
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          <tr title="{{ $pedido->num_pedido }}">
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['logistica.pedidoEntregado.show', 'logistica.pedidoEntregado.armado.show'], 'ruta' => route('logistica.pedidoEntregado.show',  Crypt::encrypt($pedido->id))])
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedidoUnificado')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusProduccion')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.bodega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusLogistica')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.cliente')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>