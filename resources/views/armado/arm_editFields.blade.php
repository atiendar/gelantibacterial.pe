<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="input-group justify-content-center">
      @if($armado->img_nom != null)
        <img src="{{ $armado->img_rut.$armado->img_nom }}" class="profile-user-img img-fluid" alt="{{ $armado->img_nom }}">
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar catálogo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', $tipo_list, $armado->tip, ['class' => 'form-control select2' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre">{{ __('Nombre') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
      </div>
        {!! Form::text('nombre', $armado->nom, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Nombre')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('sku', $armado->sku , ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('SKU')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('sku') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="gama">{{ __('Gama') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar catálogo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
      </div>
      {!! Form::select('gama', $gamas_list, $armado->gama, ['class' => 'form-control select2' . ($errors->has('gama') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('gama') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="destacado">{{ __('Destacado') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-star"></i></span>
      </div>
      {!! Form::select('destacado', config('opcionesSelect.select_destacado'), $armado->dest, ['class' => 'form-control select2' . ($errors->has('destacado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
    <span class="text-danger">{{ $errors->first('destacado') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="url_pagina">{{ __('URL página') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-link"></i></span>
      </div>
        {!! Form::text('url_pagina', $armado->url_pagina, ['class' => 'form-control' . ($errors->has('url_pagina') ? ' is-invalid' : ''), 'maxlength' => 150, 'placeholder' => __('URL página')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('url_pagina') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_minima_de_stock">{{ __('Cantidad mínima de stock') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('cantidad_minima_de_stock',  $armado->min_stock, ['class' => 'form-control' . ($errors->has('cantidad_minima_de_stock') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Cantidad mínima de stock')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cantidad_minima_de_stock') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="maximo">{{ __('Máximo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('maximo',  $armado->max, ['class' => 'form-control' . ($errors->has('maximo') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Máximo')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('maximo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="imagen_del_armado">{{ __('Imagen') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('imagen_del_armado', ['id' => 'imagen_del_armado', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_del_armado", "visualizar-imagen_del_armado")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('imagen_del_armado') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <center>
      <figure>
        <div id="visualizar-imagen_del_armado"></div>
      </figure>
    </center>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="precio_de_compra">{{ __('Precio de compra') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
        {!! Form::text('precio_de_compra', Sistema::dosDecimales($armado->prec_de_comp), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio de compra'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="descuento_especial">{{ __('Descuento especial') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('descuento_especial', $armado->desc_esp, ['id' => 'descuento_especial', 'class' => 'form-control' . ($errors->has('descuento_especial') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Descuento especial'), 'onChange' => 'dosDecimales();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('descuento_especial') }}</span>
  </div>
</div>
@section('js6')
<script>
  function dosDecimales() {
    // Obtiene los valores de los inputs
    descuento_especial = document.getElementById("descuento_especial").value;

    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(descuento_especial))) {
      descuento_especial = 0;
    }

    // Agrega o solo deja dos decimales
    descuento_especial_decimal  = Number.parseFloat(descuento_especial).toFixed(2);

    // Pega el resultado en los inputs
    document.getElementById("descuento_especial").value = descuento_especial_decimal;
  }
</script>
@endsection
<div class="row">
  @include('armado.arm_showFields.precioOriginal')
  @include('armado.arm_showFields.precioRedondeado')
</div>
@include('armado.arm_showFields.medidas')
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('observaciones', $armado->obs, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
  </div>
</div>