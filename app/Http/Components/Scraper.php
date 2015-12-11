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
use App\Models\ScrapeLog;

class Scraper
{

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
			$header = array();
			$header[] = 'Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5';
			$header[] = 'Cache-Control: max-age=0';
			$header[] = 'Connection: keep-alive';
			$header[] = 'Keep-Alive: 300';
			$header[] = 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7';
			$header[] = 'Accept-Language: en-us,en;q=0.5';
			$header[] = 'Pragma: ';
			$agent= 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36';

			$session = curl_init();
			$timeout = 50;
			curl_setopt($session, CURLOPT_URL, $url);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($session, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($session, CURLOPT_VERBOSE, true);
			curl_setopt($session, CURLOPT_USERAGENT, $agent);
			curl_setopt($session, CURLOPT_AUTOREFERER, true);
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
			//curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			$response = curl_exec($session);
			if (curl_error($session))die(curl_error($session).': '.$url);
			curl_close($session);

//			// Initialize the cURL session with the request URL
//			//$session = curl_init("http://feeds.reuters.com/reuters/topNews");
//			$session = curl_init($url);
//			// Tell cURL to return the request data
//			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
//			curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
//			// Execute cURL on the session handle
//			$response = curl_exec($session);
//			//$results = json_decode($response, true);
//			// Close the cURL session
//			curl_close($session);
		}

