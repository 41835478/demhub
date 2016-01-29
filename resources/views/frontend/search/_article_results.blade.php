<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>Excerpt</th>
  </tr>
</thead>

<tbody>
  @forelse($articleResults as $article)
    <tr>
      <td>
        <a target="_blank" href="{{ $article['url'] }}">
          {{ $article['name'] }}
        </a>
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
