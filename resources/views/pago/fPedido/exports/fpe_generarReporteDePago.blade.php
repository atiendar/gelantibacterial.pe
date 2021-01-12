<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    <thead>
      <tr>
        @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
        @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusPago')
        @include('venta.pedido.pedido_activo.ven_pedAct_table.th.montoTotal')
        <th>{{ __('MONT. PAGADO') }}</th>
        <th>{{ __('MONT. POR PAGAR') }}</th>
      </tr>
    </thead>
    <tbody> 
      @foreach($pedidos as $pedido)
        <tr title="{{ $pedido->num_pedido }}">
          @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedido')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.td.montoTotal')
          <td>{{ Sistema::dosDecimales($pedido->mont_pagado) }}</td>
          <td>{{ Sistema::dosDecimales($pedido->mont_tot_de_ped-$pedido->mont_pagado) }}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>