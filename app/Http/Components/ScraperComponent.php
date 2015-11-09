<?php
/**
 * Created by PhpStorm.
 * User: Poya
 * Date: 28/10/15
 * Time: 1:49 PM
 */

namespace App\Http\Components;

use App\Http\Components\Helpers;
use App\Http\Controllers\Frontend\ArticleController;
use App\Models\ArticleDetail;
use App\Models\ArticleMedia;
use App\Models\Article;
use App\Models\Keyword;
use App\Models\NewsFeed;
use App\Models\ScrapeSource;


class ScraperComponent
{

	/**
	 * Processes a single RSS feed given a item from scrape_sources table
	 *
	 * @param ScrapeSource $source source item containing RSS url and some meta
	 * @return mixed Results of the scrape process
	 */
	public static function processRSSFeed(ScrapeSource $source)
	{
		$return['status'] = 'tbd';
		$return['count'] = 0;
		$return['errors'] = 0;
		$return['message'] = '';

		$response = self::getHttpResponse($source->url);
		$return['data'] = $response;
		$xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);

		if(!$xml)
			return $return;

		$namespacesMeta = $xml->getNamespaces(true);

		// Fix for empty values in XML
		$json = json_encode((array) $xml);
		$json = str_replace(':{}',':null', $json);
		$json = str_replace(':[]',':null', $json);
		$parsed = json_decode($json, 1);

		// if there's only one item, the ['item'] wont be an array, it'll be just the item.
		// This is tested by existance of 'title' index
		$total = isset($parsed['channel']['item']['title']) ? 1 : count($parsed['channel']['item']);
		$return['message'] .= '<br><b>';
		$return['message'] .= 'Checking source '.$source->id.' ('.$total.' items) : '.$source->url;
		$return['message'] .= '</b>';

		foreach($xml->channel->item as $item)
		{
			$item_array = (array)$item;

			// for some reason pubDate is no available (not a valid rss)
			if(!isset($item_array['pubDate'])){
				$return['message'] .= '<br><b>- Error - No publish date</b>';
				continue;
			}
			// item is older than the last the source was checked
			if(strtotime($item->pubDate) < strtotime($source->last_checked_item)){
				$return['message'] .= '<br><b>- Old item already reviewed.</b>';
				continue;
			}
			// item exists in db
			if(Article::where('title', Helpers::truncate(Helpers::verify($item_array['title'])))->first()){
				continue;
			}

			if(isset($namespacesMeta['geo'])){
				$geoXML = (array)$item->children($namespacesMeta['geo']);
				if(isset($geoXML['lat']) && isset($geoXML['long'])){
					$params['lat'] = $geoXML['lat'];
					$params['lng'] = $geoXML['long'];
				}
			}
			$params['text'] = $item_array['description'];
			$params['url'] = $item_array['link'];
			$params['title'] = $item_array['title'];
			$params['date'] = $item_array['pubDate'];
			$params['review'] = 0;

			$save_result = self::saveArticle(ArticleController::typeNews, $source, $params);

			if($save_result['status'] == 'ok'){
				$return['message'] .= '<br><b>- Added '.$save_result['model']->id.':</b> '.$save_result['model']->excerpt;

				$return['status'] = 'ok';
				$return['count']++;
				$return['last_saved_item'] = $save_result['model']->publish_date;

			} else {
				$return['message'] .= '<br><b>- Error adding: '.$item_array['title'].'</b>';
				$return['errors']++;
			}
		}
		if($return['count'] == 0 && $return['errors'] == 0)
			$return['status'] = 'nothing';

