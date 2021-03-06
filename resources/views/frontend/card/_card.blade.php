<?php // NOTE - Logic to handle items by type, class, subclass and view
    use App\Http\Components\Helpers;
    use App\Models\Division;

    if (!isset($item)) {
        $item = null;
    };

    // Content model
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
                    'language'  => $item->language(),
                    'type'      => $item->type(),
                ];
                break;

            case 'infoResource':
                // nothing
                break;

            case 'publication':
                $array = [
                    'volume'        => $item->volume(),
                    'issues'        => $item->issues(),
                    'pages'         => $item->pages(),
                    'publisher'     => $item->publisher(),
                    'institution'   => $item->institution(),
                    'conference'    => $item->conference(),
                    'author'        => $item->author(),
                    'favorites'     => $item->favorites(),
                    'views'         => $item->views(),
                ];
                break;

            case 'thread':
                $array = [
                    'view_count'    => $item->view_count,
                ];
                break;

            default:
                // nothing
                break;
        }
    }
    // User model
    elseif (!is_array($item) && get_class($item) == 'user') {
        //do nothing
    } elseif (!empty($item) && is_array($item) && !isset($item['subclass'])) {
        $item = \App\Models\Access\User\User::find($item['id']);
    }
    // Elastic search result for content
    //TODO check logcial operation
    elseif (is_array($item) || isset($item['subclass'])) {
        $divs = array();
        if (!is_array($item['divisions'])) {
            foreach (Helpers::convertDBStringToArray($item['divisions']) as $divID) {
                $div = Division::findOrFail($divID);
                $divs[$div->slug] = $div->name;
            }
            $item['divisions'] = $divs;
        }

        if (!is_array($item['keywords'])) {
            $item['keywords'] = Helpers::convertDBStringToArray($item['keywords']);
        }
    } elseif (isset($item->division) && !is_array($item->division)) {
        $divisions = array();

        foreach (Helpers::convertDBStringToArray($item->division) as $divID) {
            $div = Division::findOrFail($divID);
            $divisions[$div->slug] = $div->name;
        }
        $item->division = $divisions;
    }
?>



@if((!is_array($item) && get_class($item) == 'content') || (isset($item['subclass'])))

    @if(isset($type) && $type == 'teaser')
        @include('frontend.card.__content-teaser')
    @else
        @include('frontend.card.__content-summary')
    @endif

@else
    @if(isset($type) && $type == 'teaser')
        @include('frontend.card.__user-teaser', ['user'=>$item])
    @else
        @include('frontend.card.__user-summary', ['user'=>$item])
    @endif
@endif
