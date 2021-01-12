<nav class="navbar navbar-expand-lg pt-1">
  <button class="navbar-toggler border rounded" type="button" data-toggle="collapse" data-target="#buscador" aria-controls="buscador" aria-expanded="false" aria-label="Toggle navigation">
  <span class="fas fa-search"> {{ __('Buscador') }}</span>
  </button>
  <div class="collapse navbar-collapse" id="buscador">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <div class="input-group input-group-sm" style="width: 13em;">
          {{ __('Mostrar') }} 
          &nbsp{!! Form::select('paginador', ['15' => '15', '30' => '30', '50' => '50'], empty($num_pag) ? __('15') :  $num_pag, ['class' => 'form-control btn-sm w-25', 'onchange' => 'this.form.submit()']) !!}&nbsp 
          {{ __('registros') }}.
          <span class="text-danger">{{ $errors->first('paginador') }}</span>
        </div>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
      <div class="input-group input-group-sm">
        {!! Form::select('opcion_buscador', $opciones_buscador, null, ['class' => 'form-control float-right']) !!}
        {!! Form::text('buscador', null, ['class' => 'form-control float-right', 'placeholder' =>  __('Buscador'), 'title' => __('Enter para buscar')]) !!}
        <div class="input-group-append">
          <a href="{{ $ruta_recarga }}" class="btn btn-default" title="{{ __('Mostrar todos los registros') }}"><i class="fas fa-spinner"></i></a>
        </div>
      </div>
      <span class="pantallaMax985px">
        <button type="submit" class="btn btn-outline-success btn-sm my-2 my-sm-0 ml-3"><i class="fas fa-search"></i> {{ __('Buscar') }}</button>
      </span>
    </div>
  </div>
</nav>