		return $response;
	}

	/**
	 * Returns an array of \DOMElements given constraints
	 *
	 * @param \DOMDocument|\DOMElement $dom DOM tree
	 * @param string $parent_tag 			(optional) parent tag to narrow down result, null if not needed
	 * @param string $target_tag			the tag type of target elements ('div', 'a', etc)
	 * @param string $target_attr			(optional) attr type if needed null if not
	 * @param string $target_attr_val		(optional) attr value, null if not needed
	 * @param boolean $partial_attr_val		(optional) allow partial attr value match or not, default true
	 * @return array
	 */
	public static function htmlElementsGrab($dom, $parent_tag, $target_tag, $target_attr, $target_attr_val, $partial_attr_val=true)
	{
		$result = array();

		if($parent_tag == null){
			$e1s = $dom->getElementsByTagName($target_tag);
		} else {
			$parents = $dom->getElementsByTagName($parent_tag);
			if($parents->length == 0) return array();
			foreach($parents as $parent){
				$e1s = $parent->getElementsByTagName($target_tag);
				if($e1s->length > 0) break;
			}
		}

		if($e1s->length == 0) return array();

		if($target_attr == null){
			$result = $e1s;
		} else {
			$temp = array();
			foreach($e1s as $e1){
				if($e1->getAttribute($target_attr) == $target_attr_val){
					$temp[] = $e1;
				}
				elseif($partial_attr_val && strpos($e1->getAttribute($target_attr), $target_attr_val) !== false)
				{
					$temp[] = $e1;
				}
			}
			if(empty($temp)) return array();
			else $result = $temp;
		}
		return $result;
	}

	/**
	 * Returns the text content of a specific element
	 * @param \DOMDocument|\DOMElement $dom	DOM tree to search
	 * @param string $target_tag			the tag type of target elements ('div', 'a', etc)
	 * @param string $target_attr			(optional) attr type if needed null if not
	 * @param string $target_attr_val		(optional) attr value, null if not needed
	 * @return null|string
	 */
	public static function htmlTextGrab($dom, $target_tag, $target_attr, $target_attr_val)
	{
		$result = null;
		if($target_tag == null){
			$result = trim($dom->textContent);
		} else {
			$e1s = $dom->getElementsByTagName($target_tag);
			foreach($e1s as $e1){
				if($target_attr == null || strpos($e1->getAttribute($target_attr), $target_attr_val) !== false)
				{
					$result = trim($e1->textContent);
					break;
				}
			}
		}
		return $result;
	}

	/**
	 * Returns the attribute content of a specific element
	 * @param \DOMDocument|\DOMElement $dom	DOM tree to search
	 * @param string $target_tag			the tag type of target elements ('div', 'a', etc)
	 * @param string $target_attr			(optional) attr type if needed null if not
	 * @param string $target_attr_val		(optional) attr value, null if not needed
	 * @param string $attr					the attribute that you need
	 * @return null|string
	 */
	public static function htmlAttributeGrab($dom, $target_tag, $target_attr, $target_attr_val, $attr)
	{
		$result = null;

		$e1s = $dom->getElementsByTagName($target_tag);
		foreach($e1s as $e1){
			if($target_attr == null || strpos($e1->getAttribute($target_attr), $target_attr_val) !== false)
			{
				if( ($temp = $e1->getAttribute($attr)) !== '')
				{
					$result = trim($temp);
					break;
				}
			}
		}

		return $result;
	}

	/**
	 * Verifies a potential article scraped from a source and offer saving in one step
	 * @param ScrapeSource $source	source from which the article is from
	 * @param array $params			params
	 * @param $save					whether or not to save/update the article or to just check article against db
	 * @return mixed
	 */
	public static function verifyArticle($source, $params, $save)
	{
		$return['status'] = 'ok';
		$return['message'] = '';
		// item exists in db
		// TODO need a more full proof way to check existing articles
		if( ($existingart = Article::where('title', Helpers::truncate(Helpers::verify($params['title'])))->first()) ){
			$return['message'] .= '<b>- Item seem to already exists as article_id = '.$existingart->id.'</b>';
			$return['status'] = 'exist';

			if($save){
				$return['message'] .= ' | updating content... ';
				$temp = Scraper::saveArticle($existingart, $source->article_type, $source, $params);
				$return['message'] .= $temp['status'];
			}
		}
		// publish date is required ?
//		elseif(!isset($params['date'])){
//			$return['msg'] .= '<br><b>- Item is missing publish date.</b>';
//			$return['status'] = 'error';
//		}
		// item is older than the last the source was checked
		elseif(isset($params['date']) && strtotime($params['date']) < strtotime($source->last_checked_item)){
			$return['message'] .= '<b>- Item not found in db but is older than last check. Ignoring. It must\'ve been reviewed before.</b>';
			$return['status'] = 'old';
		}

		if($return['status'] == 'ok' && $save){
			$return = Scraper::saveArticle(null, $source->article_type, $source, $params);
		}

		return $return;
	}

	/**
	 * Saves a new article to DB. if successful it also save the complete text in article_details for future reference
	 *
	 * @param Article $item If updating a current article item provide this and if new send in null
	 * @param int $type Article type (news, scientific article, etc)
	 * @param ScrapeSource $source The source model from which the article has been obtained or NULL if not using a standard source
	 * @param array $params Article info array containing the following items:
	 * 'text'		Complete article text
	 * 'url'		Url to the complete article
	 * 'title'		Article title
	 * 'date'		publish_date of the article
	 * 'excerpt'	(optional) if not available it'll be extracted from 'text'
	 * 'lat'		latitude (optional)
	 * 'lng'		longitude (optional)
	 * 'location'	if lat, lng is not available, the function attempts to determine te lat, lng from
	 * 				location text (optional)
	 * 'media'      An array of medias to attach to the article, currently only supports and requires full image
	 * 				url as 'url' index - example: $params['media'][0]['url'] = 'http://example.com/image.jpg'
	 *
	 * @return mixed
	 */
	public static function saveArticle($item, $type, $source, $params)
	{
		$return['status'] = '';
		$return['message'] = '';
		$all_keywords = Keyword::where('deleted', '=', 0)->get();

		$text = Helpers::verify($params['text'], '');
		$excerpt = Helpers::truncate( strip_tags( Helpers::verify($params['excerpt'], $text) ) );

		$keys_divs = self::guessKeywords(strip_tags($text), $all_keywords);

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

		if($item == null){
			$model = new Article();
			// do not overwrite these
			$model->language	= Helpers::verify($params['language']);
			$model->review 		= Helpers::verify($params['review'], 0);
			$model->deleted 	= 0;
		} else {
			$model = $item;
		}

		$model->type 		= ($type==null||$type==0) ? ArticleController::typeOther : $type;
		$model->divisions 	= Helpers::convertDBArrayToString($keys_divs['divisions']);
		$model->source_id 	= $source!=null ? $source->id : null;
		$model->source_url 	= Helpers::truncate(Helpers::verify($params['url']));
		$model->title 		= Helpers::truncate(Helpers::verify($params['title'], ''));
		$model->excerpt 	= $excerpt;
		$model->keywords 	= Helpers::convertDBArrayToString($keys_divs['keywords']);
		$model->city 		= $location_info!=null ? $location_info['city'] : null;
		$model->state 		= $location_info!=null ? $location_info['state'] : null;
		$model->country 	= $location_info!=null ? $location_info['country'] : null;
		$model->lat 		= $location_info!=null ? $location_info['lat'] : null;
		$model->lng 		= $location_info!=null ? $location_info['lng'] : null;
		$model->publish_date= isset($params['date']) ? date("Y-m-d H:i:s", strtotime($params['date'])) : null;

		if($model->save()){
			$return['status'] = 'ok';
			$return['model'] = $model;
			$return['message'] = '<b>- Added '.$model->id.':</b> '.$model->title;

			// Save a complete text record for the article for future reference and search (not front-end)
			if(isset($text) && trim($text) != ''){
				$existing_detail = ArticleDetail::where('article_id', $model->id)->first();
				if($existing_detail){
					$mdetail = $existing_detail;
				} else {
					$mdetail = new ArticleDetail();
					$mdetail->article_id = $model->id;
				}

				$mdetail->url = $model->source_url;
				$mdetail->text = $text;
				$mdetail->save();
			}


			// Handle media (images) rlated to the article
			if(isset($params['media'])){
				foreach($params['media'] as $i=>$media){
					if(isset($media['url'])){
						$media_exists= ArticleMedia::where('filename', $media['url'])->first();
						if(!$media_exists){
							$media_model = new ArticleMedia();
							$media_model->article_id = $model->id;
							$media_model->view_order = $i;
							$media_model->filename = $media['url'];
							$media_model->filetype = 'url';
							$media_model->save();
						}
					}
				}
			}

		} else {
			$return['status'] = 'error';
			$return['message'] = '<b>- Error adding: '.$params['title'].'</b>';
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

	/**
	 * Saves a given text to a log file
	 *
	 * @param string $messages
	 * @param string $filename
	 * @return int
	 */
	public static function saveLogFile($messages, $filename)
	{
		// convert html tags to something easier to read before saving the log file
		$messages = str_replace("<br>", "\n", $messages);
		$messages = strip_tags($messages);

		//create the log folder if it doesnt already exist
		if (!is_dir(storage_path() . "/logs/scheduler"))
			mkdir(storage_path() . "/logs/scheduler", 0744, true);

		return file_put_contents(storage_path() . "/logs/scheduler/" . $filename, $messages);
	}

	/**
	 * Saves a scrape source action to the db
	 *
	 * @param ScrapeSource $source The current source
	 * @param int $count Number ew articles added
	 * @return boolean
	 */
	public static function saveLogDB($source, $count)
	{
		$mlog = new ScrapeLog();
		$mlog->source_id = $source->id;
		$mlog->automated = 0;
		$mlog->url = $source->url;
		$mlog->saved_count = $count;
		$mlog->last_item = date("Y-m-d H:i:s");
		$mlog->data = '';//$return['data'];
		return $mlog->save();
	}

	public static function shell_cmd_exec($cmd, &$stdout, &$stderr)
	{
		$outfile = tempnam(".", "cmd");
		$errfile = tempnam(".", "cmd");
		$descriptorspec = array(
			0 => array("pipe", "r"),
			1 => array("file", $outfile, "w"),
			2 => array("file", $errfile, "w")
		);
		$proc = proc_open($cmd, $descriptorspec, $pipes);

		if (!is_resource($proc)) return 255;

		fclose($pipes[0]);    //Don't really want to give any input

		$exit = proc_close($proc);
		$stdout = file($outfile);
		$stderr = file($errfile);

		unlink($outfile);
		unlink($errfile);
		return $exit;
	}


	//////////////////////////////////
	////              SCRAPERS
	//////////////////////////////////


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
		$return['messages'] = '';

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
		$return['messages'] .= '<br><b>';
		$return['messages'] .= 'Checking source '.$source->id.' ('.$total.' items) : '.$source->url;
		$return['messages'] .= '</b>';

		foreach($xml->channel->item as $item)
		{
			$item_array = (array)$item;

			// for some reason pubDate is no available (not a valid rss)
			if(!isset($item_array['pubDate'])){
				$return['messages'] .= '<br><b>- Error - No publish date</b>';
				continue;
			}
//			// item is older than the last the source was checked
//			if(strtotime($item->pubDate) < strtotime($source->last_checked_item)){
//				$return['messages'] .= '<br><b>- Old item already reviewed.</b>';
//				continue;
//			}
//			// item exists in db
//			if(Article::where('title', Helpers::truncate(Helpers::verify($item_array['title'])))->first()){
//				continue;
//			}

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

			$save_result = Scraper::verifyArticle($source, $params, true);

			$return['status'] = $save_result['status'];
			$return['messages'] .= '<br>'.$save_result['message'];
			if($save_result['status'] == 'ok'){
				$return['count']++;
				//$return['last_saved_item'] = $save_result['model']->publish_date;
			} elseif($save_result['status'] == 'error') {
				$return['errors']++;
			}
		}
		if($return['count'] == 0 && $return['errors'] == 0)
			$return['status'] = 'nothing';

		return $return;
	}

	/**
	 * Given a specific EC-PR type source, attemps to extract data
	 * @param ScrapeSource $source
	 * @param int $page_from
	 * @param int $page_to
	 * @param boolean $get_fulltext	 	whether or not to try and capture the full text (takes much longer but is required for new articles)
	 * @return mixed
	 */
	public static function scrapeECPR($source, $page_from, $page_to, $get_fulltext)
	{
		$return['status'] = '';
		$return['count'] = 0;
		$return['errors'] = 0;
		$return['messages'] = '';
		$end = false;
		$page = $page_from;
		while(!$end && $page <= $page_to)
		{
			$return['messages'] .= '<br>Analysing page: '.$page;
			$data = array();
			if($page == 1)	$url = $source->url;
			else 			$url = $source->url.'?page='.($page-1);

			$response = Scraper::getHttpResponse($url);
			if(trim($response) == ''){
				$return['messages'] .= 'Error retrieving "'.$url.'" url.';
				break;
			}

			$doc = new \DOMDocument();
			@$doc->loadHTML($response);

			$article_nodes = Scraper::htmlElementsGrab($doc, null, 'div', 'class', 'feed-item', false);
			foreach($article_nodes as $article_node)
			{
				$data['excerpt'] = Scraper::htmlTextGrab($article_node, 'div', 'class', 'feed-item-body');
				$data['date'] = Scraper::htmlTextGrab($article_node, 'span', 'class', 'feed-item-date');
				$title_nodes = Scraper::htmlElementsGrab($article_node, null, 'h3', 'class', 'feed-item-title');
				foreach($title_nodes as $title_node){
					$data['title'] = Scraper::htmlTextGrab($title_node, 'a', null, null);
					$data['url'] = Scraper::htmlAttributeGrab($title_node, 'a', null, null, 'href');
					if(strpos($data['url'], 'http') === false){
						$data['url'] = 'http://ec.europa.eu'.$data['url'];
					}
				}

				if($get_fulltext && isset($data['url'])){
					$response2 = Scraper::getHttpResponse($data['url']);
					$doc2 = new \DOMDocument();
					@$doc2->loadHTML($response2);
					$data['text'] = Scraper::htmlTextGrab($doc2, 'div', 'id', 'contentPressRelease');
				}

				$save_result = Scraper::verifyArticle($source, $data, true);

				$return['status'] = $save_result['status'];
				$return['messages'] .= '<br>'.$save_result['message'];
				if($save_result['status'] == 'ok'){
					$return['count']++;
				} elseif($save_result['status'] == 'error') {
					$return['errors']++;
				}
				//var_dump($data);
				unset($data);
			}

			if( (is_array($article_nodes) && empty($article_nodes))
				|| (!is_array($article_nodes) && $article_nodes->length == 0) ){
				$end = true;
			}
			$page++;
		}

		return $return;
	}

	/**
	 * Given a specific IRDR source attemps to extract articles
	 * @param ScrapeSource $source
	 * @param int $page_from
	 * @param int $page_to
	 * @return mixed
	 */
	public static function scrapeIRDR($source, $page_from, $page_to)
	{
		$return['status'] = '';
		$return['count'] = 0;
		$return['errors'] = 0;
		$return['messages'] = '';
		$end = false;
		$page = $page_from;
		while(!$end && $page <= $page_to)
		{
			$return['messages'] .= '<br>Analysing page: '.$page;
			$data = array();
			if($page == 1) 	$url = $source->url;
			else 			$url = $source->url.'page/'.$page.'/';

			$response = Scraper::getHttpResponse($url);
			if(trim($response) == ''){
				$return['messages'] .= 'Error with "'.$url.'" url.';
				break;
			}

			$doc = new \DOMDocument();
			@$doc->loadHTML($response);

			$article_nodes = Scraper::htmlElementsGrab($doc, null, 'article', null, null);
			foreach($article_nodes as $article_node)
			{
				$data['title'] = Scraper::htmlTextGrab($article_node, 'header', 'class', 'entry-header');
				$parent_elements = Scraper::htmlElementsGrab($article_node, null, 'div', 'class', 'entry-content');
				foreach($parent_elements as $pe){
					$data['excerpt'] = Scraper::htmlTextGrab($pe, 'p', null, null);
					if($data['excerpt'] != null) break;
				}
				$data['url'] = Scraper::htmlAttributeGrab($article_node, 'a', 'class', 'read-more', 'href');
				$data['media'][0]['url'] = Scraper::htmlAttributeGrab($article_node, 'img', null, null, 'src');

				$response2 = Scraper::getHttpResponse($data['url']);
				$doc2 = new \DOMDocument();
				@$doc2->loadHTML($response2);

				$data['date'] = Scraper::htmlAttributeGrab($doc2, 'time', null, null, 'datetime');
				$paragraph_nodes = Scraper::htmlElementsGrab($doc2, 'article', 'p', null, null);
				$data['text'] = '';
				foreach($paragraph_nodes as $pnode){
					$data['text'] .= Scraper::htmlTextGrab($pnode, null, null, null);
				}

				$save_result = Scraper::verifyArticle($source, $data, true);

				$return['status'] = $save_result['status'];
				$return['messages'] .= '<br>'.$save_result['message'];
				if($save_result['status'] == 'ok'){
					$return['count']++;
				} elseif($save_result['status'] == 'error') {
					$return['errors']++;
				}

				unset($data);
			}

			if( (is_array($article_nodes) && empty($article_nodes))
				|| (!is_array($article_nodes) && $article_nodes->length == 0) ){
				$end = true;
			}
			$page++;
		}

		return $return;
	}

	/**
	 * Given a specific EC type source attemps to extract data
	 * @param ScrapeSource $source
	 * @param int $page_from
	 * @param int $page_to
	 * @param boolean $get_fulltext		whether or not to try and capture the full text (takes much longer but is required for new articles)
	 * @return mixed
	 */
	public static function scrapeEC($source, $page_from, $page_to, $get_fulltext)
	{
		$return['status'] = '';
		$return['count'] = 0;
		$return['errors'] = 0;
		$return['messages'] = '';
		$end = false;
		$page = $page_from;
		while(!$end && $page <= $page_to)
		{
			$return['messages'] .= '<br>Analysing page: '.$page;
			$data = array();
			if($page == 1)	$url = $source->url;
			else 			$url = $source->url.'?page='.($page-1);

			$response = Scraper::getHttpResponse($url);
			if(trim($response) == ''){
				$return['messages'] .= 'Error retrieving "'.$url.'" url.';
				break;
			}

			$doc = new \DOMDocument();
			@$doc->loadHTML($response);

			$article_nodes = Scraper::htmlElementsGrab($doc, null, 'div', 'class', 'views-row');
			foreach($article_nodes as $article_node)
			{
				$data['excerpt'] = Scraper::htmlTextGrab($article_node, 'span', 'class', 'field-content');
				$data['date'] = Scraper::htmlAttributeGrab($article_node, 'span', 'class', 'date-display-single', 'content');
				$data['media'][0]['url'] = Scraper::htmlAttributeGrab($article_node, 'img', null, null, 'src');
				$title_nodes = Scraper::htmlElementsGrab($article_node, null, 'div', 'class', 'views-field views-field-title');
				foreach($title_nodes as $title_node){
					$data['title'] = Scraper::htmlTextGrab($title_node, 'a', null, null);
					$data['url'] = Scraper::htmlAttributeGrab($title_node, 'a', null, null, 'href');
					if(strpos($data['url'], 'http') === false){
						$data['url'] = 'http://ec.europa.eu'.$data['url'];
					}
				}

				if($get_fulltext){
					$response2 = Scraper::getHttpResponse($data['url']);
					$doc2 = new \DOMDocument();
					@$doc2->loadHTML($response2);
					$data['text'] = Scraper::htmlTextGrab($doc2, 'div', 'class', 'region region-content');
				}

				$save_result = Scraper::verifyArticle($source, $data, true);

				$return['status'] = $save_result['status'];
				$return['messages'] .= '<br>'.$save_result['message'];
				if($save_result['status'] == 'ok'){
					$return['count']++;
				} elseif($save_result['status'] == 'error') {
					$return['errors']++;
				}
				//var_dump($data);
				unset($data);
			}

			if( (is_array($article_nodes) && empty($article_nodes))
				|| (!is_array($article_nodes) && $article_nodes->length == 0) ){
				$end = true;
			}
			$page++;
		}

		return $return;
	}

	/**
	 * Given a specific EC type source attemps to extract data
	 * @param ScrapeSource $source
	 * @param int $page_from
	 * @return mixed
	 */
	public static function scrapeGIAC($source, $page_from)
	{
		$return['status'] = '';
		$return['count'] = 0;
		$return['errors'] = 0;
		$return['messages'] = '';
		$end = false;
		$page = $page_from;
		//while(!$end && $page <= $page_to)
		//{
			$return['messages'] .= '<br>Analysing page: '.$page;
			$data = array();
			if($page == 1)	$url = $source->url;
			else 			$url = $source->url.'?page='.($page-1);

			$response = Scraper::getHttpResponse($url);
			if(trim($response) == ''){
				$return['messages'] .= 'Error retrieving "'.$url.'" url.';
				return $return;
			}

			$doc = new \DOMDocument();
			@$doc->loadHTML($response);

			$article_nodes = Scraper::htmlElementsGrab($doc, null, 'tr', 'class', 'table-row');
			foreach($article_nodes as $article_node)
			{
				$cell_nodes = Scraper::htmlElementsGrab($article_node, null, 'td', null, null);
				foreach($cell_nodes as $c=>$cell_node)
				{

					if($c == 3){
						$data['title'] = Scraper::htmlTextGrab($cell_node, 'a', null, null);
						$data['excerpt'] = $data['title'];
						$data['url'] = Scraper::htmlAttributeGrab($cell_node, 'a', null, null, 'href');

						if(strpos($data['url'], 'http') === false){
							$data['url'] = 'http://www.giac.org'.$data['url'];
						}
					}

					if($c == 5){
						$data['date'] = Scraper::htmlTextGrab($cell_node, null, null, null);
					}
				}

				$save_result = Scraper::verifyArticle($source, $data, true);

				$return['status'] = $save_result['status'];
				$return['messages'] .= '<br>'.$save_result['message'];
				if($save_result['status'] == 'ok'){
					$return['count']++;
				} elseif($save_result['status'] == 'error') {
					$return['errors']++;
				}
				//var_dump($data);
				unset($data);
			}

			if( (is_array($article_nodes) && empty($article_nodes))
				|| (!is_array($article_nodes) && $article_nodes->length == 0) ){
				$end = true;
			}
			$page++;
		//}

		return $return;
	}

	/**
	 * Given a specific BCI type source attempts to extract data
	 * @param ScrapeSource $source
	 * @param int $page_from
	 * @param int $page_to
	 * @param boolean $get_fulltext
	 * @return mixed
	 */
	public static function scrapeBCI($source, $page_from, $page_to, $get_fulltext)
	{
		$return['status'] = '';
		$return['count'] = 0;
		$return['errors'] = 0;
		$return['messages'] = '';
		$end = false;
		$page = $page_from;
		while(!$end && $page <= $page_to)
		{
			$return['messages'] .= '<br>Analysing page: '.$page;
			$data = array();
			if($page == 1)	$url = $source->url;
			else 			$url = $source->url.'/page/'.($page-1);

			$response = Scraper::getHttpResponse($url);
			if(trim($response) == ''){
				$return['messages'] .= 'Error retrieving "'.$url.'" url.';
				return $return;
			}
			$doc = new \DOMDocument();
			@$doc->loadHTML($response);

			$article_nodes = Scraper::htmlElementsGrab($doc, null, 'div', 'class', 'article');
			foreach($article_nodes as $article_node)
			{
				$data['media'][0]['url'] = Scraper::htmlAttributeGrab($article_node, 'img', null, null, 'src');
				$date_temp = Scraper::htmlTextGrab($article_node, 'h4', 'class', 'meta');
				$data['date'] = substr($date_temp, 56);
				$data['excerpt'] = Scraper::htmlTextGrab($article_node, 'p', 'class', 'hidden-small');

				$cell_nodes = Scraper::htmlElementsGrab($article_node, null, 'h2', 'class', 'newsroom-list-header');
				foreach($cell_nodes as $c=>$cell_node)
				{
					$data['title'] = Scraper::htmlTextGrab($cell_node, 'a', null,null);
					$data['url'] = Scraper::htmlAttributeGrab($cell_node, 'a', null, null, 'href');
					if(strpos($data['url'], 'http') === false){
						$data['url'] = 'http://business-continuity-institute.mynewsdesk.com'.$data['url'];
					}
				}

				if($get_fulltext){
					$response2 = Scraper::getHttpResponse($data['url']);
					$doc2 = new \DOMDocument();
					@$doc2->loadHTML($response2);
					$data['text'] = Scraper::htmlTextGrab($doc2, 'div', 'class', 'newsroom-article');
				}

				$save_result = Scraper::verifyArticle($source, $data, true);

				$return['status'] = $save_result['status'];
				$return['messages'] .= '<br>'.$save_result['message'];
				if($save_result['status'] == 'ok'){
					$return['count']++;
				} elseif($save_result['status'] == 'error') {
					$return['errors']++;
				}
				//var_dump($data);
				unset($data);
			}

			if( (is_array($article_nodes) && empty($article_nodes))
				|| (!is_array($article_nodes) && $article_nodes->length == 0) ){
				$end = true;
			}
			$page++;
		}

		return $return;
	}
}
