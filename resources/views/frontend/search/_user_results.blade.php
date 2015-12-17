<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>#</th>
  </tr>
</thead>

<tbody>
  @forelse($userResults as $user)
  <tr>
    <td class="va-m fw600 text-muted">
      {{-- <span class="fa fa-circle text-info fs14 mr10"></span> --}}
      <a href="{{ URL::to('profile/' . $user['user_name']) }}" style="color:#000">
        {{$user['first_name']}} {{$user['last_name']}}
      </a>
    </td>
    <td class="fs15 fw600 text-right">{{ $user['job_title'] }}</td>
  </tr>
  @empty
    <br>No users to show<br>
  @endforelse
</tbody>
