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
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusAlmacen')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.cliente')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.totalDeArmados')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          @php
            $estilos = null;
            $clase = null; 
          @endphp
       
          @if($pedido->estat_alm == config('app.asignar_persona_que_recibe') OR $pedido->estat_alm == config('app.en_espera_de_ventas') OR $pedido->estat_alm == config('app.en_espera_de_compra') OR $pedido->estat_alm == config('app.en_revision_de_productos'))
          @else
            @php
              $estilos = 'background:#bcbcbc;';
              $clase = 'text-muted cursor-allowed'; 
            @endphp
          @endif

          @if($pedido->urg == 'Si')
            @php
              $estilos .= 'border:#FFFF0060 2px solid;';
            @endphp
          @endif

          @if($pedido->stock == 'Si')
            @php
              $estilos .= 'background-color: #ff000060';
            @endphp
          @endif

          <tr title="{{ $pedido->num_pedido }}" class="{{ $clase }}" style="{{ $estilos }}">
            @if($pedido->estat_alm == config('app.asignar_persona_que_recibe') OR $pedido->estat_alm == config('app.en_espera_de_ventas') OR $pedido->estat_alm == config('app.en_espera_de_compra') OR $pedido->estat_alm == config('app.en_revision_de_productos'))
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['almacen.pedidoActivo.show', 'almacen.pedidoActivo.armado.show'], 'ruta' => route('almacen.pedidoActivo.show', Crypt::encrypt($pedido->id))])
            @else
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['rastrea.pedido.show', 'rastrea.pedido.showFull'], 'ruta' => route('rastrea.pedido.show',  Crypt::encrypt($pedido->id)), 'target' => '_blank'])
            @endif

            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedidoUnificado')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusAlmacen')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.cliente')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')

            @if($pedido->estat_alm == config('app.asignar_persona_que_recibe') OR $pedido->estat_alm == config('app.en_espera_de_ventas') OR $pedido->estat_alm == config('app.en_espera_de_compra') OR $pedido->estat_alm == config('app.en_revision_de_productos'))
              @include('almacen.pedido.pedido_activo.alm_pedAct_tableOpciones')
            @else
              <td></td>
              <td></td>
            @endif
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>