{!! Form::open(['route' => ['cotizacion.armado.store', Crypt::encrypt($cotizacion->id)], 'onsubmit' => 'return checarBotonSubmit("btnCotizacionArmadoStore")', 'class' => 'col-sm-6 float-right']) !!}
 {{-- 
  <div class="form-group row p-0 m-0">
    <label for="armados" class="col-sm-3 col-form-label">{{ __('Agregar armado') }} *</label>
    <div class="col-sm-9">
      <div class="input-group-append text-dark">
        {!! Form::select('id_armado', $armados_list, null, ['class' => 'form-control form-control-sm w-100 select2' . ($errors->has('id_armado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
        &nbsp&nbsp&nbsp<button type="submit" id="btnCotizacionArmadoStore" class="btn btn-info rounded" title="{{ __('Agregar') }}"><i class="fas fa-check-circle text-dark"></i></button>
      </div>
      <span class="text-danger">{{ $errors->first('id_armado') }}</span>
    </div>
  </div>
--}}
  <div class="form-group row p-0 m-0">
    <label for="armados" class="col-sm-3 col-form-label">{{ __('Agregar armado') }} *</label>
    <div class="col-sm-9">
      <div class="input-group-append text-dark"> 
        <select name="id_armado"  class="form-control select2" placeholder='Seleccione. . .'>
          <option value="">Seleccione. . .</option>
          @foreach ($armados_list as $armado)
            <option value="{{ $armado->id }}">{{ $armado->nom }} ({{ $armado->sku }})</option>
          @endforeach
        </select>
        &nbsp&nbsp&nbsp<button type="submit"  id="btnCotizacionArmadoProductoStore" class="btn btn-info rounded" title="{{ __('Agregar') }}"><i class="fas fa-check-circle text-dark"></i></button>
      </div>
      <span class="text-danger">{{ $errors->first('id_armado') }}</span>
    </div> 
  </div>
{!! Form::close() !!}