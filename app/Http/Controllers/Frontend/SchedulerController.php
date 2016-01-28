<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Components\Helpers;
use App\Http\Components\PDF2Text;
use App\Http\Components\PdfParser;
use App\Http\Components\PDFToText;
use App\Http\Components\Scraper;
use App\Models\Article;
use App\Models\Keyword;
use App\Models\NewsFeed;
use App\Models\ScrapeLog;
use App\Models\ScrapeSource;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class SchedulerController
 * @package App\Http\Controllers\Frontend
 */
class SchedulerController extends Controller
{
	/**
	 * Function designed to be called by the crontab
	 * Will review and save new articles from 'RSS' type sources in the scrape_sources table
	 *
	 * The results will be logged under /storage/logs/scheduler/scrapeRSS_<YmdHis>.log for future review
	 */
	public function scrapeRSS(Request $request)
	{
		set_time_limit(1000);
		$messages = '';
		//$sources = ScrapeSource::where('deleted', 0)->where('type', 'RSS')->get();

		//only lists the sources if ?id=list
		if($request->input('id') == 'list'){
			$sources = ScrapeSource::where('type', 'RSS')->get();
			foreach($sources as $source){
				echo '<br>'.$source->id.': '.($source->deleted? 'DELETED | ' : '').$source->url.' | last checked:'.$source->last_checked_item;
			}
			return;
		}

		if( ($sid = $request->input('id', 0)) != 0){
			$sources = ScrapeSource::where('id', $sid)->where('deleted', 0)->get();
		} else {
			$sources = ScrapeSource::where('type', 'RSS')->where('deleted', 0)->get();
		}

		foreach($sources as $source)
		{
			$start = microtime(true);
			$return = Scraper::processRSSFeed($source);
			$time = (microtime(true) - $start)*1000;


			$messages .= $return['messages'];
			$messages .= '<br><b>';
			$messages .= 'Process took: '.$time.'ms<br>';
			$messages .= 'Source '.$source->id.': done with '.$return['count'].' new items and '.($return['errors'] > 0 ? '<h1>'.$return['errors'].'</h1>' : $return['errors']).' errors.';
			$messages .= '</b><br>';

			if($return['errors'] == 0){
				$source->last_checked_item = date("Y-m-d H:i:s");
				$source->save();
			}
			Scraper::saveLogDB($source, $return['count']);
		}


		echo $messages;
		Scraper::saveLogFile($messages, "scrapeRSS_" . date("YmdHis") . ".log");
	}

	/**
	 * Global scraper for custom sources
	 *
	 * @param Request $request Accepted GET variables:
	 * - 'source'		Source type based on scrape_sources DB table
	 * - 'id' 			(optional) chooses which specific source_id to check, if id=list is sent, the function will only list available ids
	 * - 'page_from' 	(optional) start_page defines the starting page, default = 1
	 * - 'page_to'	 	(optional) Max page to check, default = 3
	 */
	public function scrapeCustom(Request $request)
	{
		//important to terminate the process in case the while loop goes haywire but shouldnt be
		//too short for the algo to do it's job
		set_time_limit(60*6);

		$source_type = $request->input('source');

		//only lists the sources if ?id=list
		if($request->input('id') == 'list'){
			$sources = ScrapeSource::where('type', $source_type)->where('deleted', 0)->get();
			foreach($sources as $source){
				echo '<br>'.$source->id.': '.$source->url.' | last checked:'.$source->last_checked_item;
			}
			return;
		}

		// only does one source if ?id=<source_id> due to timeout issues or all if not provided
		if( ($sid = $request->input('id', 0)) != 0){
			$sources = ScrapeSource::where('id', $sid)->where('deleted', 0)->get();
		} else {
			$sources = ScrapeSource::where('type', $source_type)->where('deleted', 0)->get();
		}


		$messages = '';
		foreach($sources as $source)
		{
			$page = 	$request->input('page_from', 1);
			$page_to = 	$request->input('page_to', 2);
			$messages .= '<b>'.$source->url.'</b> | last_checked: '.$source->last_checked_item.' | pages '.$page.'-'.$page_to.' | get details: yes<br>';

			$start = microtime(true);
			switch($source->type)
			{
				case 'IRDR': 	$return = Scraper::scrapeIRDR($source, $page, $page_to); break;
				case 'EC': 		$return = Scraper::scrapeEC($source, $page, $page_to, true); break;
				case 'EC-PR': 	$return = Scraper::scrapeECPR($source, $page, $page_to, true); break;
				case 'GIAC': 	$return = Scraper::scrapeGIAC($source, $page); break;
				case 'BCI': 	$return = Scraper::scrapeBCI($source, $page, $page_to, true); break;
				default: 		$return = array('messages'=>'error: source not recognized.', 'count'=>0,'errors'=>0); break;
			}
			$time = (microtime(true) - $start)*1000;

			$messages .= $return['messages'];
			$messages .= '<br><br><b>';
			$messages .= 'Process took: '.$time.'ms<br>';
			$messages .= 'Source '.$source->id.': done with '.$return['count'].' new items and '.($return['errors'] > 0 ? '<h1>'.$return['errors'].'</h1>' : $return['errors']).' errors.';
			$messages .= '</b><br>';

			if($return['errors'] == 0){
				$source->last_checked_item = date("Y-m-d H:i:s");
				$source->save();
			}

			Scraper::saveLogDB($source, $return['count']);
		}
		echo $messages;
		Scraper::saveLogFile($messages, "scrapeCustom_".$source->type."_".$source->id."_" . date("YmdHis") . ".log");
	}



