<div class="panel">

  <div class="panel-heading">
    <span class="panel-title">Resources</span>
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
        @forelse($resourceResults as $resource)
        <tr>
          <td class="va-m fw600 text-muted">
            <span class="fa fa-circle text-info fs14 mr10"></span>{{ $resource['name'] }}
          </td>
          <td class="fs15 fw600 text-right">{{ $resource['name'] }}</td>
        </tr>
        @empty
          <br>No resources to show<br>
        @endforelse
      </tbody>

    </table>
  </div>

</div>
