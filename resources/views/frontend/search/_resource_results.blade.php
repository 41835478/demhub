<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>#</th>
  </tr>
</thead>

<tbody>
  @forelse($resourceResults as $resource)
    <tr>
      <td>
        {{-- <span class="fa fa-circle text-info fs14 mr10"></span> --}}
        <a target="_blank" href="{{ $resource['url'] }}">
          {{ $resource['name'] }}
        </a>
      </td>
      {{-- <td class="text-muted text-right">
        {{ $resource['country'] }}, {{ $resource['region'] }}
      </td> --}}
    </tr>
  @empty
    <br>No resources to show<br>
  @endforelse
</tbody>
