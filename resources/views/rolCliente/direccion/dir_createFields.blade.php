<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_persona_que_recibe_uno">{{ __('Nombre de la persona que recibe uno') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('nombre_de_la_persona_que_recibe_uno', null, ['class' => 'form-control' . ($errors->has('nombre_de_la_persona_que_recibe_uno') ? ' is-invalid' : ''), 'maxlength' => 80, 'placeholder' => __('Nombre de la persona que recibe uno')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_de_la_persona_que_recibe_uno') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_persona_que_recibe_dos">{{ __('Nombre de la persona que recibe dos') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('nombre_de_la_persona_que_recibe_dos', null, ['class' => 'form-control' . ($errors->has('nombre_de_la_persona_que_recibe_dos') ? ' is-invalid' : ''), 'maxlength' => 80, 'placeholder' => __('Nombre de la persona que recibe dos')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_de_la_persona_que_recibe_dos') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
      {!! Form::number('lada_telefono_fijo', null, ['class' => 'form-control' . ($errors->has('lada_telefono_fijo') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada teléfono fijo')]) !!}
      {!! Form::text('telefono_fijo', null, ['class' => 'form-control' . ($errors->has('telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono fijo')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_fijo') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_fijo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="extension">{{ __('Extensión') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
      </div>
        {!! Form::text('extension', null, ['class' => 'form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Extensión')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('extension') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="telefono_movil">{{ __('Teléfono móvil') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
      </div>
        {!! Form::number('lada_telefono_movil', null, ['class' => 'form-control' . ($errors->has('lada_telefono_movil') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada teléfono móvil')]) !!}
        {!! Form::text('telefono_movil', null, ['class' => 'form-control' . ($errors->has('telefono_movil') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono móvil')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_movil') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_movil') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="calle">{{ __('Calle') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-road"></i></span>
      </div>
        {!! Form::text('calle', null, ['class' => 'form-control' . ($errors->has('calle') ? ' is-invalid' : ''), 'maxlength' => 45, 'placeholder' => __('Calle')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('calle') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="no_exterior">{{ __('No. Exterior') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('no_exterior', null, ['class' => 'form-control' . ($errors->has('no_exterior') ? ' is-invalid' : ''), 'maxlength' => 8, 'placeholder' => __('No. Exterior')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('no_exterior') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="no_interior">{{ __('No. Interior') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('no_interior', null, ['class' => 'form-control' . ($errors->has('no_interior') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('No. Interior')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('no_interior') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="pais">{{ __('País') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('pais', null, ['class' => 'form-control' . ($errors->has('pais') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('País')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('pais') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="ciudad">{{ __('Ciudad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
      </div>
      {!! Form::text('ciudad', null, ['class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Ciudad')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('ciudad') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="colonia">{{ __('Colonia') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('colonia', null, ['class' => 'form-control' . ($errors->has('colonia') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Colonia')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('colonia') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="delegacion_o_municipio">{{ __('Delegación o municipio') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-city"></i></span>
      </div>
      {!! Form::text('delegacion_o_municipio', null, ['class' => 'form-control' . ($errors->has('delegacion_o_municipio') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Delegación o municipio')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('delegacion_o_municipio') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="codigo_postal">{{ __('Código postal') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
      </div>
        {!! Form::text('codigo_postal', null, ['class' => 'form-control' . ($errors->has('codigo_postal') ? ' is-invalid' : ''), 'maxlength' => 6, 'placeholder' => __('Código postal')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('codigo_postal') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="referencias_zona_de_entrega">{{ __('Referencias zona de entrega') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('referencias_zona_de_entrega', null, ['class' => 'form-control' . ($errors->has('referencias_zona_de_entrega') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Referencias zona de entrega'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('referencias_zona_de_entrega') }}</span>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')