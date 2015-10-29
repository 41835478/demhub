<?php
/**
 * Created by PhpStorm.
 * User: Poya
 * Date: 28/10/15
 * Time: 1:49 PM
 */

namespace App\Http\Components;

use App\Models\ArticleDetail;
use Nathanmac\Utilities\Parser\Parser;
use App\Models\Article;
use App\Models\Keyword;
use App\Models\NewsFeed;
use App\Models\ScrapeSource;


class ScraperComponent
{

	const itemTypeNewsArticle = 1;
	const itemTypeScientificPaper = 2;
	const itemTypeOther = 9;



	////////////////////////////
	////      HELPERS
	////////////////////////////

	/**
	 * This function takes in a string and tries to determine related tags and divisions based on a set of provided keyword models
	 *
	 * @param string $text Text to be analyzed
	 * @param /App/Models/Keyword $all_keywords A complete list of keywords models available (this is to speed up processing when dealing with many keywords)
	 * @return array containing a sorted arrays for keywords as well as divisions
	 */
	public static function guessKeywords($text, $all_keywords)
	{
		$sensitivity = 1;		// min number of occurances required for a keyword/division to be returned
		$result = array();
		$all_divisions = array();
		$divisions_raw = array();
		$keywords = array();
		$divisions = array();

		//black lists
		$ignore = array("am","you","is","are","i","they","them","they're","it","it's","its","you're","i'm","&");
		$remove = array("!",",",":",";","@","#","?","(",")","*",".","\"","/",'"',"%","&");

		//break string into words and remove duplicates
		//$words = array_unique(explode(' ', str_replace($remove, " ", strtolower($text))));
		$words = explode(' ', str_replace($remove, " ", strtolower($text)));

		//pre-set the categories array
		foreach($all_keywords as $i=>$key){
			if(!isset($result[$key->keyword])){
				$result[$key->keyword] = 0;
				$all_divisions[$key->keyword] = self::convertDBStringToArray($key->divisions);
			}
		}

		//go through all words
		foreach ($words as $wi=>$word)
		{
			//remove extra characters
			//$word = str_replace($remove, "", $word);

			//check ignore list
			if(!in_array($word, $ignore))
			{

				$phrase_double1 = isset($words[$wi+1]) ? $word.' '.$words[$wi+1] : null;
				$phrase_double2 = isset($words[$wi-1]) ? $words[$wi-1].' '.$word : null;
				$phrase_triple1 = isset($words[$wi+1])&&isset($words[$wi+2]) ? $word.' '.$words[$wi+1].' '.$words[$wi+2] : null;
				$phrase_triple2 = isset($words[$wi-1])&&isset($words[$wi+1]) ? $words[$wi-1].' '.$word.' '.$words[$wi+1] : null;
				$phrase_triple3 = isset($words[$wi-1])&&isset($words[$wi-2]) ? $words[$wi-2].' '.$words[$wi-1].' '.$word : null;
				$temp_divs = array();

				if(isset($result[$word])){ $result[$word]++; $temp_divs = $all_divisions[$word]; }
				elseif($phrase_double1 != null && isset($result[$phrase_double1])){ $result[$phrase_double1]++; $temp_divs = $all_divisions[$phrase_double1]; }
				elseif($phrase_double2 != null && isset($result[$phrase_double2])){ $result[$phrase_double2]++; $temp_divs = $all_divisions[$phrase_double2]; }
				elseif($phrase_triple1 != null && isset($result[$phrase_triple1])){ $result[$phrase_triple1]++; $temp_divs = $all_divisions[$phrase_triple1]; }
				elseif($phrase_triple2 != null && isset($result[$phrase_triple2])){ $result[$phrase_triple2]++; $temp_divs = $all_divisions[$phrase_triple2]; }
				elseif($phrase_triple3 != null && isset($result[$phrase_triple3])){ $result[$phrase_triple3]++; $temp_divs = $all_divisions[$phrase_triple3]; }

				foreach($temp_divs as $div)
				{
					if(!isset($divisions_raw[$div]))
						$divisions_raw[$div] = 1;
					else
						$divisions_raw[$div]++;
				}

			}
		}

		arsort($result);
		foreach ($result as $i=>$r){
			if($r >= $sensitivity) $keywords[] = $i;
		}
		//if(empty($keywords)) $keywords[] = NULL;

		arsort($divisions_raw);
		array_slice($divisions_raw, 0, 3); 				//allow up to 2 only
		foreach ($divisions_raw as $i=>$r){
			if($r >= $sensitivity) $divisions[] = $i;
		}

		return array('keywords'=>$keywords, 'divisions'=>$divisions);
	}

	/**
	 * Standard function to convert an int/string array to format optimized for search needed to be stored in db
	 *
	 * @param array $array data to be converted to storable string
	 * @return string
	 */
	public static function convertDBArrayToString($array)
	{
		$return = "|";
		$return .= implode('|', $array);
		$return .= "|";

		if(empty($array)) $return = '';

		return $return;
	}

