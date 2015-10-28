<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Components\ScraperComponent;
use App\Models\Article;
use App\Models\Keyword;
use App\Models\NewsFeed;
use App\Models\ScrapeSource;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Nathanmac\Utilities\Parser\Parser;

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
			}

		}

		$keys = array('Terrorism'=>'', 'Terrorist'=>'', 'Breach'=>'', 'Security'=>'', 'Cybersecurity'=>'', 'Threat'=>'', 'Cybercrime'=>'',
			'Civil Protection'=>'', 'Risk Reduction'=>'', 'Preparedness'=>'', 'Mitigation'=>'', 'Infrastructure'=>'', 'Recovery'=>'', 'Response'=>'', 'Humanitarian'=>'',
			'Pandemic'=>'', 'Epidemic'=>'', 'Endemic'=>'', 'Outbreak'=>'', 'Quarentine'=>'', 'Virus'=>'',
			'Risk Management'=>'', 'Continuity'=>'', 'Resiliency'=>'', 'Resilience'=>'', 'Communication'=>'', 'Training'=>'', 'Exercise'=>'',
			'Relief'=>'', 'Aid'=>'', 'Coordination'=>'',
			'Earthquake'=>'', 'Hurricane'=>'', 'Cyclone'=>'', 'Typhoon'=>'', 'Tsunami'=>'', 'Tornado'=>'', 'Tropical Storm'=>'', 'Landslide'=>'', 'Mudslide'=>'', 'Flood'=>'', 'Ice Storm'=>'', 'Volcano'=>'', 'Storm Surge'=>'', 'Severe Weather'=>'',
			'Oil Spill'=>'', 'Nuclear'=>'', 'Chemical Spill'=>'', 'Train Derailment'=>'', 'Bridge Collapse'=>'', 'Active Shooter'=>'' );

		foreach($keys as $k=>$d){
			$slug = ScraperComponent::generateSlug($k);
			$exists = Keyword::where(array('slug'=>$slug))->first();
			if(!$exists){
				$model = new Keyword();
				$model->weight = 1;
				$model->keyword = strtolower($k);
				$model->slug = $slug;
				$model->divisions = $d;
				$model->save();
			}

		}
	}

	/**
	 * All purpose function to allow code testing and on-the-fly adjustments using various $_GET params
	 */
	public function toolbox()
	{
		// Initialize the cURL session with the request URL
		//$session = curl_init("http://feeds.reuters.com/reuters/topNews");
		$session = curl_init($_GET['url']);
		// Tell cURL to return the request data
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
		// Execute cURL on the session handle
		$response = curl_exec($session);
		//$results = json_decode($response, true);
		// Close the cURL session
		curl_close($session);

		$parser = new Parser();
		$parsed = $parser->xml($response);

		var_dump($parsed['channel']['item']);
		//return $parsed;

		//
		//return ScraperComponent::truncate($_GET['url'], 20);
		//return $_GET['url'];
	}

	/**
	 * Function designed to be called by the crontab
	 * Will review and bring all new articles from 'RSS' type sources in the scrape_sources table
	 */
	public function scrapeRSS()
	{

	}


}