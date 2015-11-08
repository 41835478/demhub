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

class SchedulerController extends Controller
{


	/**
	 * Function designed to be called by the crontab
	 * Will review and save new articles from 'RSS' type sources in the scrape_sources table
	 *
	 * The results will be logged under /storage/logs/scheduler/scrapeRSS_<YmdHis>.log for future review
	 */
	public function scrapeRSS()
	{
		set_time_limit(1000);
		$messages = '';
		$sources = ScrapeSource::where('deleted', 0)->where('type', 'RSS')->get();

		foreach($sources as $source){
			$return = ScraperComponent::processRSSFeed($source);
			$messages .= $return['message'];
			$messages .= '<br><br><b>';
			if($return['status'] == 'ok'){
				$messages .= 'Source '.$source->id.': done with '.$return['count'].' new items and '.$return['errors'].' errors.';

				$source->last_checked_item = date("Y-m-d H:i:s");
				$source->save();

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
				$messages .= 'Source '.$source->id.': DID NOT COMPLETE DUE TO AN ERROR.';
			}
			$messages .= '</b><br>';
		}


		echo $messages;
		// convert html tags to something easier to read before saving the log file
		$messages = str_replace("<br>", "\n", $messages);
		$messages = strip_tags($messages);

		if (!is_dir(storage_path()."/logs/scheduler"))
			mkdir(storage_path()."/logs/scheduler", 0744, true);

		file_put_contents(storage_path()."/logs/scheduler/scrapeRSS_".date("YmdHis").".log", $messages);
	}

	/**
	 * Downloads articles from http://www.irdrinternational.org/ based on 'IRDR' type sources on the scrape_sources DB table
	 *
	 * @param Request $request Accepted indexes:
	 * - 'id' (optional) chooses which specific source_id to check, if id=list is sent, the function will only list available ids
	 * - 'all_pages' (optional) The function will go through up to 3 pages, if all_pages=1 is set it'll go through all but will likely timeout
	 *
	 */
	public function scrapeIRDR(Request $request)
	{
		//important to terminate the process in case the while loop goes haywire but shouldnt be
		//too short for the algo to do it's job
		set_time_limit(400);

		//only lists the sources if ?id=list
		if($request->input('id', 0) == 'list'){
			$sources = ScrapeSource::where('type', 'IRDR')->where('deleted', 0)->get();
			foreach($sources as $source){
				echo '<br>'.$source->id.': '.$source->url.' | last checked:'.$source->last_checked_item;
			}
			return;
		}

		// only does one source if ?id=<source_id> due to timeout issues or all if not provided
		if( ($sid = $request->input('id', 0)) != 0){
			$sources = ScrapeSource::where('id', $sid)->where('deleted', 0)->get();
		} else {
			$sources = ScrapeSource::where('type', 'IRDR')->where('deleted', 0)->get();
		}
		$messages = '';

		$page_count = $request->input('all_pages', 0)==0 ? 30 : 3;

		foreach($sources as $source){
			//$return = ScraperComponent::processRSSFeed($source);
			//$messages .= $return['message'];
			echo $source->url.'<br>';
			$page = 1;
			$end = false;
			$return['status'] = '';
			$return['count'] = 0;
			$return['errors'] = 0;

			while(!$end && $page <= $page_count)
			{
				$data = array();
				if($page == 1)
					$url = $source->url;
				else
					$url = $source->url.'page/'.$page.'/';
				$response = ScraperComponent::getHttpResponse($url);

				if(trim($response) == ''){
					$messages .= 'Error with "'.$url.'" url.';
					break;
				}

				$doc = new \DOMDocument();
				@$doc->loadHTML($response);
				$e1s = $doc->getElementsByTagName('article');
				foreach($e1s as $e1){
					if(strpos($e1->getAttribute('class'), ' post ') !== false){
						//$name = $e1->textContent;
						//echo '----n----'.$name.'<br>';

						$e2s = $e1->getElementsByTagName('header');
						foreach($e2s as $e2){
							if($e2->getAttribute('class') == 'entry-header'){
								$temp = strip_tags($e2->textContent);
								$data['title'] = trim($temp);
							}
						}

						$e2s = $e1->getElementsByTagName('div');
						foreach($e2s as $e2){
							if($e2->getAttribute('class') == 'entry-content'){
								// Excerpt
								$e3s = $e2->getElementsByTagName('p');
								foreach($e3s as $e3){
									//backup, will be overwritten if a better text is found
									$data['text'] = trim($e3->textContent);
								}

								// Text and publishdate
								$e3s = $e2->getElementsByTagName('a');
								foreach($e3s as $e3){
									if(strpos($e3->getAttribute('class'), 'read-more') !== false){
										$data['url'] = $e3->getAttribute('href');

										$response = ScraperComponent::getHttpResponse($data['url']);
										$doc = new \DOMDocument();
										@$doc->loadHTML($response);
										$e4s = $doc->getElementsByTagName('article');
										foreach($e4s as $e4){
											$e5s = $e4->getElementsByTagName('p');
											$text = '';
											foreach($e5s as $e5){
												$text .= $e5->textContent;
											}
											if(trim($text) != '')
												$data['text'] = $text;

											$e5s = $e4->getElementsByTagName('time');
											foreach($e5s as $e5){
												$data['date'] = $e5->getAttribute('datetime');
											}
										}
									}
								}

								//Image
								$e3s = $e2->getElementsByTagName('img');
								foreach($e3s as $e3){
									if(strpos($e3->getAttribute('class'), 'wp-post-image') !== false){
										$data['media'][0]['url'] = $e3->getAttribute('src');
									}
								}
							}
						}
					}

					// item exists in db
					if($existingart = Article::where('title', ScraperComponent::truncate(ScraperComponent::verify($data['title'])))->first()){
						$messages .= '<br><b>- Item seem to already exists as article_id = '.$existingart->id.'</b>';
						unset($data);
						continue;
					}
					// item is older than the last the source was checked
					elseif(isset($data['date']) && strtotime($data['date']) < strtotime($source->last_checked_item)){
						$messages .= '<br><b>- Item is older than last check. It must\'ve been reviewed before.</b>';
						unset($data);
						continue;
					}

					$save_result = ScraperComponent::saveArticle(ArticleController::typeNews, $source, $data);
					//var_dump($data);

					if($save_result['status'] == 'ok'){
						$messages .= '<br><b>- Added '.$save_result['model']->id.':</b> '.$save_result['model']->excerpt;
						$return['status'] = 'ok';
						$return['count']++;
					} else {
						$messages .= '<br><b>- Error adding: '.$data['title'].'</b>';
						$return['errors']++;
					}

					unset($data);
				}

				if($e1s->length == 0){
					$end = true;
				}
				$page++;

			}

			$messages .= '<br><br><b>';
			if($return['status'] == 'ok'){
				$messages .= 'Source '.$source->id.': done with '.$return['count'].' new items and '.$return['errors'].' errors.';

				$source->last_checked_item = date("Y-m-d H:i:s");
				$source->save();

				$mlog = new ScrapeLog();
				$mlog->source_id = $source->id;
				$mlog->automated = 0;
				$mlog->url = $source->url;
				$mlog->saved_count = $return['count'];
				$mlog->last_item = date("Y-m-d H:i:s");
				$mlog->data = '';//$return['data'];
				$mlog->save();
			} elseif($return['count'] == 0 && $return['errors'] == 0){
				$messages .= 'Source '.$source->id.': Finished with 0 new items';
			} else {
				$messages .= 'Source '.$source->id.': DID NOT COMPLETE DUE TO AN ERROR.';
			}
			$messages .= '</b><br>';

		}


		echo $messages;
		// convert html tags to something easier to read before saving the log file
		$messages = str_replace("<br>", "\n", $messages);
		$messages = strip_tags($messages);

		if (!is_dir(storage_path()."/logs/scheduler"))
			mkdir(storage_path()."/logs/scheduler", 0744, true);

		file_put_contents(storage_path()."/logs/scheduler/scrapeIRDR_".date("YmdHis").".log", $messages);
	}

