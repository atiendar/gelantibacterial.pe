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
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('created_at', $producto->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_prod">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_prod', $producto->created_at_prod, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="updated_at">{{ __('Fecha última modificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('updated_at', $producto->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_prod">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_prod', $producto->updated_at_prod, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_producto">{{ __('Nombre del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('nombre_del_producto', $producto->produc, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Nombre del producto'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
      </div>
      {!! Form::text('sku', $producto->sku, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('SKU'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="marca">{{ __('Marca') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('marca', $producto->marc, ['class' => 'form-control', 'maxlength disable' => 0, 'placeholder' => __('Marca'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', config('opcionesSelect.select_tipo'), $producto->tip, ['id' => 'tipo', 'class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly', 'onChange' => 'calcularUtilidad();']) !!}
    </div>
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
            {!! Form::select('tamano', config('opcionesSelect.select_tamano'), $producto->tam, ['class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
            </div>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="alto">{{ __('Alto') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('alto', Sistema::dosDecimales($producto->alto), ['id' => 'alto', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Alto'), 'readonly' => 'readonly', 'onChange' => 'getAlto();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="ancho">{{ __('Ancho') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('ancho', Sistema::dosDecimales($producto->ancho), ['id' => 'ancho', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Ancho'), 'readonly' => 'readonly', 'onChange' => 'getAncho();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="largo">{{ __('Largo') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('largo', Sistema::dosDecimales($producto->largo), ['id' => 'largo', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Largo'), 'readonly' => 'readonly', 'onChange' => 'getLargo();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="costo_de_armado">{{ __('Costo de armado') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
            </div>
            {!! Form::text('costo_de_armado', Sistema::dosDecimales($producto->cost_arm), ['id' => 'costo_de_armado', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Costo de armado'), 'readonly' => 'readonly', 'onChange' => 'getCostoDeArmado();']) !!}
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="vendidos">{{ __('Vendidos') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('vendidos', Sistema::dosDecimales($producto->vend), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Vendidos'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_vendida">{{ __('Cantidad vendida') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('cantidad_vendida', Sistema::dosDecimales($producto->vend), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Cantidad vendida'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="stock">{{ __('Stock') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('stock', Sistema::dosDecimales($producto->stock), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Stock'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="existencia_equivalente">{{ __('Existencia equivalente') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('existencia_equivalente', Sistema::dosDecimales($existencia_equivalente), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Existencia equivalente'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_proveedor">{{ __('Nombre del proveedor') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('nombre_del_proveedor', [$producto->prove => $producto->prove], $producto->prove, ['class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_proveedor">{{ __('Precio proveedor') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_proveedor', Sistema::dosDecimales($producto->prec_prove), ['id' => 'precio_proveedor', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Precio proveedor'), 'readonly' => 'readonly']) !!}
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
      {!! Form::select('utilidad', config('opcionesSelect.select_utilidad'), $producto->utilid, ['id' => 'utilidad', 'class' => 'form-control disable select2', 'placeholder' => __(''), 'disabled']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_cliente">{{ __('Precio cliente') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_cliente', Sistema::dosDecimales($producto->prec_clien), ['id' => 'precio_cliente', 'class' => 'form-control disabled', 'placeholder' => __('Precio cliente'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="categoria">{{ __('Categoría') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('categoria', [$producto->categ => $producto->categ], $producto->categ, ['class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm-6 btn-sm">
    <label for="etiqueta">{{ __('Etiqueta') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('etiqueta', [$producto->etiq => $producto->etiq], $producto->etiq, ['class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="peso">{{ __('Peso') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-weight"></i></span>
      </div>
      {!! Form::text('peso', Sistema::tresDecimales($producto->pes), ['id' => 'peso', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Peso'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">Kg</i></span>
      </div>
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="frecuencia">{{ __('Frecuencia') }}</label>
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
      {!! Form::text('codigo_de_barras', $producto->cod_barras, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Código de barras'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_minima_de_stock">{{ __('Cantidad mínima de stock') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('cantidad_minima_de_stock', $producto->min_stock, ['class' => 'form-control disable', 'maxlength' => 5, 'placeholder' => __('Cantidad mínima de stock'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion_del_producto">{{ __('Descripción del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion_del_producto', $producto->desc_del_prod, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Descripción del producto'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('almacen.producto.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@include('almacen.producto.alm_pro_calcularUtilidad')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection