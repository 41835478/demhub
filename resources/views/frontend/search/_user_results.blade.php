<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>#</th>
  </tr>
</thead>

<tbody>
  @forelse($userResults as $user)
  <tr>
    <td>
      {{-- <span class="fa fa-circle text-info fs14 mr10"></span> --}}
      <a href="{{ URL::to('profile/' . $user['user_name']) }}">
        {{$user['first_name']}} {{$user['last_name']}}
      </a>
    </td>
    <td class="text-muted text-right">{{ $user['job_title'] }}</td>
  </tr>
  @empty
    <br>No users to show<br>
  @endforelse
</tbody>
