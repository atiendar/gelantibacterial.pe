<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pedidos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          <th>{{ __('NÚMERO DE STOCK') }}</th>
          <th>{{ __('ESTATUS') }}</th>
          <th>{{ __('CANT.') }}</th>
          <th>{{ __('PRODUCTO') }}</th>
          <th>{{ __('FECH. SOLICITUD') }}</th>
          <th>{{ __('FECH. SURTIO') }}</th>
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          <tr title="{{ $pedido->num_pedido }}">
            <td>{{ $pedido->num_pedido }}</td>
            <td>{{ $pedido->estat }}</td>
            <td>{{ $pedido->cant }}</td>
            <td>{{ $pedido->coment }}</td>
            <td>{{ $pedido->created_at }}</td>
            <td>{{ $pedido->fech_estat }}</td>
            @include('produccion.pedido.stock.sto_tableOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>