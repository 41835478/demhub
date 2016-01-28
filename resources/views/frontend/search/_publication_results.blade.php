<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>#</th>
  </tr>
</thead>

<tbody>
  @forelse($publicationResults as $publication)
    <tr>
      <td>

        <a href="{{ URL::to('publication/' . $publication['id'] . '/view') }}">
          {{ $publication['name'] }}
        </a>
        {{-- <span class="fa fa-circle text-info fs14 mr10"></span> --}}
      </td>
      <td class="text-muted text-right">{{ \App\Http\Components\Helpers::author($publication) }}</td>
    </tr>
  @empty
    <br>No publications to show<br>
  @endforelse
</tbody>
