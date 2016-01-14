<table class="table table-hover table-bordered">
  <tbody>

    <tr>
      <td class="col-xs-3 col-sm-2 publication-detail-label">Description</td>
      <td>{{ $publication->description }}</td>
    </tr>

    <tr>
      <td class="col-xs-3 col-sm-2 publication-detail-label">Author</td>
      <td>{{ $publication->author() }}</td>
    </tr>

    @if(!empty($publication->publish_date))
      <tr>
        <td class="col-xs-3 col-sm-2 publication-detail-label">Date</td>
        <td>{{ $publication->humanReadablePublishDate() }}</td>
      </tr>
    @endif

    <tr>
      <?php
        if ($publication->visibility == 0) {
          $visibility = "private";
        } elseif ($publication->visibility == 1) {
          $visibility = "public";
        } elseif ($publication->visibility == 2) {
          $visibility = "network only";
        }
      ?>
      <td class="col-xs-3 col-sm-2 publication-detail-label">Visibility</td>
      <td style="text-transform:capitalize">{{ $visibility }}</td>
    </tr>

    <?php $publicationsDivisions = $publication->divisions(); ?>
    @if(!empty($publicationsDivisions))
      <tr>
        <td class="col-xs-3 col-sm-2 publication-detail-label">Divisions</td>
        <td>
          @foreach ($publicationsDivisions as $publicationsDivision)
            <a href="{{url('/division/'.$publicationsDivision)}}" >
              <img class="img-circle img-responsive division_{{ $publicationsDivision }}" style="width:18px;height:18px;margin-top:-3px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png">
            </a>
          @endforeach
        </td>
      </tr>
    @endif

    @if(!empty($publication->keywords()))
      <tr>
        <td class="col-xs-3 col-sm-2 publication-detail-label">Keywords</td>
        <td style="text-transform:capitalize">{{ implode(', ', $publication->keywords()) }}</td>
      </tr>
    @endif

    @if(!empty($publication->publisher()))
      <tr>
        <td class="col-xs-3 col-sm-2 publication-detail-label">Publisher</td>
        <td style="text-transform:capitalize">{{ $publication->publisher()}}</td>
      </tr>
    @endif

    @if(!empty($publication->pages()))
      <tr>
        <td class="col-xs-3 col-sm-2 publication-detail-label">Pages</td>
        <td style="text-transform:capitalize">{{ $publication->pages() }}</td>
      </tr>
    @endif

  </tbody>
</table>

<style media="screen">
  .publication-detail-label {
    background-color: #ccc;
    text-align: center;
    padding-bottom: 8px;
    text-transform: uppercase;
  }
</style>