	/**
	 * Prepares scraper tables based on currently available data in the DB as well as new data
	 * Currently fills in ScrapeSource table based on NewsFeeds table and populates keywords table
	 * based on a batch of preliminary keywords
	 */
	public function initialize()
	{
		// add all current rss sources to the source list
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

		//populate the keywords table with some basic keys
		$keys = array('Terrorism'=>[4], 'Terrorist'=>[4], 'Breach'=>[4], 'Security'=>[4], 'Cybersecurity'=>[4], 'Threat'=>[4], 'Cybercrime'=>[4],
			'Civil Protection'=>[4], 'Risk Reduction'=>[3,4], 'Preparedness'=>[3,4], 'Mitigation'=>[3], 'Infrastructure'=>[3], 'Recovery'=>[3], 'Response'=>[3], 'Humanitarian'=>[6],
			'Pandemic'=>[1], 'Epidemic'=>[1], 'Endemic'=>[1], 'Outbreak'=>[1], 'Quarentine'=>[1], 'Virus'=>[1],
			'Risk Management'=>[5], 'Continuity'=>[5], 'Resiliency'=>[5], 'Resilience'=>[5], 'Communication'=>[3,5], 'Training'=>[3,5], 'Exercise'=>[3,5],
			'Relief'=>[3,6], 'Aid'=>[3,6], 'Coordination'=>[3,6],
			'Earthquake'=>[6], 'Hurricane'=>[6], 'Cyclone'=>[6], 'Typhoon'=>[6], 'Tsunami'=>[6], 'Tornado'=>[6], 'Tropical Storm'=>[6], 'Landslide'=>[6], 'Mudslide'=>[6], 'Flood'=>[6], 'Ice Storm'=>[6], 'Volcano'=>[6], 'Storm Surge'=>[6], 'Severe Weather'=>[6],
			'Oil Spill'=>[1,3,6], 'Nuclear'=>[1,3,6], 'Chemical Spill'=>[1,3,6], 'Train Derailment'=>[5,3], 'Bridge Collapse'=>[5,3], 'Active Shooter'=>[3] );
		$negative_keys = array('newsletter', 'workshop');
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

		// Add custom sources
		$irdr_urls = array('http://www.irdrinternational.org/irdr-publications/'=>['IRDR'],
						   'http://www.irdrinternational.org/other-publications/'=>['IRDR'],
						   'http://www.irdrinternational.org/co-sponsors-publications/'=>['IRDR'],
						   'http://feeds.sciencedaily.com/sciencedaily/earth_climate/natural_disasters'=>['RSS']);
		foreach($irdr_urls as $irdr_url=>$meta){
			$exists = ScrapeSource::where(array('url'=>$irdr_url))->first();
			if(!$exists){
				$model = new ScrapeSource();
				$model->type = $meta[0];
				$model->url = $irdr_url;
				$model->division_id = 0;
				$model->save();

				echo '<br>Added '.$meta[0].' source: '.$irdr_url;
			}
		}

	}

	/**
	 * All purpose function to allow code testing and on-the-fly adjustments using various $_GET params
	 */
	public function toolbox()
	{
		echo 'hi ';
		echo 'there';
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
