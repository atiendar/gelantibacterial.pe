@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar pago'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolCliente.pago.pag_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'rolCliente.pago.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      <strong class="float-right border border-info rounded p-1">
        Datos Bancarios: GFJ PRODUCTS AND SERVICES SA DE CV
        <ul>
          <li>Banco: BBVA Bancomer</li>
          <li>Clabe: 012180001974526161</li>
          <li>Sucursal: 4122</li>
          <li>Cuenta: 0197452616</li>
          <li>SWIT/BIC: BCMRMXMM</li>
        </ul>
      </strong>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="numero_de_pedido">{{ __('Número de pedido') }} *</label>
          <label for="restante_a_pagar" v-text="restante_a_pagar"></label>
          {{ __('Si aún no tienes un numero de pedido favor de mandar tu cotización final firmada al correo contacto@canastasyarcones.mx para que te carguen tu pedido') }}
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-list"></i></span>
            </div>
            {!! Form::select('numero_de_pedido', $num_pedidos, null, ['v-model' => 'numero_de_pedido', 'v-on:change' => 'getFaltanteDePago()', 'class' => 'form-control select2' . ($errors->has('numero_de_pedido') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
          </div>
          <span class="text-danger">{{ $errors->first('numero_de_pedido') }}</span>
        </div>
      </div>
      @include('pago.fPedido.fpe_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('rolCliente.pago.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection

@section('js5')
<script>
  window.onload = function() { 
    getFormaDePago();
  }
  function getFormaDePago() {
    selectFormaDePago           = document.getElementById("forma_de_pago"),
    forma_de_pago               = selectFormaDePago.value;
    div_copia_de_identificacion = document.getElementById('div_copia_de_identificacion');
    div_ultimos_8_digitos_del_folio_de_pago = document.getElementById('div_ultimos_8_digitos_del_folio_de_pago');
    
    if(forma_de_pago == 'Paypal' || forma_de_pago == 'Tarjeta de credito (Pagina)') {
      div_copia_de_identificacion.style.display = 'block';
    } else {
      div_copia_de_identificacion.style.display = 'none';
    }

    if(forma_de_pago != 'Efectivo (Jonathan)' && forma_de_pago != 'Efectivo (Gabriel)' && forma_de_pago != 'Efectivo (Fernando)' && forma_de_pago != '') {
      div_ultimos_8_digitos_del_folio_de_pago.style.display = 'block';
    } else {
      div_ultimos_8_digitos_del_folio_de_pago.style.display = 'none';
    }
  }
  function getMontoDelPago() {
    monto_del_pago = document.getElementById("monto_del_pago").value;
    if (isNaN(parseFloat(monto_del_pago))) {
      monto_del_pago = 0;
    }
    monto_del_pago = Number.parseFloat(monto_del_pago).toFixed(2);
    document.getElementById("monto_del_pago").value = monto_del_pago
  }
</script>
@endsection

@section('vuejs')
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {
      numero_de_pedido: null,
      restante_a_pagar: null
    },
    methods: {
      async getFaltanteDePago() {
        if(this.numero_de_pedido != '') {
          axios.get('/rc/pedido/faltante-de-pago/'+this.numero_de_pedido).then(res => {
            this.restante_a_pagar = 'Restan: $'+res.data+' por pagar para este pedido.'
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
      },
    }
  });
</script>
@endsection