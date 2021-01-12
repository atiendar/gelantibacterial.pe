<td>
  @if($show == true)
    @canany($canany)
      <a href="{{ route($ruta, Crypt::encrypt($pago->id)) }}" title="Detalles: {{ $pago->cod_fact }}" {{ $target }}>{{ $pago->cod_fact }}</a>
    @else
      {{ $pago->cod_fact }}
    @endcanany
  @else
    {{ $pago->cod_fact }}
  @endif
</td>