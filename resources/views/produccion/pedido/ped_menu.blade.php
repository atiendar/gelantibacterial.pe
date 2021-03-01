@canany(['produccion.pedidoActivo.index', 'produccion.pedidoActivo.show', 'produccion.pedidoActivo.edit'])
  <li class="nav-item">
    <a href="{{ route('produccion.pedidoActivo.index') }}" class="nav-link {{ Request::is('produccion/pedido-activo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos activos') }}
    </a>
  </li>
@endcanany
@canany(['produccion.pedidoTerminado.index', 'produccion.pedidoTerminado.show'])
  <li class="nav-item">
    <a href="{{ route('produccion.pedidoTerminado.index') }}" class="nav-link {{ Request::is('produccion/pedido-terminado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos terminados') }} (-90d)
    </a>
  </li>
@endcanany
@canany(['produccion.pedido.stock.index'])
  <li class="nav-item">
    <a href="{{ route('produccion.pedido.stock.index') }}" class="nav-link {{ Request::is('produccion/pedido/stock') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos stock') }}
    </a>
  </li>
@endcanany