@include('armado.arm_showFields.imagen')
@include('armado.arm_showFields.created')
<div class="row">
  @include('armado.arm_showFields.tipo')
  @include('armado.arm_showFields.nombre')
</div>
<div class="row">
  @include('armado.arm_showFields.sku')
  @include('armado.arm_showFields.gama')
</div>
<div class="row">
  @include('armado.arm_showFields.destacado')
  @include('armado.arm_showFields.urlPagina')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="stock">{{ __('Stock') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('stock',  $armado->stock, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Stock'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_minima_de_stock">{{ __('Cantidad mínima de stock') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('cantidad_minima_de_stock',  $armado->min_stock, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Cantidad mínima de stock'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="maximo">{{ __('Máximo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('maximo',  $armado->max, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Máximo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="pedido_a_planta">{{ __('Pedido a planta') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('pedido_a_planta',  $armado->ped_a_plant, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Pedido a planta'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  @include('armado.arm_showFields.precioDeCompra')
  @include('armado.arm_showFields.descuentoEspecial')
</div>
<div class="row">
  @include('armado.arm_showFields.precioOriginal')
  @include('armado.arm_showFields.precioRedondeado')
</div>
@include('armado.arm_showFields.medidas')
@include('armado.arm_showFields.observaciones')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection