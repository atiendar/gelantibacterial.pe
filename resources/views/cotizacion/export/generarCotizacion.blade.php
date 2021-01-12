<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Cotización {{ $cotizacion->serie }}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="font-family: Segoe UI;">
  <table class="table table-sm table-bordered" style="font-size:12px;">
    <tr>
      <td style="text-align:center">
        <dt><img src="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg  }}" class="brand-image rounded elevation-0" style="width:10rem;"></dt>
        <dt><a href="{{ Sistema::datos()->sistemaFindOrFail()->pag }}" target="_blank">{{ Sistema::datos()->sistemaFindOrFail()->pag }}</a></dt>
        <dt>¡Fortalecemos tus Relaciones Comerciales!</dt>
      </td>
      <td>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->emp }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->direc_uno }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->corr_vent }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_fij }} {{ Sistema::datos()->sistemaFindOrFail()->tel_fij }} ext. {{ Sistema::datos()->sistemaFindOrFail()->ext }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_mov }} {{ Sistema::datos()->sistemaFindOrFail()->tel_mov }}</dt>
      </td>
      <td>
        <dt><h5>{{ $cotizacion->serie }}</h5></dt>
        <dt>Validez: {{ $cotizacion->valid }}</dt>
        <dt>Atención a: {{ $cotizacion->cliente->nom }} ({{ $cotizacion->cliente->email_registro }})</dt>
        <dt>Fecha de Cotización: {{ $cotizacion->created_at }}</dt>
      </td>
    </tr>
  </table>

  @if(sizeof($armados) == 0)
  @else 
    <table class="table table-hover table-striped table-sm table-bordered" style="font-size:12px;">
      <thead class="thead-dark">
        <tr>
          <th>IMG</th>
          <th>TIPO</th>
          <th>SKU</th>
          <th>DESCRIPCIÓN</th>
          <th>CANT.</th>
          <th>PRECIO UNIT.</th>
          <th>COST. ENVIO</th>
          @if($cotizacion->desc > 0)
            <th>DESCUENTO</th>
          @endif
          <th>SUBTOTAL</th>
          <th>IVA</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          <tr>
            <td>
              @if($armado->ya_mod == '0')<br>
                <img src="{{ $armado->img_rut.$armado->img_nom }}" style="width:5rem">
              @endif
            </td>
            <td>{{ $armado->tip }}</td>
            <td>{{ $armado->sku }}</td>
            <td>
              <strong>{{ $armado->nom }}</strong><br>
                @foreach($armado->productos as $producto)
                  <div class="input-group text-muted ml-2">
                    <p class="m-0">{{ $producto->cant }} - {{ $producto->produc }}</p>
                  </div>
                @endforeach
            </td>
            <td>{{ Sistema::dosDecimales($armado->cant) }}</td>
            <td>${{ Sistema::dosDecimales($armado->prec_redond) }}</td>
            <td>
              ${{ Sistema::dosDecimales($armado->cost_env) }}
              <a href="{{ route('costoDeEnvio.opcionesCostos', Crypt::encrypt($armado->id)) }}" target="_blank">Ver otros costos de envío</a>
            </td>
            @if($cotizacion->desc > 0)
              <td>${{ Sistema::dosDecimales($armado->desc) }}</td>
            @endif
            <td>${{ Sistema::dosDecimales($armado->sub_total) }}</td>
            <td>${{ Sistema::dosDecimales($armado->iva) }}</td>
            <td>${{ Sistema::dosDecimales($armado->tot) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <table class="table table-hover table-striped table-sm table-bordered" style="font-size:12px;">
      <thead class="thead-dark">
        <tr>
          <th colspan="2"><center>RESUMEN DE LA COTIZACIÓN</center></th>
        </tr>
      </thead>
      <tbody> 
        <tr style="text-align:right;">
          <td>CANT. TOTAL</td>
          <td>{{ Sistema::dosDecimales($cotizacion->tot_arm) }}</td>
        </tr>
        <tr style="text-align:right;">
          <td> COST. ENVIO</td>
          <td>${{ Sistema::dosDecimales($cotizacion->cost_env) }}</td>
        </tr>
        @if($cotizacion->desc > 0)
          <tr style="text-align:right;">
            <td>DESCUENTO</td>
            <td>${{ Sistema::dosDecimales($cotizacion->desc) }}</td>
          </tr>
        @endif
        <tr style="text-align:right;">
          <td>SUBTOTAL</td>
          <td>${{ Sistema::dosDecimales($cotizacion->sub_total) }}</td>
        </tr>
        <tr style="text-align:right;">
          <td>IVA</td>
          <td>${{ Sistema::dosDecimales($cotizacion->iva) }}</td>
        </tr>
        <tr style="text-align:right;">
          <td>TOTAL</td>
          <td>${{ Sistema::dosDecimales($cotizacion->tot) }}</td>
        </tr>
        @if($cotizacion->con_iva == 'on')
          <tr style="font-size:17px;">
            <td>
              <a href="{{ route('rolCliente.factura.create') }}" target="_blank">Para solicitar factura clic aquí</a>
            </td>
            <td>
              <img src="https://s3-us-west-2.amazonaws.com/archivos.arconesycanastas/sistema/icono_tarjetas_credito.png"class="brand-image elevation-0" style="width:3.5rem;">
              <img src="https://s3-us-west-2.amazonaws.com/archivos.arconesycanastas/sistema/icono_paypal.png"class="brand-image elevation-0" style="width:3.5rem;">
              @if($cotizacion->con_com == 'on')
                <a href="https://www.paypal.me/canastasyarcones/{{ Sistema::dosDecimales($cotizacion->tot) }}" target="_blank">Para pago con tarjeta clic aquí, comisión incluida del 5% ${{ Sistema::dosDecimales($cotizacion->tot) }}</a>
              @else
                <a href="https://www.paypal.me/canastasyarcones/{{ Sistema::dosDecimales($cotizacion->tot*1.05) }}" target="_blank">Para pago con tarjeta clic aquí, comisión incluida del 5% ${{ Sistema::dosDecimales($cotizacion->tot*1.05) }}</a>
              @endif
            </td>
          </tr>
        @endif

        @if($cotizacion->coment != null)
          <tr>
            <td colspan="2">
              <dt>{{ $cotizacion->coment }}</dt>
            </td>
          </tr>
        @endif

      </tbody>
    </table>
  @endif
  @include('correo.'.Sistema::datos()->sistemaFindOrFail()->plant_cot_term_cond, ['nombre_de_la_empresa' => Sistema::datos()->sistemaFindOrFail()->emp])
</body>
</html>