<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="serie">{{ __('Serie') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('serie', [$cotizacion->serie => $cotizacion->serie], $cotizacion->serie, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'disabled']) !!}
    </div>
  </div>
  @include('cotizacion.cot_showFields.validez')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="correo_del_cliente">{{ __('Correo del cliente') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::select('correo_del_cliente', [$cotizacion->cliente->id => $cotizacion->cliente->email_registro], $cotizacion->user_id, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'disabled']) !!}
    </div>
  </div>
  @include('cotizacion.cot_showFields.estatus')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla">{{ __('Describe esta cotización para que sea mas fácil encontrarla') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla', $cotizacion->desc_cot, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Describe esta cotización para que sea mas fácil encontrarla'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios">{{ __('Comentarios') }} ({{ __('Estos aparecerán al generar la cotización') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width "></i></span>
      </div>
      {!! Form::textarea('comentarios', $cotizacion->coment, ['class' => 'form-control' . ($errors->has('comentarios') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentarios'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentarios') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios_ventas">{{ __('Comentarios ventas') }} ({{ _('Estos se guardaran en el pedido') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentarios_ventas', $cotizacion->coment_vent, ['class' => 'form-control' . ($errors->has('comentarios_ventas') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentarios ventas'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentarios_ventas') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('cotizacion.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'cotizacionUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>