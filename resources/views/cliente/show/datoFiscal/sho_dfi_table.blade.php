<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($datos_fiscales) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('RFC') }}</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($datos_fiscales as $dato_fiscal)
          <tr title="{{ $dato_fiscal->id }}">
            <td>{{ $dato_fiscal->id }}</td>
            <td>{{ $dato_fiscal->rfc }}</td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>