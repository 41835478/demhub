<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>#</th>
  </tr>
</thead>

<tbody>
  @forelse($publicationResults as $publication)
    <tr>
      <td class="va-m fw600 text-muted">
        {{-- <span class="fa fa-circle text-info fs14 mr10"></span> --}}
        {{ $publication['title'] }}
      </td>
      <td class="fs15 fw600 text-right">{{ $publication['publication_author'] }}</td>
    </tr>
  @empty
    <br>No publications to show<br>
  @endforelse
</tbody>
