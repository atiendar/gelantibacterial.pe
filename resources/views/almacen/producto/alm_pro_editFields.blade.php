<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="input-group justify-content-center">
      @if($producto->img_prod_rut != null)
        <img src="{{ $producto->img_prod_rut.$producto->img_prod_nom }}" class="profile-user-img img-fluid" alt="{{ $producto->img_prod_nom }}">
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="imagen_del_producto">{{ __('Imagen del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('imagen_del_producto', ['id' => 'imagen_del_producto', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_del_producto", "visualizar-imagen_del_producto")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('imagen_del_producto') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <center>
      <figure>
        <div id="visualizar-imagen_del_producto"></div>
      </figure>
    </center>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_producto">{{ __('Nombre del producto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('nombre_del_producto', $producto->produc, ['class' => 'form-control' . ($errors->has('nombre_del_producto') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Nombre del producto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_producto') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
      </div>
      {!! Form::text('sku', $producto->sku, ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('SKU')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('sku') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="es_producto_de_catalogo">{{ __('Es producto de catálogo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::select('es_producto_de_catalogo', config('opcionesSelect.select_producto_de_catalogo'), $producto->pro_de_cat, ['class' => 'form-control select2' . ($errors->has('es_producto_de_catalogo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('es_producto_de_catalogo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="marca">{{ __('Marca') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('marca', $producto->marc, ['class' => 'form-control' . ($errors->has('marca') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Marca')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('marca') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', [$producto->tip => $producto->tip], $producto->tip, ['id' => 'tipo', 'class' => 'form-control disabled' . ($errors->has('tipo') ? ' is-invalid' : ''), 'readonly' => 'readonly']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo') }}</span>
  </div>
</div>
<div id="medidas">
  @if($producto->tip == 'Canasta')
    <label for="redes_sociales">{{ __('MEDIDAS') }}</label>
    <div class="border border-primary rounded p-2">
      <div class="row">

        <div class="form-group col-sm btn-sm">
          <label for="tamano">{{ __('Tamaño') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::select('tamano', config('opcionesSelect.select_tamano'), $producto->tam, ['class' => 'form-control select2' . ($errors->has('tamano') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
            </div>
          <span class="text-danger">{{ $errors->first('tamano') }}</span>
        </div>


        <div class="form-group col-sm btn-sm">
          <label for="alto">{{ __('Alto') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('alto', $producto->alto, ['id' => 'alto', 'class' => 'form-control' . ($errors->has('alto') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Alto'), 'onChange' => 'getAlto();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
          <span class="text-danger">{{ $errors->first('alto') }}</span>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="ancho">{{ __('Ancho') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('ancho', $producto->ancho, ['id' => 'ancho', 'class' => 'form-control' . ($errors->has('ancho') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Ancho'), 'onChange' => 'getAncho();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
          <span class="text-danger">{{ $errors->first('ancho') }}</span>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="largo">{{ __('Largo') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('largo', $producto->largo, ['id' => 'largo', 'class' => 'form-control' . ($errors->has('largo') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Largo'), 'onChange' => 'getLargo();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
          <span class="text-danger">{{ $errors->first('largo') }}</span>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="costo_de_armado">{{ __('Costo de armado') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
            </div>
            {!! Form::text('costo_de_armado', $producto->cost_arm, ['id' => 'costo_de_armado', 'class' => 'form-control' . ($errors->has('costo_de_armado') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Costo de armado'), 'onChange' => 'calcularPecioCliente();']) !!}
            <div class="input-group-append">
              <span class="input-group-text">.00</span>
            </div>
          </div>
          <span class="text-danger">{{ $errors->first('costo_de_armado') }}</span>
        </div>
      </div>
    </div>
  @endif
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_proveedor">{{ __('Nombre del proveedor') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('nombre_del_proveedor', $proveedores_list, $producto->prove, ['id' => 'nombre_del_proveedor', 'class' => 'form-control select2' . ($errors->has('nombre_del_proveedor') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'calcularPecioCliente();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_proveedor') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_proveedor">{{ __('Precio proveedor') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_proveedor', $producto->prec_prove, ['id' => 'precio_proveedor', 'class' => 'form-control disabled' . ($errors->has('precio_proveedor') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Precio proveedor'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('precio_proveedor') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="utilidad">{{ __('Utilidad') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::select('utilidad', config('opcionesSelect.select_utilidad'), $producto->utilid, ['id' => 'utilidad', 'class' => 'form-control disabled' . ($errors->has('utilidad') ? ' is-invalid' : ''), 'placeholder' => __(''), 'disabled']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('utilidad') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_cliente">{{ __('Precio cliente') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_cliente', $producto->prec_clien, ['id' => 'precio_cliente', 'class' => 'form-control disabled' . ($errors->has('precio_cliente') ? ' is-invalid' : ''), 'placeholder' => __('Precio cliente'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('precio_cliente') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="categoria">{{ __('Categoría') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar catálogo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('categoria', $categorias_list, $producto->categ, ['class' => 'form-control select2' . ($errors->has('categoria') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('categoria') }}</span>
  </div>
  <div class="form-group col-sm-6 btn-sm">
    <label for="etiqueta">{{ __('Etiqueta') }}</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar catálogo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('etiqueta', $etiquetas_list, $producto->etiq, ['class' => 'form-control select2' . ($errors->has('etiqueta') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('etiqueta') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="peso">{{ __('Peso') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-weight"></i></span>
      </div>
      {!! Form::text('peso', $producto->pes, ['id' => 'peso', 'class' => 'form-control' . ($errors->has('peso') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Peso'), 'onChange' => 'getPeso();']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">Kg</i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('peso') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="frecuencia">{{ __('Frecuencia') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('frecuencia', Sistema::dosDecimales($producto->armados()->count()), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Frecuencia'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="codigo_de_barras">{{ __('Código de barras') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-barcode"></i></i></span>
      </div>
      {!! Form::text('codigo_de_barras', $producto->cod_barras, ['class' => 'form-control' . ($errors->has('codigo_de_barras') ? ' is-invalid' : ''), 'maxlength' => 250, 'placeholder' => __('Código de barras')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('codigo_de_barras') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_minima_de_stock">{{ __('Cantidad mínima de stock') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('cantidad_minima_de_stock', $producto->min_stock, ['class' => 'form-control' . ($errors->has('cantidad_minima_de_stock') ? ' is-invalid' : ''), 'maxlength' => 5, 'placeholder' => __('Cantidad mínima de stock')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cantidad_minima_de_stock') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion_del_producto">{{ __('Descripción del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion_del_producto', $producto->desc_del_prod, ['class' => 'form-control' . ($errors->has('descripcion_del_producto') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Descripción del producto'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('descripcion_del_producto') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('almacen.producto.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'almacenProductoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('almacen.producto.alm_pro_calcularUtilidad')
@include('almacen.producto.alm_pro_getDecimal')
@section('css')
<style>
  #tipo:disabled {
    background: #ccc;
  }
</style>
@endsection
@section('js6')
<script>
  function calcularPecioCliente() {
    nombre_del_proveedor = document.getElementById("nombre_del_proveedor"),
    nombre_del_proveedor = nombre_del_proveedor.value;
    if(nombre_del_proveedor != '' && nombre_del_proveedor != 0) {
      axios.get("/almacen/producto/precio-proveedor", {
        params: {
          nombre_del_proveedor: nombre_del_proveedor,
          id_producto: '{{ Crypt::encrypt($producto->id) }}'
        }
      }).then(res => {
        // Obtiene los valores de los inputs
        selectTipo = document.getElementById("tipo"),
        tipo = selectTipo.value;

        // Asigna el valor al input costo de armado dependoendo la seleccion del input tipo
        if(tipo == 'Canasta') {
          costo_de_armado = document.getElementById("costo_de_armado").value;
          if (isNaN(parseFloat(costo_de_armado))) {
            costo_de_armado = 0;
          }
        } else if(tipo == 'Producto' || tipo == '') {
          costo_de_armado = 0;
        }
        // ---

        precio_cliente = calculaUtilidad(res.data.prec_prove, res.data.utilid, costo_de_armado);

        precio_cliente_decimal = Number.parseFloat(precio_cliente).toFixed(2);
        costo_de_armado_decimal = Number.parseFloat(costo_de_armado).toFixed(2);

        $("#costo_de_armado").val(costo_de_armado_decimal);
        $("#precio_proveedor").val(res.data.prec_prove);
        $("#utilidad").val(res.data.utilid);
        $("#precio_cliente").val(precio_cliente_decimal);
      }).catch(error => {
        Swal.fire({
          icon: 'error',
          title: 'Algo salio mal',
          text: error,
        })
      });

/*

      $.get("/almacen/producto/precio-proveedor/" + nombre_del_proveedor + "/" + '{{ Crypt::encrypt($producto->id) }}' + "", function(response, state) {
        // Obtiene los valores de los inputs
        selectTipo = document.getElementById("tipo"),
        tipo = selectTipo.value;

        // Asigna el valor al input costo de armado dependoendo la seleccion del input tipo
        if(tipo == 'Canasta') {
          costo_de_armado = document.getElementById("costo_de_armado").value;
          if (isNaN(parseFloat(costo_de_armado))) {
            costo_de_armado = 0;
          }
        } else if(tipo == 'Producto' || tipo == '') {
          costo_de_armado = 0;
        }
        // ---

        precio_cliente = calculaUtilidad(response.prec_prove, response.utilid, costo_de_armado);

        precio_cliente_decimal = Number.parseFloat(precio_cliente).toFixed(2);
        costo_de_armado_decimal = Number.parseFloat(costo_de_armado).toFixed(2);

        $("#costo_de_armado").val(costo_de_armado_decimal);
        $("#precio_proveedor").val(response.prec_prove);
        $("#utilidad").val(response.utilid);
        $("#precio_cliente").val(precio_cliente_decimal);
      });

      */
    }
  }
</script>
@endsection