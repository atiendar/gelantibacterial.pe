{!! Form::open(['route' => ['cotizacion.armado.producto.store', Crypt::encrypt($armado->id)], 'onsubmit' => 'return checarBotonSubmit("btnCotizacionArmadoProductoStore")', 'class' => 'col-sm-6 float-right']) !!}
{{-- 
<div class="form-group row p-0 m-0">
    <label for="productos" class="col-sm-3 col-form-label">{{ __('Registrar productos') }} *</label>
    <div class="col-sm-9">
      <div class="input-group-append text-dark"> 
        {!! Form::select('id_producto', $productos_list, null, ['class' => 'form-control form-control-sm w-100 select2' . ($errors->has('id_producto') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
        &nbsp&nbsp&nbsp<button type="submit"  id="btnCotizacionArmadoProductoStore" class="btn btn-info rounded" title="{{ __('Registrar') }}"><i class="fas fa-check-circle text-dark"></i></button>
      </div>
      <span class="text-danger">{{ $errors->first('id_producto') }}</span>
    </div>
  </div>
--}}
  <div class="form-group row p-0 m-0">
    <label for="productos" class="col-sm-3 col-form-label">{{ __('Registrar productos') }} *</label>
    <div class="col-sm-9">
      <div class="input-group-append text-dark"> 
        <select name="id_producto"  class="form-control select2" placeholder='Seleccione. . .'>
          <option value="">Seleccione. . .</option>
          @foreach ($productos_list as $producto)
            @if($producto->pro_de_cat == 'Producto de catálogo')
              @php
                $pd_pe = 'PC'
              @endphp
            @else
              @php
                $pd_pe = 'PE'
              @endphp
            @endif
            <option value="{{ $producto->id }}">{{ $producto->produc }} (PP: {{ $producto->prec_prove }}) (PC: {{ $producto->prec_clien }}) [{{ $pd_pe }}]</option>
          @endforeach
        </select>
        &nbsp&nbsp&nbsp<button type="submit"  id="btnCotizacionArmadoProductoStore" class="btn btn-info rounded" title="{{ __('Registrar') }}"><i class="fas fa-check-circle text-dark"></i></button>
      </div>
      <span class="text-danger">{{ $errors->first('id_producto') }}</span>
    </div> 
  </div>
{!! Form::close() !!}