<?php
class ResourceController extends BaseController {
	
	// public function country($desiredData){
// 		$countryEntryIds = ResourceRelation::where('entry_id', '=', $desiredData)
// 								->get();
//
// 		// $content = $this -> update_feed($category);
// 		// $this -> store_feed($category, $content, $id);
//
// 		$feed_urls_array = Xml::where('category_id', '=', $desiredData)
//             						->lists('url');
//
// 		$feed = $this -> simplepie_feed($feed_urls_array);
//
// 		$discussions = Conversation::where('xml_category_feed_id', '=', $desiredData)
// 									->where('hidden', '=', 'false')
// 									->orderBy('updated_at', 'desc')
// 									->paginate(5);
//
// 		$cats = Xmlcategories::all();
//
// 		if ($category){
// 			return View::make('guest/division')
// 						->with('category', $category)
// 						->with('cats', $cats)
// 						->with('discussions', $discussions)
// 						->with('feed', $feed);
// 		}
// 		else {
// 			return Redirect::route('home');
// 		}
// 	}
//
// 	public function division($id){
// 			$category = Xmlcategories::where('id', '=', $id)
// 									->get();
//
//
// 			/****logic to update and store xml feed****/
//
// 			$content = array();
// 			foreach ($category as $cat) {
// 				foreach ($cat->xmlfeed as $feed) {
// 					# code...
// 					$url = $feed->url;
// 					$xml=file_get_contents($url);
// 					//print_r($xml);
// 					$feed = simplexml_load_string($xml);
// 					$ns=$feed->getNameSpaces(true);
// 					foreach ($feed->channel->item as $value) {
// 						# code...
// 						//push it to a blank array
// 						array_push($content, $value);
// 						//description
// 						foreach ($value->description as $val) {
// 						}
// 						//keywords
// 						foreach ($value->category as $va) {
// 						}
// 					}
// 				}
// 			}
// 			foreach ($content as $val) {
// 				# code...
// 				$origDate = $val->pubDate;
// 				$newDate = strtotime($origDate);
//
// 				$update = Xmlcategoryfeed::where('title', '=', $val->title)
// 										->where('pubDate', '=', $newDate)
// 										->first();
//
// 				if (is_null($update)){
// 					$create = new Xmlcategoryfeed;
// 					$create->category_id = $id;
// 					$category->hidden = false;
// 					$create->title = $val->title;
//
// 					if (is_object($val->link)){
// 						foreach ($val->link as $lnk) {
// 							# code...
// 							$create->link = $lnk;
// 						}
// 					}
// 					else {
// 						$create->link = $val->link;
// 					}
// 					if (is_object($val->description)){
// 						foreach ($val->description as $descr) {
// 							# code...
// 							$create->desc = $descr;
// 						}
// 					}
// 					else {
// 						$create->desc = $val->description;
// 					}
// 					if (is_object($val->category)){
// 						foreach ($val->category as $va) {
// 							# code...
// 							$create->keywords = $va.';';
// 						}
// 					}
// 					else {
// 						$create->keywords = $val->category;
// 					}
// 					$create->pubDate = $newDate;
// 					$create->updated_at = app('currentDT');
// 					$create->created_at = app('currentDT');
// 					$create->save();
// 				}
// 			}
// 			/****************************/
//
// 			$category = Xmlcategories::where('id', '=', $id)
// 										->get();
// 			$discussion = Conversation::where('xml_category_feed_id', '=', $id)
// 										->where('hidden', '=', 'false')
// 										->orderBy('updated_at', 'desc')
// 										->paginate(5);
//
// 			$cat = Xmlcategories::all();
//
// 			if ($category){
// 				return View::make('guest/division')
// 							->with('category', $category)
// 							->with('cats', $cat)
// 							->with('discussions', $discussion);
// 			}
// 			else {
// 				return Redirect::route('home');
// 			}
// 		}

	public function ResourceCountry($choiceValue){
		
			$resourceRelation = ResourceEntry::all();
		
			foreach ($resourceRelation as $value) {
				# code...
				//print_r($value->url);
				$id = $value->entry_id;
				$country = $value->country;
				// $xml=file_get_contents($url);
				//print_r($xml);
				// $feed = simplexml_load_string($xml);
// 				$ns=$feed->getNameSpaces(true);
				if ($country = $choiceValue){
					echo 'value number '.$id.'';
				}
				
			
				}
			}
	public function ResourceFilter($choiceValue){
		$resourceRelation = ResourceEntry::all();
		$resourceSelects = ResourceEntry::where('country', '=', 'united-states')
							->get();
		return $resourceSelects;
	}
	
}
