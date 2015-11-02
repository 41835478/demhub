<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Components\ScraperComponent;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class ArticleController extends Controller
{

	/**
	 * Browse function for browsing (searching) articles
	 *
	 * @param Request $request $_GET variables defining the request. The list of variables accepted are:
	 * 'division':  (optional) division ID default 0 for all
	 * 'data':		(optional) search query
	 * 'location':	(optional) location string i.e. Toronto or '298 Dundas St W' or Canada or anything really
	 * 'page':		(optional) page number defaults to 1
	 * 'count':		(optional) items per page defaults to 50
	 * 'radius':	(optional) km (approximate) defaults to 150km
	 *
	 */
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

		if(trim($options_data) != ''){
			$keywords = explode(' ', $options_data);
			foreach($keywords as $keyword){
				$query = $query->whereRaw("(`title` LIKE ? OR `keywords` LIKE ?)", array('%'.$keyword.'%', '%|'.$keyword.'|%'));
			}
		}


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

		// TODO add view to render items. Can use $items, $item_count, $total_count, and $last_page
		// for debug
		echo '<form action="/article/browse" method="GET"><input type="hidden" name="count" value="1000"><input type="text" name="data"><input type="submit" value="search" ></form>';
		echo $query->toSql();
		echo '<br><br>';
		echo 'found: '.$total_count.' items';
		foreach($items as $item)
		{
			echo '<br><b>Item id '.$item->id.': '.$item->title.'</b> Divisions: '.$item->divisions.' | '.$item->excerpt;
		}
		//echo '<br>'.($last_page).'<br>';

	}

	/**
	 * Takes up to 3 keywords through $_GET and returns 3 separate article lists related to those keywords
	 *
	 * @param Request $request Request containing GET variables defining the request, which are:
	 * 'keyword_1'	(optional) first keyword
	 * 'keyword_2'	(optional) second keyword
	 * 'keyword_3'	(optional) third keyword
	 * 'page':		(optional) page number defaults to 1
	 * 'count':		(optional) items per page defaults to 50
	 *
	 */
	public function stream(Request $request)
	{
		$keywords[] = 		$request->input('keyword_1', null);
		$keywords[] = 		$request->input('keyword_2', null);
		$keywords[] = 		$request->input('keyword_3', null);
		$options_page = 	$request->input('page', 1);			// (optional) page number defaults to 1
		$options_count = 	$request->input('count', 50);		// (optional) items per page defaults to 50

		$data = array();
		$index = 0;		// to manually keep track of index in case of dismissed/missing keywords
		foreach($keywords as $i=>$keyword){
			if($keyword != null){
				$query = DB::table('articles')->select("*");
				$query = $query->where('deleted', 0);
				$query = $query->whereRaw("(`title` LIKE ? OR `keywords` LIKE ?)", array('%'.$keyword.'%', '%|'.$keyword.'|%'));
				$query = $query->orderBy('publish_date', 'desc');
				$total_count = $query->count();
				$query = $query->skip( ($options_page - 1) * $options_count );
				$query = $query->take( $options_count );
				$items = $query->get();

				$data[$index]['keyword'] = $keyword;
				$data[$index]['count'] = count($items);
				$data[$index]['last_page'] = $data[$index]['count'] < $options_count;
				$data[$index]['total_count'] = $total_count;
				$data[$index]['items'] = $items;
				$index++;
			}
		}


		// TODO add view to render items in the $data array. Can use $data[]['keyword'], $data[]['items'], $data[]['count'], and $data[]['last_page']
		// for debug
		echo $query->toSql();
		foreach($data as $i=>$d){
			echo '<br><b>Dataset '.($i+1).' for keyword: '.$d['keyword'].'</b>';
			foreach($d['items'] as $item)
			{
				echo '<br> '.$item->divisions.' ----- '.$item->title;
			}
			echo '<br>Last page: '.(int)$d['last_page'].'<br>';
		}

	}

}