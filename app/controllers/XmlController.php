<?php 
class XmlController extends BaseController {

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
		

		/****logic to update and store xml feed****/

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
		/****************************/
		
		$category = Xmlcategories::where('id', '=', $id)
									->get();
		$discussion = Conversation::where('xml_category_feed_id', '=', $id)
									->where('hidden', '=', 'false')
									->orderBy('updated_at', 'desc')
									->paginate(5);

		$cat = Xmlcategories::all();

		if ($category){
			return View::make('guest/division')
						->with('category', $category)
						->with('cats', $cat)
						->with('discussions', $discussion);
		}
		else {
			return Redirect::route('home');
		}
	}

	public function xml(){
		
		$urls = Xml::all();
		
		foreach ($urls as $value) {
			# code...
			//print_r($value->url);
			$url = $value->url;
			$xml=file_get_contents($url);
			//print_r($xml);
			$feed = simplexml_load_string($xml);
			$ns=$feed->getNameSpaces(true);

			foreach ($feed->channel->item as $value) {
				# code...
				echo '<pre>';
				var_dump($value);
				echo '</pre>';
				echo "<strong>$value->title</strong>";
				echo "<br>";

				foreach ($value->description as $val) {
					# code...
					echo $val;
					echo '<br>';
				}
				foreach ($value->category as $va) {
					# code...
					echo $va;
					echo '<br>';
					// echo '<pre>';
					// print_r($va);
					// echo '</pre>';
				}
			}
		}

		// $url = 'http://www.samaritan-international.eu/feed/';
		// $xml=file_get_contents($url);

		// $feed = simplexml_load_string($xml);
		// $ns=$feed->getNameSpaces(true);

		// foreach ($feed->channel->item as $value) {
		// 	# code...
		// 	echo $value->title;
		// 	echo "<br>";

		// 	foreach ($value->description as $val) {
		// 		# code...
		// 		echo $val;
		// 		echo "<br>";
		// 	}
		// }		

	}

}