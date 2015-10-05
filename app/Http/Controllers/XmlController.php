<?php

namespace DEMHub\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use DEMHub\Http\Requests;
use DEMHub\Http\Controllers\Controller;
use DEMHub\Models\Xmlcategories as Xmlcategories;
use DEMHub\Models\Xml as Xml;
use DEMHub\Models\Conversation as Conversation;
use SimplePie;

class XmlController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default XML Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'XmlController@');
	|
	*/

	public function division($id){
		$category = Xmlcategories::where('id', '=', $id)
								->get();

		// $content = $this -> update_feed($category);
		// $this -> store_feed($category, $content, $id);
		$feed_urls_array = Xml::where('category_id', '=', $id)
            						->lists('url')->all();

		$feed = $this -> simplepie_feed($feed_urls_array);

		$discussions = Conversation::where('xml_category_feed_id', '=', $id)
									->where('hidden', '=', 'false')
									->orderBy('updated_at', 'desc')
									->paginate(5);

		$cats = Xmlcategories::all();

		if ($category){
			return view('guest/division')
						->with('category', $category)
						->with('cats', $cats)
						->with('discussions', $discussions)
						->with('feed', $feed);
		}
		else {
			return Redirect::url('home');
		}
	}

	public function xml(){

		$urls = Xml::all();

		foreach ($urls as $value) {
			//print_r($value->url);
			$url = $value->url;
			$xml=file_get_contents($url);
			//print_r($xml);
			$feed = simplexml_load_string($xml);
			$ns=$feed->getNameSpaces(true);

			foreach ($feed->channel->item as $value) {
				echo '<pre>';
				var_dump($value);
				echo '</pre>';
				echo "<strong>$value->title</strong>";
				echo "<br>";

				foreach ($value->description as $val) {
					echo $val;
					echo '<br>';
				}
				foreach ($value->category as $va) {
					echo $va;
					echo '<br>';
					// echo '<pre>';
					// print_r($va);
					// echo '</pre>';
				}
			}
		}

	}

 	private function update_feed($category) {
		$content = array();
		foreach ($category as $cat) {
			foreach ($cat->xmlfeed as $feed) {
				# code...
				$url = $feed->url;
				$xml=file_get_contents($url);
				//print_r($xml);
				$feed = simplexml_load_string($xml);
				$ns=$feed->getNameSpaces(true);
				foreach ($feed->channel->item as $value) {
					# code...
					//push it to a blank array
					array_push($content, $value);
					//description
					foreach ($value->description as $val) {
					}
					//keywords
					foreach ($value->category as $va) {
					}
				}
			}
		}
		return $content;
	}

	private function store_feed($category, $content, $id) {
		foreach ($content as $val) {
			# code...
			$origDate = $val->pubDate;
			$newDate = strtotime($origDate);

			$update = Xmlcategoryfeed::where('title', '=', $val->title)
									->where('pubDate', '=', $newDate)
									->first();

			if (is_null($update)){
				$create = new Xmlcategoryfeed;
				$create->category_id = $id;
				$category->hidden = false;
				$create->title = $val->title;

				if (is_object($val->link)){
					foreach ($val->link as $lnk) {
						# code...
						$create->link = $lnk;
					}
				}
				else {
					$create->link = $val->link;
				}
				if (is_object($val->description)){
					foreach ($val->description as $descr) {
						# code...
						$create->desc = $descr;
					}
				}
				else {
					$create->desc = $val->description;
				}
				if (is_object($val->category)){
					foreach ($val->category as $va) {
						# code...
						$create->keywords = $va.';';
					}
				}
				else {
					$create->keywords = $val->category;
				}
				$create->pubDate = $newDate;
				$create->updated_at = app('currentDT');
				$create->created_at = app('currentDT');
				$create->save();
			}
		}
	}

	private function simplepie_feed($feed_urls_array) {
		$feed = new SimplePie();
		$feed->set_feed_url($feed_urls_array);
		$feed->enable_cache(false);
		// $feed->set_cache_location('mysql://'.getenv('DATABASE_USERNAME').':'.getenv('DATABASE_PASSWORD').'@'.getenv('DATABASE_HOST').':3306/'.getenv('DATABASE_NAME').'?prefix=sp_');
		//$feed->set_cache_location('mysql://root:root@localhost:3306/demhub_v3?prefix=sp_');
		$feed->set_cache_location('mysql://forge:R0SDQrIB8oWjyf5fuUUM@localhost:3306/demhubprod?prefix=sp_');
		$feed->set_cache_duration(60*60);
		$feed->set_output_encoding('utf-8');
		$feed->init();
		$feed->handle_content_type();
		return $feed;
	}

}
