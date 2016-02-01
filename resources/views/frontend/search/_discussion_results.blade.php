<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>#</th>
  </tr>
</thead>

<tbody>
  @forelse($discussionResults as $discussion)
  <tr>
    <td class="va-m fw600 text-muted">
      <span class="fa fa-circle text-info fs14 mr10"></span>{{ $discussion['name'] }}
    </td>
    <td class="fs15 fw600 text-right">{{ $discussion['name'] }}</td>
  </tr>
  @empty
    <br>No discussions to show<br>
  @endforelse
</tbody>