	/**
	 * Prepares scraper tables based on currently available data in the DB as well as new data
	 * Currently fills in ScrapeSource table based on NewsFeeds table and populates keywords table
	 * based on a batch of preliminary keywords
	 */
//	public function initialize()
//	{
//		// add all current rss sources to the source list
//		$sources = NewsFeed::all();
//		foreach($sources as $s){
//			$exists = ScrapeSource::where(array('url'=>$s->url))->first();
//			if(!$exists){
//				$model = new ScrapeSource();
//				$model->type = 'RSS';
//				$model->url = $s->url;
//				$model->division_id = $s->division_id;
//				$model->save();
//
//				echo '<br>Added RSS source: '.$s->url;
//			}
//
//		}
//
//		//populate the keywords table with some basic keys
//		$keys = array('Terrorism'=>[4], 'Terrorist'=>[4], 'Breach'=>[4], 'Security'=>[4], 'Cybersecurity'=>[4], 'Threat'=>[4], 'Cybercrime'=>[4],
//			'Civil Protection'=>[4], 'Risk Reduction'=>[3,4], 'Preparedness'=>[3,4], 'Mitigation'=>[3], 'Infrastructure'=>[3], 'Recovery'=>[3], 'Response'=>[3], 'Humanitarian'=>[6],
//			'Pandemic'=>[1], 'Epidemic'=>[1], 'Endemic'=>[1], 'Outbreak'=>[1], 'Quarentine'=>[1], 'Virus'=>[1],
//			'Risk Management'=>[5], 'Continuity'=>[5], 'Resiliency'=>[5], 'Resilience'=>[5], 'Communication'=>[3,5], 'Training'=>[3,5], 'Exercise'=>[3,5],
//			'Relief'=>[3,6], 'Aid'=>[3,6], 'Coordination'=>[3,6],
//			'Earthquake'=>[6], 'Hurricane'=>[6], 'Cyclone'=>[6], 'Typhoon'=>[6], 'Tsunami'=>[6], 'Tornado'=>[6], 'Tropical Storm'=>[6], 'Landslide'=>[6], 'Mudslide'=>[6], 'Flood'=>[6], 'Ice Storm'=>[6], 'Volcano'=>[6], 'Storm Surge'=>[6], 'Severe Weather'=>[6],
//			'Oil Spill'=>[1,3,6], 'Nuclear'=>[1,3,6], 'Chemical Spill'=>[1,3,6], 'Train Derailment'=>[5,3], 'Bridge Collapse'=>[5,3], 'Active Shooter'=>[3] );
//		$negative_keys = array('newsletter', 'workshop');
//		foreach($keys as $k=>$d){
//			$slug = Helpers::generateSlug($k);
//			$exists = Keyword::where(array('slug'=>$slug))->first();
//			if(!$exists){
//				$model = new Keyword();
//				$model->weight = 1;
//				$model->keyword = strtolower($k);
//				$model->slug = $slug;
//				$model->divisions = Helpers::convertDBArrayToString($d);
//				$model->save();
//
//				echo '<br>Added keyword: '.$k.'      with divisions: '. Helpers::convertDBArrayToString($d);
//			}
//
//		}
//
//		// Add custom sources
//		$irdr_urls = array('http://www.irdrinternational.org/irdr-publications/'=>['IRDR'],
//						   'http://www.irdrinternational.org/other-publications/'=>['IRDR'],
//						   'http://www.irdrinternational.org/co-sponsors-publications/'=>['IRDR'],
//						   'http://feeds.sciencedaily.com/sciencedaily/earth_climate/natural_disasters'=>['RSS']);
//		foreach($irdr_urls as $irdr_url=>$meta){
//			$exists = ScrapeSource::where(array('url'=>$irdr_url))->first();
//			if(!$exists){
//				$model = new ScrapeSource();
//				$model->type = $meta[0];
//				$model->url = $irdr_url;
//				$model->division_id = 0;
//				$model->save();
//
//				echo '<br>Added '.$meta[0].' source: '.$irdr_url;
//			}
//		}
//
//	}

	/**
	 * All purpose function to allow code testing and on-the-fly adjustments using various $_GET params
	 */
	public function toolbox()
	{
		set_time_limit(1000);
		echo 'hi ';
		echo 'there';
//		$stdout = 'out: ';
//		$stderr = 'errors: ';
//		$return = Scraper::shell_cmd_exec("pdftotext http://www.giac.org/paper/gcia/10673/fingerprinting-windows-10-technical-preview/141146", $stdout, $stderr);
		//echo PdfParser::parseFile('http://www.giac.org/paper/gcia/10673/fingerprinting-windows-10-technical-preview/141146');
		//echo PdfParser::parseFile(storage_path() . "/logs/scheduler/".'sample2.pdf');
		$converter = new PDF2Text();
		$converter->setFilename(storage_path() . "/logs/scheduler/".'sample2.pdf');
		$converter->decodePDF();
		echo $converter->output();
		//echo PDFToText::convertPDF();
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


}
