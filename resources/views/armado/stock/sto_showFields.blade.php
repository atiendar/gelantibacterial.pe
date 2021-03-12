@include('armado.arm_showFields.imagen')
<div class="row">
  @include('armado.arm_showFields.tipo')
  @include('armado.arm_showFields.nombre')
</div>
<div class="row">
  @include('armado.arm_showFields.sku')
  @include('armado.arm_showFields.gama')
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
  <div class="form-group col-sm btn-sm">
    <label for="ya_vendido">{{ __('Ya vendido') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('ya_vendido',  $armado->ya_vendido, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ya vendido'), 'readonly' => 'readonly']) !!}
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
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('armado.stock.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection