@canany(['pago.fPedido.index', 'pago.fPedido.create', 'pago.fPedido.show', 'pago.fPedido.edit', 'venta.pedidoActivo.show', 'venta.pedidoActivo.pago.create','venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit'])
  <li class="nav-item">
    <a href="{{ route('pago.fPedido.index') }}" class="nav-link {{ Request::is('pago/f-pedido') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos (F. por pedido)') }}
    </a>
  </li>
@endcanany
@canany(['pago.index', 'pago.show', 'pago.edit', 'pago.destroy', 'pago.marcarComoFacturado'])
  <li class="nav-item">
    <a href="{{ route('pago.index') }}" class="nav-link {{ Request::is('pago/individual') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos (Individual)') }}
    </a>
  </li>
@endcanany
@can('pago.fPedido.index')
  <li class="nav-item ml-auto">
    {!! Form::open(['route' => 'pago.fPedido.generarReporte', 'method' => 'get']) !!}
      <button type="submit" id="btnsubmit1" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> {{ __('Generar reporte') }}</button>
    {!! Form::close() !!}
  </li>
@endcan