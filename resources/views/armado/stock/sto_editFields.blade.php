<div class="row">
  @can('armado.stock.aumentarStock')
    <div class="col-sm">
      <div class="card {{ empty($stock->stock < $stock->min_stock) ? config('app.color_card_primario') : config('app.color_card_warning') }} card-outline card-tabs position-relative bg-white">
        <div class="card-body">
          {!! Form::open(['route' => ['armado.stock.aumentarStock', Crypt::encrypt($stock->id)], 'method' => 'patch', 'id' => 'armadoStockAumentarStock']) !!}
            <div class="form-group row">
              <label for="aumentar_stock" class="col-sm-4 col-form-label">{{ __('Aumentar stock') }} ({{ Sistema::dosDecimales($stock->stock) }}) *</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                  </div>
                    {!! Form::text('aumentar_stock', null, ['class' => 'form-control' . ($errors->has('aumentar_stock') ? ' is-invalid' : ''), 'maxlength' => 8, 'placeholder' => __('Aumentar stock')]) !!}
                  <button type="submit" id="btnsubmit1" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit1', 'armadoStockAumentarStock', '¡Alerta!', '¿Estás seguro quieres aumentar el stock de este producto?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i></button>
                </div>
                <span class="text-danger">{{ $errors->first('aumentar_stock') }}</span>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  @endcan
  @can('armado.stock.disminuirStock')
    <div class="col-sm">
      <div class="card {{ empty($stock->stock < $stock->min_stock) ? config('app.color_card_primario') : config('app.color_card_warning') }} card-outline card-tabs position-relative bg-white">
        <div class="card-body">
          {!! Form::open(['route' => ['armado.stock.disminuirStock', Crypt::encrypt($stock->id)], 'method' => 'patch', 'id' => 'armadoStockDisminuirStock']) !!}
            <div class="form-group row">
              <label for="disminuir_stock" class="col-sm-4 col-form-label">{{ __('Disminuir stock') }} ({{ Sistema::dosDecimales($stock->stock) }}) *</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sort-numeric-down-alt"></i></span>
                  </div>
                  {!! Form::text('disminuir_stock', null, ['class' => 'form-control' . ($errors->has('disminuir_stock') ? ' is-invalid' : ''), 'maxlength' => 8, 'placeholder' => __('Disminuir stock')]) !!}
                  <button type="submit" id="btnsubmit2" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit2', 'armadoStockDisminuirStock', '¡Alerta!', '¿Estás seguro quieres disminuir el stock de este producto?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i></button>
                </div>
                <span class="text-danger">{{ $errors->first('disminuir_stock') }}</span>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  @endcan

</div>