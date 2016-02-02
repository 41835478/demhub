<?php // NOTE - Logic to handle items by type, class, subclass and view
use App\Http\Components\Helpers;
use App\Models\Division;
if(! isset($item)) { $item=null; };
if (!is_array($item) && get_class($item) == 'content') {
    $array = [
      'id'            => $item->id,
      'subclass'      => $item->subclass,
      'name'          => $item->name,
      'description'   => $item->description,
      'divisions'     => $item->divisions(),
      'keywords'      => $item->keywords(),
      'slug'          => $item->slug,
      'url'           => $item->url,
      'country'       => $item->country,
      'state'         => $item->state,
      'city'          => $item->city,
      'lat'           => $item->lat,
      'lng'           => $item->lng,
      'pinned_by'     => $item->pinned_by,
      'pinned_at'     => $item->pinned_at,
      'visibility'    => $item->visibility,
      'status_flag'   => $item->status_flag,
      'owner_id'      => $item->owner_id,
      'deleted'       => $item->deleted,
      'publish_date'  => $item->publish_date,
      'created_at'    => $item->created_at,
      'updated_at'    => $item->updated_at,
    ];

    switch ($item->subclass) {
      case 'article':
        $array = [
          'language' => $item->language(),
          'type' => $item->type()
        ];
        break;

      case 'infoResource':
        // nothing
        break;

      case 'publication':
        $array = [
          'volume'      => $item->volume(),
          'issues'      => $item->issues(),
          'pages'       => $item->pages(),
          'publisher'   => $item->publisher(),
          'institution' => $item->institution(),
          'conference'  => $item->conference(),
          'author'      => $item->author(),
          'favorites'   => $item->favorites(),
          'views'       => $item->views()
        ];
        break;

      case 'thread':
        $array = [
          'view_count' => $item->view_count
        ];
        break;

      default:
        // nothing
        break;
    }
  }
  // Elastic search result
  elseif(! empty($item)) {
      $divisions = array();
      foreach (Helpers::convertDBStringToArray($item['divisions']) as $divID) {
          $div = Division::findOrFail($divID);
          $divisions[$div->slug] = $div->name;
      }
      $item['divisions'] = $divisions;
      $item['keywords'] = Helpers::convertDBStringToArray($item['keywords']);
  }
?>

@if((!is_array($item) && get_class($item) == 'content') || (isset($item['subclass'])))
  @if(isset($type) && $type == 'teaser')
    @include('frontend.card.__content-teaser')
  @else
    @include('frontend.card.__content-card')
  @endif
@else
  <?php $user = \App\Models\Access\User\User::find($item['id']); ?>
  @if(isset($type) && $type == 'teaser')
    @include('frontend.user.__user-teaser')
  @else
    @include('frontend.user.__user-card-partial')
  @endif
@endif
