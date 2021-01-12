@canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])
  <li class="nav-item">
    <a href="{{ route('almacen.producto.index') }}" class="nav-link {{ Request::is('almacen/producto') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de productos') }}
    </a>
  </li>
@endcanany
@can('almacen.producto.create')
  <li class="nav-item">
    <a href="{{ route('almacen.producto.create') }}" class="nav-link {{ Request::is('almacen/producto/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar producto') }}
    </a>
  </li>
@endcan
@can('almacen.producto.index')
  <li class="nav-item ml-auto">
    <div class="btn-group dropleft">
      <button class="btn btn-light btn-sm border dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Reportes') }}
      </button>
      <div class="dropdown-menu">
        {!! Form::open(['route' => 'almacen.producto.generarReporteDeCompra', 'method' => 'get']) !!}
          <button type="submit" id="btnsubmit1" class="dropdown-item"><i class="fas fa-file-excel"></i>  {{ __('Reporte de compra') }}</button>
        {!! Form::close() !!}
        
        {!! Form::open(['route' => 'almacen.producto.generarReporteDeStock', 'method' => 'get', 'onsubmit' => 'return checarBotonSubmit("btnsubmit2")']) !!}
          <button type="submit" id="btnsubmit2" class="dropdown-item"><i class="fas fa-file-excel"></i>  {{ __('Reporte de STOCKS') }}</button>
        {!! Form::close() !!}
      </div>
    </div>
  </li>
@endcan