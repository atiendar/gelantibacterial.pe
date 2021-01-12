<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($productos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          @include('almacen.producto.alm_pro_table.th.id')
          @include('almacen.producto.alm_pro_table.th.sku')
          @include('almacen.producto.alm_pro_table.th.producto')
          @include('almacen.producto.alm_pro_table.th.stock')
          @include('almacen.producto.alm_pro_table.th.proveedor')
          @include('almacen.producto.alm_pro_table.th.precioProveedor')
          @include('almacen.producto.alm_pro_table.th.precioCliente')
          @include('almacen.producto.alm_pro_table.th.categoria')
          @include('almacen.producto.alm_pro_table.th.etiqueta')
          @include('almacen.producto.alm_pro_table.th.existenciaEquivalente')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($productos as $producto)
          <tr title="{{ $producto->sku }}" class="{{ empty($producto->stock < $producto->min_stock) ? '' : 'bg-warning' }}">
            @include('almacen.producto.alm_pro_table.td.id')
            @include('almacen.producto.alm_pro_table.td.sku')
            @include('almacen.producto.alm_pro_table.td.producto', ['id_producto' => Crypt::encrypt($producto->id)])
            @include('almacen.producto.alm_pro_table.td.stock')
            @include('almacen.producto.alm_pro_table.td.proveedor')
            @include('almacen.producto.alm_pro_table.td.precioProveedor')
            @include('almacen.producto.alm_pro_table.td.precioCliente')
            @include('almacen.producto.alm_pro_table.td.categoria')
            @include('almacen.producto.alm_pro_table.td.etiqueta')
            @include('almacen.producto.alm_pro_table.td.existenciaEquivalente')
            @include('almacen.producto.alm_pro_tableOpciones')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>