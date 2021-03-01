<td width="1rem" title="Editar: {{ $stock->nom }}">
  @canany(['armado.stock.aumentarStock', 'armado.stock.disminuirStock'])
    <a href="{{ route('armado.stock.edit', Crypt::encrypt($stock->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>