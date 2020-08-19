<div class="row">
  <div class="form-group col-sm btn-sm" id="metodo_de_entrega_espesifico" style="display:none">
    <label for="metodo_de_entrega_espesifico">{{ __('Método de entrega espesifico') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='metodo_de_entrega_espesifico' v-on:change='displatNumeroDeGuia()' class ='form-control' data-old='{{ old('metodo_de_entrega_espesifico')}}' name='metodo_de_entrega_espesifico'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega_esp in metodos_de_entrega_espesificos" v-bind:value="metodo_de_entrega_esp" v-text="metodo_de_entrega_esp"></option>
      </select>
    </div>
    <span v-if="errors.metodo_de_entrega_espesifico" class="text-danger" v-text="errors.metodo_de_entrega_espesifico[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="paqueteria" style="display:none">
    <label for="paqueteria">{{ __('Paquetería') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='paqueteria' class ='form-control' data-old='{{ old('paqueteria')}}' name='paqueteria'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega_esp in paqueterias" v-bind:value="metodo_de_entrega_esp" v-text="metodo_de_entrega_esp"></option>
      </select>
    </div>
    <span v-if="errors.paqueteria" class="text-danger" v-text="errors.paqueteria[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="numero_de_guia"  style="display:none">
    <label for="numero_de_guia">{{ __('Número de guia') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('numero_de_guia', null, ['v-model' => 'numero_de_guia', 'class' => 'form-control', 'maxlength' => 60, 'placeholder' => __('Número de guia')]) !!}
    </div>
    <span v-if="errors.numero_de_guia" class="text-danger" v-text="errors.numero_de_guia[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comprobante_de_salida">{{ __('Comprobante de salida') }}</label>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="custom-file"> 
      {!! Form::file('imagen', ['v-on:change' => 'getImage', 'id' => 'file', 'class' => 'custom-file-input', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
      <label class="custom-file-label" for="archivo">Max. 1MB</label>
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <input type=button value="{{ __('Capturar foto') }}" v-on:click="capturarFoto()" class="btn btn-info w-100 p-2">
  </div>
  <div class="form-group col-sm btn-sm">
    <input type=button value="{{ __('Quitar foto') }}" v-on:click="quitarFoto()" class="btn btn-info w-100 p-2">
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
      {!! Form::hidden('mydata', null, ['id' => 'mydata', 'class' => 'form-control']) !!}
      <div id="my_camera"></div>
      <div id="results"></div>
    <span v-if="errors.comprobante_de_entrega" class="text-danger" v-text="errors.comprobante_de_entrega[0]"></span>
  </div>
</div>