	/**
	 * A standard function to convert a stored DB array in form of a string back to the original array.
	 *
	 * @param string $string String data obtained from DB
	 * @return array
	 */
	public static function convertDBStringToArray($string)
	{
		$array = explode('|', $string);
		foreach($array as $i=>$item){
			if($item === '' || $item === null) unset($array[$i]);
		}

		return $array;
	}

	/**
	 * Generates a standard url safe slug given any string
	 *
	 * @param string $text
	 * @return string
	 */
	public static function generateSlug($text)
	{
		$remove = array("!",",",":",";","@","#","?","(",")","*",".","\"","/",'"',"%","&");
		$return = strtolower(str_replace(' ', '-', str_replace($remove,'',$text)));

		return $return;
	}

	/**
	 * Limits the character count of a long string to a certain count (def 255) and adds "..." if string is truncated.
	 * Returns the truncated string that doesnt not exceed the char count provided
	 *
	 * @param string $string original
	 * @param int $len Length of the desired string
	 * @return string
	 */
	public static function truncate($string, $len=255){
		if($string == null)
			return "";
		if(strlen($string)>($len-3)){
			$string = substr($string, 0, $len-3);
			$string .= '...';
			return $string;
		} else {
			return $string;
		}
	}

	/**
	 * Gets information such as Sublocal, city, state, and country from google API from a set of Lat & Lng
	 *
	 * @param double $lat Latitude
	 * @param double $lng longitude
	 *
	 * @return array
	 */
	public static function getLocationInfo($lat, $lng)
	{
		$session = curl_init('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&sensor=false&key=');
		// Tell cURL to return the request data
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
		// Execute cURL on the session handle
		$response = curl_exec($session);
		$results = json_decode($response);
		curl_close($session);

		$result = array('sublocal'=>null,'city'=>null,'state'=>null,'country'=>null);

		if($results->status === 'OK')
		{
			foreach($results->results as $res){
				if(in_array('locality', $res->types)){
					foreach($res->address_components as $comp){
						if(in_array('sublocality', $comp->types)) $result['sublocal'] = $comp->long_name;
						if(in_array('locality', $comp->types)) $result['city'] = $comp->long_name;
						if(in_array('administrative_area_level_1', $comp->types)){ $result['state'] = $comp->long_name; }
						elseif(in_array('administrative_area_level_2', $comp->types)) { $result['state'] = $comp->long_name; }
						if(in_array('country', $comp->types)) $result['country'] = $comp->long_name;
					}
				}
			}
			if($result['city'] == null) $result['city'] = $result['sublocal'];
			if($result['city'] == NULL){
				foreach($results->results as $res){

					foreach($res->address_components as $comp){
						if(in_array('sublocality', $comp->types)) $result['sublocal'] = $comp->long_name;
						if(in_array('locality', $comp->types)) $result['city'] = $comp->long_name;
						if(in_array('administrative_area_level_1', $comp->types)) $result['state'] = $comp->long_name;
						if(in_array('country', $comp->types)) $result['country'] = $comp->long_name;
					}

				}


			}
		}
		if($result['city'] == null) $result['city'] = $result['sublocal'];
		$result['lat'] = (double)$lat;
		$result['lng'] = (double)$lng;

		return $result;
	}

	/**
	 * getCoords
	 *
	 * Gets coordinates of a given location
	 *
	 * @param string $address address
	 *
	 * @return array lat, lng, type, status
	 */
	public static function getCoords($address){
//		$rest = new RESTClient();
//		//
//		// Google api free tier has limit of 2,500 request per day and returns null if exceeded
//		//
//		$rest->initialize(array('server'=>'https://maps.googleapis.com'));
//		$rest->option(CURLOPT_SSL_VERIFYPEER, false);
//		$info = $rest->get('maps/api/geocode/json', array('address'=>urlencode($address), 'sensor'=>false, 'key'=>param('GOOGLE_GCM_API_KEY')));
//		$result = json_decode($info);
//
//		$return = array('lat'=>null,'lng'=>null,'type'=>null,'status'=>$result->status);
//
//		if($result->status === 'OK'){
//			$res = $result->results;
//			$return['lat'] = $res[0]->geometry->location->lat;
//			$return['lng'] = $res[0]->geometry->location->lng;
//			$return['type'] = $res[0]->geometry->location_type;
//		}
//
//		return $return;
	}

	/**
	 * Just a quick func to verify if a variable is set and if not set it to a default
	 *
	 * @param mixed $var Any variable or array index that might not have been set
	 * @param mixed $default Default value t return if not set
	 * @return null $var value if set and $default value if not set
	 */
	public static function verify(&$var, $default=null){
		return isset($var) ? $var : $default;
	}
} 