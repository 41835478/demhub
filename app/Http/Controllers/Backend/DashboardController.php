<?php namespace App\Http\Controllers\Backend;

use App\Http\Components\Helpers;
use App\Http\Components\Scraper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\ArticleController;
use App\Models\Article;
use App\Models\ArticleMedia;
use App\Models\ArticleReport;
use App\Models\Division;
use App\Models\Keyword;
use App\Models\ScrapeSource;
use App\Models\Content;
use App\Models\ContentMedia;
use App\Models\InfoResource;
use App\Models\Publication;
use Riari\Forum\Models\Thread;
use Illuminate\Http\Request;
use Weblee\Mandrill\Mail;
use League\Csv\Reader;
use DB;
use File;
use	Carbon\Carbon;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller {

	private $mandrill;

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('backend.dashboard');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function keywords(Request $request)
	{
		$form_submit = false;

		if($request->input("submit", "") == "save"){
			$form_submit = true;
			if($request->input("id") == 0){
				$keyword = new Keyword();
			} else {
				$keyword = Keyword::find($request->input("id"));
			}

			$keyword->divisions = Helpers::convertDBArrayToString($request->input("div", ""));
			$keyword->keyword = $request->input("keyword");
			$keyword->weight = $request->input("weight");
			if($keyword->save()){
				$request->session()->flash('status', 'Success');
			} else {
				$request->session()->flash('status', 'Failed!');
			}
		}
		elseif($request->input("submit", "") == "x"){
			$form_submit = true;
			$keyword = Keyword::find($request->input("id"));
			$keyword->delete();
			$request->session()->flash('status', 'Deleted.');
		}
		$items = Keyword::orderBy('id', 'DESC')->get();
		$divisions = Division::all();

		if($form_submit){
			return redirect()->route('backend.keywords');
		} else {
			return view('backend.keywords', compact('items', 'divisions'));
		}

	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function sources(Request $request)
	{
		$form_submit = false;

		if($request->input("submit", "") == "save"){
			$form_submit = true;
			if($request->input("id") == 0){
				$item = new ScrapeSource();
			} else {
				$item = ScrapeSource::find($request->input("id"));
			}
			$item->type = $request->input("type", "");
			$item->article_type = $request->input("article_type", ArticleController::typeOther);
			$item->title = $request->input("title");
			$item->url = $request->input("url");
			if($item->save()){
				$request->session()->flash('status', 'Success');
			} else {
				$request->session()->flash('status', 'Failed!');
			}
		}
		elseif($request->input("submit", "") == "x"){
			$form_submit = true;
			$item = ScrapeSource::find($request->input("id"));
			$item->deleted = 1;
			$item->save();
			$request->session()->flash('status', 'Deleted.');
		}

		$items = ScrapeSource::where('deleted', 0)->orderBy('id', 'DESC')->get();
		$divisions = Division::all();

		if($form_submit){
			return redirect()->route('backend.sources');
		} else {
			return view('backend.sources', compact('items', 'divisions'));
		}
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function articles(Request $request)
	{

		$form_submit = false;

		if($request->input("submit", "") == "save"){
			$form_submit = true;
			if($request->input("id") == 0){
				$item = new Article();
			} else {
				$item = Article::find($request->input("id"));
			}
			$item->type = $request->input("type");
			$item->title = Helpers::truncate($request->input("title"));
			$item->language = trim($request->input("language",''))=='' ? null : $request->input("language",'');
			if(trim($request->input("location", '')) != ''){
				$coords = self::getCoords($request->input("location", ''));
				if($coords['lat']!=null && $coords['lng']!=null){
					$location_info = self::getLocationInfo($coords['lat'], $coords['lng']);
					$item->city 	= $location_info!=null ? $location_info['city'] : null;
					$item->state 	= $location_info!=null ? $location_info['state'] : null;
					$item->country 	= $location_info!=null ? $location_info['country'] : null;
					$item->lat 		= $location_info!=null ? $location_info['lat'] : null;
					$item->lng 		= $location_info!=null ? $location_info['lng'] : null;
				}
			}

			if($item->save()){
				$request->session()->flash('status', 'Success');
			} else {
				$request->session()->flash('status', 'Failed!');
			}
		}
		elseif($request->input("submit", "") == "x"){
			$form_submit = true;
			$item = Article::find($request->input("id"));
			$item->deleted = 1;
			$item->save();
			$request->session()->flash('status', 'Deleted.');
		}

		if( ($id = $request->input("id", 0)) ){
			$items = Article::where('id', $id)->get();
		} else {
			$items = Article::where('deleted', 0)
				->skip(($request->input("page",1)-1) * 500)
				->take(500)
				->orderBy('id', 'DESC')
				->get();
		}

		$divisions = Division::all();

		if($form_submit){
			return redirect()->route('backend.articles');
		} else {
			return view('backend.articles', compact('items', 'divisions'));
		}

	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function reports(Request $request)
	{

		$form_submit = false;

		if($request->input("submit", "") == "save"){
			$form_submit = true;
			$item = ArticleReport::find($request->input("id"));
			$item->result = $request->input("result");
			$item->data = $request->input("data");

			if($item->save()){
				$request->session()->flash('status', 'Success');
			} else {
				$request->session()->flash('status', 'Failed!');
			}
		}

		$items = ArticleReport::orderBy('id', 'DESC')->get();

		if($form_submit){
			return redirect()->route('backend.reports');
		} else {
			return view('backend.reports', compact('items'));
		}

	}

	/**
	 * @param Request $request
	 * @return \Illuminate\View\View
	 */
	public function signup(Request $request)
	{
		$conferenceDataFolder = database_path().'/data/iaem_conference';
		// $files = preg_grep('~\.(csv)$~', scandir($conferenceDataFolder));
		$files = array();
		foreach (glob($conferenceDataFolder."/*.csv") as $file) {
		  $files[] = $file;
		}

		if ($request->input('filename')) {

			$csv_file = $request->input('filename');
	    $csv = Reader::createFromPath($csv_file);

			$csv->setOffset(1)->fetchAll(function ($row) {
				$location = "";

				if (!empty($row[10])) {
					$location = $row[10];
				}

				if (!empty($location) && !empty($row[11])) {
					$location = $location . ', ' . $row[11];
				} else if (empty($location) && !empty($row[11])) {
					$location = $row[11];
				}

				if (!empty($location) && !empty($row[12])) {
					$location = $location . ', ' . $row[12];
				} else if (empty($location) && !empty($row[12])) {
					$location = $row[12];
				}

				$data = [
					"first_name" => $row[0],
					"last_name" => $row[1],
					"email" => $row[5],
					"job_title" => $row[8],
					"organization_name" => $row[4],
					"location" => $location
				];
				$this->sendEmail($data);
	    });

			return view('backend.signupblast', compact(['files']))
									->withFlashSuccess("Successfully sent emails to selected batch!");
		} else {
			return view('backend.signupblast', compact(['files']));
		}


	}

	/**
	 * @param null
	 * @return \Illuminate\View\View
	 */
	public function sendEmail($data)
	{
		$email_path =  public_path().'/images/emails/las-vegas-dem-conference/';
		try {
				// $mandrill = new Mandrill(env('MANDRILL_SECRET'));
				$template_name = 'las-vegas-dem-conference';
				$template_content = array( // required for some reason
						array(
								'name' => 'example name',
								'content' => 'example content'
						)
				);
				$message = array(
						// 'html' => '<p>Example HTML content</p>',
						// 'text' => 'Example text content',
						// 'subject' => 'example subject',
						// 'from_email' => 'message.from_email@example.com',
						// 'from_name' => 'Example Name',
						'to' => array(
								array(
										'email' => $data['email'],
										'name' => $data['first_name'] . ' ' . $data['last_name'],
										'type' => 'to'
								)
						),
						'headers' => array('Reply-To' => 'info@demhub.net'),
						'important' => false,
						'track_opens' => null,
						'track_clicks' => null,
						'auto_text' => null,
						'auto_html' => null,
						'inline_css' => null,
						'url_strip_qs' => null,
						'preserve_recipients' => null,
						'view_content_link' => null,
						// 'bcc_address' => 'message.bcc_address@example.com',
						'tracking_domain' => null,
						'signing_domain' => null,
						'return_path_domain' => null,
						'merge' => true,
						'merge_language' => 'mailchimp',
						// 'global_merge_vars' => array(
						//     array(
						//         'name' => 'merge1',
						//         'content' => 'merge1 content'
						//     )
						// ),
						'merge_vars' => array(
								array(
										'rcpt' => $data['email'],
										'vars' => array(
												array(
														'name' => 'autoregister_link',
														'content' => url(
															'auth/autoregister?first_name=' . $data['first_name'] .
															'&last_name=' . $data['last_name'] .
															'&email=' . $data['email'] .
															'&job_title=' . $data['job_title'] .
															'&organization_name=' . $data['organization_name'] .
															'&location=' . $data['location']
														)
												)
										)
								)
						),
						// 'tags' => array('password-resets'),
						// 'subaccount' => 'customer-123',
						// 'google_analytics_domains' => array('demhub.net'),
						// 'google_analytics_campaign' => 'message.from_email@example.com',
						// 'metadata' => array('website' => 'www.example.com'),
						// 'recipient_metadata' => array(
						//     array(
						//         'rcpt' => 'recipient.email@example.com',
						//         'values' => array('user_id' => 123456)
						//     )
						// ),
						// 'attachments' => array(
						//     array(
						//         'type' => 'text/plain',
						//         'name' => 'myfile.txt',
						//         'content' => 'ZXhhbXBsZSBmaWxl'
						//     )
						// ),
						'images' => array(
								array(
										'type' => 'image/png',
										'name' => 'banner',
										'content' => File::get($email_path.'banner.txt')
								),
								array(
										'type' => 'image/png',
										'name' => 'secondary',
										'content' => File::get($email_path.'secondary.txt')
								),
								array(
										'type' => 'image/png',
										'name' => 'twitter',
										'content' => File::get($email_path.'twitter.txt')
								)
						)
				);
				$async = false;
				// $ip_pool = 'Main Pool';
				// $send_at = 'example send_at';
				// $result = $mandrill->messages()->sendTemplate($template_name, $template_content, $message, $async);
				$result = \MandrillMail::messages()->sendTemplate($template_name, $template_content, $message, $async);
				// print_r($result);
		} catch(Mandrill_Error $e) {
				// Mandrill errors are thrown as exceptions
				dd ('A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage());
				// i.e. A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
				throw $e;
		}

	}

	/**
	 * @param null
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function scripts()
	{
		$scripts = ['articles', 'threads', 'info_resources', 'publications'];
		$scripts = [];
		return view('backend.scripts', compact('scripts'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\View\View
	 */
	public function runScript(Request $request)
	{
		DB::table('articles')->chunk(100, function($articles) {
      foreach ($articles as $index => $article) {
        $data = json_encode([
					$article->language,
					$article->type
				]);
				$publish_date = $article->publish_date ?
					Carbon::parse($article->publish_date) : NULL;

				$content = Content::firstOrCreate([
					'subclass' => 'article',
					'name' => $article->title,
					'description' => $article->excerpt,
					'data' => $data,
					'divisions' => $article->divisions,
					'keywords' => $article->keywords,
					'slug' => NULL,
					'url' => $article->source_url,
					'country' => $article->country,
					'state' => $article->state,
					'city' => $article->city,
					'lat' => $article->lat,
					'lng' => $article->lng,
					'pinned_by' => NULL,
					'pinned_at' => NULL,
					'visibility' => 1,
					'status_flag' => $article->review,
					'owner_id' => $article->source_id,
					'deleted' => $article->deleted,
					'publish_date' => $publish_date
				]);

				$media = DB::table('article_medias')->where('article_id', $article->id)->first();

				if ($media) {
					$newMedia = ContentMedia::firstOrCreate([
						'content_id' => $content['id'],
						'resource_file_name' => $media->filename,
						'resource_file_size' => NULL,
						'resource_content_type' => $media->filetype,
						'resource_updated_at' => $media->updated_at,
						'description' => $media->description,
						'view_order' => $media->view_order,
						'deleted' => $media->deleted
					]);
				}
      }
    });

		DB::table('info_resources')->chunk(100, function($infoResources) {
      foreach ($infoResources as $infoResource) {

				// TODO - Parse divisions function

				$divisions = [];
				$keywords = [];
				$meta = $this->convertResourceMeta($infoResource->divisions, $infoResource->keywords);

				$content = Content::firstOrCreate([
					'subclass' => 'infoResource',
					'name' => $infoResource->name,
					'description' => NULL,
					'data' => NULL,
					'divisions' => $meta['divisions'],
					'keywords' => $meta['keywords'],
					'slug' => NULL,
					'url' => $infoResource->url,
					'country' => $infoResource->country,
					'state' => $infoResource->region,
					'city' => NULL,
					'lat' => NULL,
					'lng' => NULL,
					'pinned_by' => NULL,
					'pinned_at' => NULL,
					'visibility' => 1,
					'status_flag' => NULL,
					'owner_id' => NULL,
					'deleted' => false,
					'publish_date' => NULL
				]);
      }
    });

		// DB::table('forum_threads')->chunk(100, function($threads) {
    //   foreach ($threads as $thread) {
		// 		$pinned_date = $thread['pinned'] ? Carbon::now() : NULL;
		// 		$division = Division::where('id', '=', $thread['parent_category'])->first();
		// 		$deleted = $thread['deleted_at'] ? true : false;
		//
		// 		$content = Content::firstOrCreate([
		// 			'subclass' => 'thread',
		// 			'name' => $thread['title'],
		// 			'description' => NULL,
		// 			'data' => json_encode([
		// 				$thread['view_count']
		// 			]),
		// 			'divisions' => '|'.$division->id.'|',
		// 			'keywords' => NULL,
		// 			'slug' => NULL,
		// 			'url' => NULL,
		// 			'country' => NULL,
		// 			'state' => NULL,
		// 			'city' => NULL,
		// 			'lat' => NULL,
		// 			'lng' => NULL,
		// 			'pinned_by' => NULL,
		// 			'pinned_at' => $pinned_date,
		// 			'visibility' => 1,
		// 			'status_flag' => $thread['locked'],
		// 			'owner_id' => $thread['author_id'],
		// 			'deleted' => $deleted,
		// 			'publish_date' => NULL
		// 		]);
    //   }
    // });

		DB::table('publications')->chunk(100, function($publications) {
      foreach ($publications as $publication) {
				$data = json_encode([
					$publication->volume,
					$publication->issues,
					$publication->pages,
					$publication->publisher,
					$publication->institution,
					$publication->conference,
					$publication->publication_author,
					$publication->favorites,
					$publication->views
				]);

				$publish_date = $publication->publication_date ?
					Carbon::parse($publication->publication_date) : NULL;

				$visibility = $publication->privacy ?: '1';

				$content = Content::firstOrCreate([
					'subclass' => 'publication',
					'name' => $publication->title,
					'description' => $publication->description,
					'data' => $data,
					'divisions' => $publication->divisions,
					'keywords' => $publication->keywords,
					'slug' => NULL,
					'url' => NULL,
					'country' => NULL,
					'state' => NULL,
					'city' => NULL,
					'lat' => NULL,
					'lng' => NULL,
					'pinned_by' => NULL,
					'pinned_at' => NULL,
					'visibility' => $visibility,
					'status_flag' => NULL,
					'owner_id' => $publication->user_id,
					'deleted' => $publication->deleted,
					'publish_date' => $publish_date
				]);

				if ($publication->document_file_name) {
					$newMedia = ContentMedia::firstOrCreate([
						'content_id' => $content['id'],
						'resource_file_name' => $publication->document_file_name,
						'resource_file_size' => $publication->document_file_size,
						'resource_content_type' => $publication->document_content_type,
						'resource_updated_at' => $publication->document_updated_at,
						'description' => NULL,
						'view_order' => 0,
						'deleted' => false
					]);
				}
      }
    });

		$scripts = [];
		return view('backend.scripts', compact('scripts'));
	}

	private function convertResourceMeta($divs_str, $keywords_str)
  {		
      $divs = explode(',', $divs_str);
      $keywords = explode(',', $keywords_str);
      $new_divs = [];
      $new_keywords = [];
      $conversion = [
				'heath'=>'1','health'=>'1',
				'science research Academia'=>'2','Academia'=>'2','Research'=>'2','Science'=>'2','Science Research'=>'2',
				'EM'=>'3','practitioner'=>'3','Response'=>'3',
				'Civil'=>'4','Cyber Security'=>'4','civil protection'=>'4','cyber terrorism'=>'4',
				'business continuity'=>'5','business'=>'5','continuity'=>'5',
				'ngo'=>'6','humanitarian'=>'6',
			];

      foreach($divs as $div){
          $found = false;
          foreach($conversion as $label=>$con){
              if(trim($div) == $label){
                  if(!in_array($con, $new_divs))
                      $new_divs[] = $con;
                  $found = true;
              }
          }
          foreach($keywords as $key){
              if(!in_array(trim($key), $new_keywords))
                  $new_keywords[] = trim($key);
          }
          if(!$found && !in_array(trim($div), $new_keywords)){
              $new_keywords[] = trim($div);
          }
      }

      return array('divisions'=>Helpers::convertDBArrayToString($new_divs),
                   'keywords'=>Helpers::convertDBArrayToString($new_keywords));
  }

}
