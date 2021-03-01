<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
	<table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
		@if(sizeof($stocks) == 0)
			@include('layouts.private.busquedaSinResultados')
		@else
			<thead>
				<tr>
					<th>{{ __('ID') }}</th>
          <th>{{ __('SKU') }}</th>
          <th>{{ __('NOMBRE') }}</th>
					<th>{{ __('STOCK') }}</th>
					<th colspan="2">&nbsp</th>
				</tr>
			</thead>
			<tbody> 
				@foreach($stocks as $stock)
					<tr title={{ $stock->id }}>
						<td width="1rem">{{ $stock->id }}</td>
            <td>{{ $stock->sku  }}</td>
            <td>
              @can('armado.stock.show')
                <a href="{{ route('armado.stock.show', Crypt::encrypt($stock->id)) }}" title="Detalles: {{ $stock->sku }}">{{ $stock->nom  }}</a>
              @else
                {{ $stock->nom  }}
              @endcan
            </td>
						<td>{{ $stock->stock }}</td>
						@include('armado.stock.sto_tableOpciones') 
					</tr>
				@endforeach
			</tbody>
		@endif
	</table>
</div>