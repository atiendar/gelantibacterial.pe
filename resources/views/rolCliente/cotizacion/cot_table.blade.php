<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($cotizaciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th></th>
          @include('cotizacion.cot_table.th.serie')
          @include('cotizacion.cot_table.th.numPedGen')
          @include('cotizacion.cot_table.th.estatus')
          @include('cotizacion.cot_table.th.validez')
          @include('cotizacion.cot_table.th.total')
        </tr>
      </thead>
      <tbody> 
        @foreach($cotizaciones as $cotizacion)
          <tr title="{{ $cotizacion->serie }}">
            <td>
              @if($cotizacion->con_com == 'on')
                <a href="https://www.paypal.me/canastasyarcones/{{ Sistema::dosDecimales($cotizacion->tot) }}" target="_blank">
                  <img src="https://s3-us-west-2.amazonaws.com/archivos.arconesycanastas/sistema/icono_paypal.png"class="brand-image elevation-0" style="width:3rem;">
                  {{ Sistema::dosDecimales($cotizacion->tot) }}
                </a>
              @else
                <a href="https://www.paypal.me/canastasyarcones/{{ Sistema::dosDecimales($cotizacion->tot*1.05) }}" target="_blank">
                  <img src="https://s3-us-west-2.amazonaws.com/archivos.arconesycanastas/sistema/icono_paypal.png"class="brand-image elevation-0" style="width:3rem;">
                  {{ Sistema::dosDecimales($cotizacion->tot*1.05) }}
                </a>
              @endif
            </td>
            <td>
              <a href="{{ route('rolCliente.cotizacion.show', Crypt::encrypt($cotizacion->id)) }}" title="Detalles: {{ $cotizacion->serie }}">{{ $cotizacion->serie }}</a>
            </td>
            @include('cotizacion.cot_table.td.numPedGen')
            @include('cotizacion.cot_table.td.estatus')
            @include('cotizacion.cot_table.td.validez')
            @include('cotizacion.cot_table.td.total')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>