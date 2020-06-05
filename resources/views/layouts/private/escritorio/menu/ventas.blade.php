@canany(['venta.pedidoActivo.index'])
  <li class="nav-item has-treeview {{ Request::is('venta*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('venta*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-money-check-alt"></i>
      <p>
        {{ __('Ventas') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('venta.index') }}" class="nav-link {{ Request::is('inicio-ventas') ? 'active' : '' }}">
          <i class="nav-icon fas fa-home"></i>
          <p>{{ __('Inicio ventas') }}</p>
        </a>
      </li>
      <li class="nav-item has-treeview {{ Request::is('venta/pedido*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('venta/pedido*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-shopping-bag"></i>
          <p>
            <p>{{ __('Pedidos') }}</p>
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview ">
          @canany(['venta.pedidoActivo.index'])
            <li class="nav-item">
              <a href="{{ route('venta.pedidoActivo.index') }}" class="nav-link {{ Request::is('venta/pedido-activo') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>{{ __('Lista de pedidos activos') }}</p>
              </a>
            </li>
          @endcanany
          @canany(['venta.pedidoTerminado.index'])
            <li class="nav-item">
              <a href="{{ route('venta.pedidoTerminado.index') }}" class="nav-link {{ Request::is('venta/pedido-terminado') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>{{ __('Lista de pedidos terminados') }} (-90d)</p>
              </a>
            </li>
          @endcanany
        </ul>
      </li>
    </ul>
  </li>
@endcanany