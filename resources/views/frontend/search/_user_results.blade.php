<div class="panel">

  <div class="panel-heading">
    <span class="panel-title">Members</span>
  </div>

  <div class="panel-body">
    <table class="table mbn">

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
            <span class="fa fa-circle text-info fs14 mr10"></span>{{ $user['first_name'] }}
          </td>
          <td class="fs15 fw600 text-right">{{ $user['last_name'] }}</td>
        </tr>
        @empty
          <br>No users to show<br>
        @endforelse
      </tbody>

    </table>
  </div>

</div>
