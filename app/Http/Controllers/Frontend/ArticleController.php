<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Components\ScraperComponent;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class ArticleController extends Controller
{

	public function browse(Request $request)
	{
		$options_division = $request->input('division', 0);		// (optional) division ID default 0 for all
		$options_data = 	$request->input('data', '');		// (optional) search query
		$options_location = $request->input('location', '');	// (optional) location string i.e. Toronto or '298 Dundas St W' or Canada or anything really
		//$options_sort = 	$request->input('sort', 'date');	// (optional) 'date' (not currently used since there's only one option)
		$options_page = 	$request->input('page', 1);			// (optional) page number defaults to 1
		$options_count = 	$request->input('count', 50);		// (optional) items per page defaults to 50
		$options_radius = 	$request->input('radius', 150);		// (optional) km (approximate) defaults to 150km

		$query = DB::table('articles')->select("*");
		$query = $query->where('deleted', 0);

		if($options_division != 0)
			$query = $query->where('divisions', 'LIKE', '%|'.$options_division.'|%');

		if(trim($options_data) != '')
			$query = $query->whereRaw("(`title` LIKE ? OR `keywords` LIKE ?)", array('%'.$options_data.'%', '%|'.$options_data.'|%'));

		if(trim($options_location) !== '')
		{
			// lat lng method
			$coords = ScraperComponent::getCoords($options_location);

			// if location info not found (or google api request limit reached)
			if($coords['lat'] == null || $coords['lng'] == null)
			{
				// backup method: compare texts only
				$query = $query->whereRaw("( LOWER(city) LIKE ? OR LOWER(state) LIKE ? OR LOWER(country) LIKE ? )",
											array('%'.$options_location.'%', '%'.$options_location.'%', '%'.$options_location.'%'));
			}
			else
			{
				$deg_difference = ($options_radius/111)/2; 			// 111 => km/deg of latitude
				$lat_bound_l = (double)$coords['lat'] - $deg_difference;
				$lat_bound_h = (double)$coords['lat'] + $deg_difference;
				$lng_bound_l = (double)$coords['lng'] - $deg_difference;
				$lng_bound_h = (double)$coords['lng'] + $deg_difference;

				$query = $query->whereRaw(
					'('
					.' lat IS NOT NULL AND lng IS NOT NULL'
					.' AND lat > '.$lat_bound_l
					.' AND lat < '.$lat_bound_h
					.' AND lng > '.$lng_bound_l
					.' AND lng < '.$lng_bound_h
					.') OR ('
					.' LOWER(city) LIKE ? OR LOWER(state) LIKE ? OR LOWER(country) LIKE ? '
					.')',
					array('%'.$options_location.'%', '%'.$options_location.'%', '%'.$options_location.'%'));
			}
		}

		$query = $query->orderBy('publish_date', 'desc');
		$total_count = $query->count();
		$query = $query->skip( ($options_page - 1) * $options_count );
		$query = $query->take( $options_count );
		$items = $query->get();

		$item_count = count($items);
		$last_page = $item_count < $options_count;

		// for debug
//		echo $query->toSql();
//		foreach($items as $item)
//		{
//			echo '<br> '.$item->divisions.' ----- '.$item->title;
//		}
//		echo '<br>'.(int)$last_page.'<br>'.$total_count;

		// TODO add view to render items. Can use $items, $item_count, $total_count, and $last_page
	}

}