<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>Excerpt</th>
  </tr>
</thead>

<tbody>
  @forelse($articleResults as $article)
    <tr>
      <td class="">
        {{ $article['title'] }}<br>
        <p class="text-muted">
          {{ $article['publish_date'] }}
        </p>
      </td>
      {{-- <td class="text-muted text-right">
        {{ $article['excerpt'] }}
      </td> --}}
    </tr>
  @empty
    <br>No users to show<br>
  @endforelse
</tbody>
