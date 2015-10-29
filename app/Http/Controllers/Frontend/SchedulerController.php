<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Components\ScraperComponent;
use App\Models\Article;
use App\Models\Keyword;
use App\Models\NewsFeed;
use App\Models\ScrapeLog;
use App\Models\ScrapeSource;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Nathanmac\Utilities\Parser\Parser;

//Todo: Remove Parser vendor Nathanmac\Utilities\Parser\Parser it's no longer needed

class SchedulerController extends Controller
{

	/**
	 * Prepares scraper tables based on currently available data in the DB as well as new data
	 * Currently fills in ScrapeSource table based on NewsFeeds table and populates keywords table
	 * based on a batch of preliminary keywords
	 */
	public function initialize()
	{
		$sources = NewsFeed::all();

		foreach($sources as $s){
			$exists = ScrapeSource::where(array('url'=>$s->url))->first();
			if(!$exists){
				$model = new ScrapeSource();
				$model->type = 'RSS';
				$model->url = $s->url;
				$model->division_id = $s->division_id;
				$model->save();

				echo '<br>Added RSS source: '.$s->url;
			}

		}

		$keys = array('Terrorism'=>[4], 'Terrorist'=>[4], 'Breach'=>[4], 'Security'=>[4], 'Cybersecurity'=>[4], 'Threat'=>[4], 'Cybercrime'=>[4],
			'Civil Protection'=>[4], 'Risk Reduction'=>[3,4], 'Preparedness'=>[3,4], 'Mitigation'=>[3], 'Infrastructure'=>[3], 'Recovery'=>[3], 'Response'=>[3], 'Humanitarian'=>[6],
			'Pandemic'=>[1], 'Epidemic'=>[1], 'Endemic'=>[1], 'Outbreak'=>[1], 'Quarentine'=>[1], 'Virus'=>[1],
			'Risk Management'=>[5], 'Continuity'=>[5], 'Resiliency'=>[5], 'Resilience'=>[5], 'Communication'=>[3,5], 'Training'=>[3,5], 'Exercise'=>[3,5],
			'Relief'=>[3,6], 'Aid'=>[3,6], 'Coordination'=>[3,6],
			'Earthquake'=>[6], 'Hurricane'=>[6], 'Cyclone'=>[6], 'Typhoon'=>[6], 'Tsunami'=>[6], 'Tornado'=>[6], 'Tropical Storm'=>[6], 'Landslide'=>[6], 'Mudslide'=>[6], 'Flood'=>[6], 'Ice Storm'=>[6], 'Volcano'=>[6], 'Storm Surge'=>[6], 'Severe Weather'=>[6],
			'Oil Spill'=>[1,3,6], 'Nuclear'=>[1,3,6], 'Chemical Spill'=>[1,3,6], 'Train Derailment'=>[5,3], 'Bridge Collapse'=>[5,3], 'Active Shooter'=>[3] );

		foreach($keys as $k=>$d){
			$slug = ScraperComponent::generateSlug($k);
			$exists = Keyword::where(array('slug'=>$slug))->first();
			if(!$exists){
				$model = new Keyword();
				$model->weight = 1;
				$model->keyword = strtolower($k);
				$model->slug = $slug;
				$model->divisions = ScraperComponent::convertDBArrayToString($d);
				$model->save();

				echo '<br>Added keyword: '.$k.'      with divisions: '. ScraperComponent::convertDBArrayToString($d);
			}

		}
	}

	/**
	 * All purpose function to allow code testing and on-the-fly adjustments using various $_GET params
	 */
	public function toolbox()
	{
//		// Initialize the cURL session with the request URL
//		//$session = curl_init("http://feeds.reuters.com/reuters/topNews");
//		$session = curl_init($_GET['url']);
//		// Tell cURL to return the request data
//		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
//		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
//		// Execute cURL on the session handle
//		$response = curl_exec($session);
//		//$results = json_decode($response, true);
//		// Close the cURL session
//		curl_close($session);
//
//		//$parser = new Parser();
//		//$parsed = $parser->xml($response);
//		$xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
//		// Fix for empty values in XML
//		$json = json_encode((array) $xml);
//		$json = str_replace(':{}',':null', $json);
//		$json = str_replace(':[]',':null', $json);
//		$parsed = json_decode($json, 1);
//
//		var_dump($parsed['channel']);
//
//		$namespacesMeta = $xml->getNamespaces(true);
//
//		foreach($xml->channel->item as $item){
//			$geoXML = (array)$item->children($namespacesMeta['geo']);
//			var_dump($geoXML);
//			echo $geoXML['lat'];
//		}

//		if(isset($_GET['id'])){
//			$source = ScrapeSource::find($_GET['id']);
//		} else {
//			$source = ScrapeSource::first();
//		}



	}

	/**
	 * Function designed to be called by the crontab
	 * Will review and bring all new articles from 'RSS' type sources in the scrape_sources table
	 */
	public function scrapeRSS()
	{
		set_time_limit(1000);
		$messages = '';
		$sources = ScrapeSource::where('deleted', 0)->get();

		foreach($sources as $source){
			$return = ScraperComponent::processRSSFeed($source);
			$messages .= $return['message'];
			$messages .= '<br><br><b>';
			if($return['status'] == 'ok'){
				$messages .= 'Source '.$source->id.': done with '.$return['count'].' new items and '.$return['errors'].' errors.';

				//temporarily disabled to force checking all items against the DB so it doesnt require reseting the DB for testing
				//$source->last_checked_item = date("Y-m-d H:i:s");
				//$source->save();

				$mlog = new ScrapeLog();
				$mlog->source_id = $source->id;
				$mlog->automated = 0;
				$mlog->url = $source->url;
				$mlog->saved_count = $return['count'];
				$mlog->last_item = $return['last_saved_item'];
				$mlog->data = $return['data'];
				$mlog->save();

			} elseif($return['status'] == 'nothing'){
				$messages .= 'Source '.$source->id.': Had no new items to fetch';
			} else {
				$messages .= 'Source '.$source->id.': DID NOT COMPLETE.';
			}
			$messages .= '</b><br>';
		}

		echo $messages;
		//TODO: record messages in a log file or email them out to monitor cronjob
	}


}