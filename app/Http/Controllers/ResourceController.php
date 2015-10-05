<?php

namespace DEMHub\Http\Controllers;

use Illuminate\Http\Request;
use DEMHub\Http\Requests;
use DEMHub\Http\Controllers\Controller;

class ResourceController extends Controller {

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