		return $return;
	}

	////////////////////////////
	////      HELPERS
	////////////////////////////

	/**
	 * General method to get http responses of a url designed to allow various methods
	 *
	 * @param string $url URL to call
	 * @param string $method type of call (curl, file_get_content, etc) currently only curl is supported
	 * @return string response received from the call
	 */
	public static function getHttpResponse($url, $method = 'curl')
	{
		$response = 'Unrecognized method';

		if($method == 'curl')
		{
			// Initialize the cURL session with the request URL
			//$session = curl_init("http://feeds.reuters.com/reuters/topNews");
			$session = curl_init($url);
			// Tell cURL to return the request data
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
			// Execute cURL on the session handle
			$response = curl_exec($session);
			//$results = json_decode($response, true);
			// Close the cURL session
			curl_close($session);
		}

		return $response;
	}

	/**
	 * Saves a new article to DB. if successful it also save the complete text in article_details for future reference
	 *
	 * @param int $type Article type (news, scientific article, etc)
	 * @param ScrapeSource $source The source model from which the article has been obtained or NULL if not using a standard source
	 * @param array $params Article info array containing the following items:
	 * 'text'		Complete article text
	 * 'url'		Url to the complete article
	 * 'title'		Article title
	 * 'date'		publish_date of the article
	 * 'lat'		latitude (optional)
	 * 'lng'		longitude (optional)
	 * 'location'	if lat, lng is not available, the function attempts to determine te lat, lng from
	 * 				location text (optional)
	 * 'media'      An array of medias to attach to the article, currently only supports and requires full image
	 * 				url as 'url' index - example: $params['media'][0]['url'] = 'http://example.com/image.jpg'
	 *
	 * @return mixed
	 */
	public static function saveArticle($type, $source, $params)
	{
		$return['status'] = '';
		$return['message'] = '';
		$all_keywords = Keyword::where('deleted', '=', 0)->get();

		$text = strip_tags(Helpers::verify($params['text'], ''));
		$keys_divs = self::guessKeywords($text, $all_keywords);

		// Checks if coords given, if not checks for location string.
		// if either available tries to determine location details for saving in DB
		$location_info = null;
		if(Helpers::verify($params['lat']) && Helpers::verify($params['lng'])){
			$location_info = Helpers::getLocationInfo($params['lat'], $params['lng']);
		} elseif (Helpers::verify($params['location'])){
			$coords = Helpers::getCoords($params['location']);
			if($coords['lat']!=null && $coords['lng']!=null)
				$location_info = Helpers::getLocationInfo($coords['lat'], $coords['lng']);
		}

		$model = new Article();
		$model->type 		= $type;
		$model->divisions 	= Helpers::convertDBArrayToString($keys_divs['divisions']);
		$model->source_id 	= $source!=null ? $source->id : null;
		$model->source_url 	= Helpers::truncate(Helpers::verify($params['url']));
		$model->title 		= Helpers::truncate(Helpers::verify($params['title'], ''));
		$model->excerpt 	= Helpers::truncate($text);
		$model->keywords 	= Helpers::convertDBArrayToString($keys_divs['keywords']);
		$model->language	= Helpers::verify($params['language']);
		$model->city 		= $location_info!=null ? $location_info['city'] : null;
		$model->state 		= $location_info!=null ? $location_info['state'] : null;
		$model->country 	= $location_info!=null ? $location_info['country'] : null;
		$model->lat 		= $location_info!=null ? $location_info['lat'] : null;
		$model->lng 		= $location_info!=null ? $location_info['lng'] : null;
		$model->review 		= Helpers::verify($params['review'], 0);
		$model->deleted 	= 0;
		$model->publish_date= isset($params['date']) ? date("Y-m-d H:i:s", strtotime($params['date'])) : null;

		if($model->save()){
			$return['status'] = 'ok';
			$return['model'] = $model;

			// Save a complete text record for the article for future reference and search (not front-end)
			$mdetail = new ArticleDetail();
			$mdetail->article_id = $model->id;
			$mdetail->url = $model->source_url;
			$mdetail->text = $text;
			$mdetail->save();

			// Handle media (images) rlated to the article
			if(isset($params['media'])){
				foreach($params['media'] as $i=>$media){
					$save_ready = false;
					$media_model = new ArticleMedia();
					$media_model->article_id = $model->id;
					$media_model->view_order = $i;
					if(isset($media['url'])){
						$media_model->filename = $media['url'];
						$media_model->filetype = 'url';
						$save_ready = true;
					}
					if($save_ready)
						$media_model->save();
				}
			}

		} else {
			$return['status'] = 'error';
		}

		return $return;
	}

	/**
	 * This function takes in a string and tries to determine related tags and divisions based on a set of provided
	 * keyword models
	 *
	 * @param string $text Text to be analyzed
	 * @param /App/Models/Keyword $all_keywords A complete list of keywords models available (this is to speed up
	 * processing when dealing with many keywords)
	 * @return array containing a sorted arrays for keywords as well as divisions
	 */
	public static function guessKeywords($text, $all_keywords)
	{
		$sensitivity = 1;		// min number of occurances required for a keyword/division to be returned
		$all_divisions = array();
		$keywords_raw = array();
		$divisions_raw = array();
		$keywords = array();
		$divisions = array();
		$keyword_weights = array();
		$net_weight = 0;

		//black lists
		$ignore = array("am","you","is","are","i","they","them","they're","it","it's","its","you're","i'm","&");
		$remove = array("!",",",":",";","@","#","?","(",")","*",".","\"","/",'"',"%","&");

		//break string into words and remove duplicates
		//$words = array_unique(explode(' ', str_replace($remove, " ", strtolower($text))));
		$words = explode(' ', str_replace($remove, " ", strtolower($text)));

		//pre-set the categories array
		foreach($all_keywords as $i=>$key){
			if(!isset($keywords_raw[$key->keyword])){
				$keywords_raw[$key->keyword] = 0;
				$all_divisions[$key->keyword] = Helpers::convertDBStringToArray($key->divisions);
				$keyword_weights[$key->keyword] = $key->weight;
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

				if(isset($keywords_raw[$word])){
					$keywords_raw[$word]++;
					$temp_divs = $all_divisions[$word];
					$net_weight += $keyword_weights[$word];
				}
				elseif($phrase_double1 != null && isset($keywords_raw[$phrase_double1])){
					$keywords_raw[$phrase_double1]++;
					$temp_divs = $all_divisions[$phrase_double1];
					$net_weight += $keyword_weights[$phrase_double1];
				}
				elseif($phrase_double2 != null && isset($keywords_raw[$phrase_double2])){
					$keywords_raw[$phrase_double2]++;
					$temp_divs = $all_divisions[$phrase_double2];
					$net_weight += $keyword_weights[$phrase_double2];
				}
				elseif($phrase_triple1 != null && isset($keywords_raw[$phrase_triple1])){
					$keywords_raw[$phrase_triple1]++;
					$temp_divs = $all_divisions[$phrase_triple1];
					$net_weight += $keyword_weights[$phrase_triple1];
				}
				elseif($phrase_triple2 != null && isset($keywords_raw[$phrase_triple2])){
					$keywords_raw[$phrase_triple2]++;
					$temp_divs = $all_divisions[$phrase_triple2];
					$net_weight += $keyword_weights[$phrase_triple2];
				}
				elseif($phrase_triple3 != null && isset($keywords_raw[$phrase_triple3])){
					$keywords_raw[$phrase_triple3]++;
					$temp_divs = $all_divisions[$phrase_triple3];
					$net_weight += $keyword_weights[$phrase_triple3];
				}

				foreach($temp_divs as $div)
				{
					if(!isset($divisions_raw[$div]))
						$divisions_raw[$div] = 1;
					else
						$divisions_raw[$div]++;
				}

			}
		}

		arsort($keywords_raw);
		foreach ($keywords_raw as $i=>$r){
			if($r >= $sensitivity) $keywords[] = $i;
		}
		//if(empty($keywords)) $keywords[] = NULL;

		arsort($divisions_raw);
		array_slice($divisions_raw, 0, 3); 				//allow up to 2 only
		foreach ($divisions_raw as $i=>$r){
			if($r >= $sensitivity) $divisions[] = $i;
		}

		return array('keywords'=>$keywords, 'weight'=>$net_weight, 'divisions'=>$divisions);
	}


} 