<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Models\Article;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Weblee\Mandrill\Mail;
use League\Csv\Reader;
use DB;
use File;
use	Carbon\Carbon;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller {

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		if (Auth::user()) {
			return redirect()->route('userhome');
		} else  {
			$divisions = Division::all();

			return view('frontend.landing.index', [
				'divisions' => $divisions
			]);
		}
	}

	// NOTE : temp function
    public function test()
	{
		return view('frontend.test.index');
	}

	public function inviteSignup(Request $request)
	{
		$inputs = $request->all();
		$user = Auth::user();
		$count=0;

		foreach ($inputs as $key => $input) {
			if ($key == '_token') {
			} else {
				$people[$count]->attributes['email']=$input;
			}
			$count++;
		}

		foreach($people as $person) {
			$data = [
				"first_name" => $user->full_name()."'s",
				"last_name" => "Friend",
				"email" => $person->attributes['email']
			];
			$this->sendInviteEmail($data);
		}

		return redirect('connections')
					->withFlashSuccess("Successfully sent invitiations!");
	}

	public function sendInviteEmail($data)
	{
		// TODO - Implement proper email path
		$email_path =  public_path().'/images/emails/las-vegas-dem-conference/';
		try {
				$template_name = 'invite-others';
				$template_content = array( // required for some reason
						array(
								'name' => 'example name',
								'content' => 'example content'
						)
				);
				$message = array(
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
						'tracking_domain' => null,
						'signing_domain' => null,
						'return_path_domain' => null,
						'merge' => true,
						'merge_language' => 'mailchimp',
						'merge_vars' => array(
								array(
										'rcpt' => $data['email'],
										'vars' => array(
												array(
														'name' => 'autoregister_link',
														'content' => url(
															'auth/autoregister?email=' . $data['email']
														)
												)
										)
								)
						),
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
				$result = \MandrillMail::messages()->sendTemplate($template_name, $template_content, $message, $async);
		} catch(Mandrill_Error $e) {
				// Mandrill errors are thrown as exceptions
				dd ('A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage());
				// i.e. A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
				throw $e;
		}
	}

	public function getLandingData() {
		$divisions = Division::all();
		$news = array();
		foreach ($divisions as $index => $div) {
			$temp_news = Article::where('divisions', 'LIKE', '%|'.$div->id.'|%')
										->orderBy('publish_date','desc')
										->limit(10)
										->get();
			$news = $news ? $news->merge($temp_news) : $temp_news;
		}

		$newsArray = [];
		foreach ($news as $index => $newsItem) {

			$image = NULL;
			if ($newsItem->mainMedia()) {
				$image = $newsItem->mainMediaUrl();
			}
			$divValues = [];
			foreach($newsItem->divisions() as $value) {
				$divValues[] = $value;
			}

			array_push($newsArray, json_encode([
				'title' => $newsItem->name,
				'date' => $newsItem->humanReadablePublishDate(),
				'tags' => implode(",", $newsItem->keywords()),
				'division' => $divValues,
				'image' => $image,
				'share' => NULL
			]));
		}

		$users = array();
		foreach ($divisions as $index => $div) {
			$temp_users = User::where('division', 'LIKE', '%|'.$div->id.'|%')
										->orderBy('updated_at','desc')
										->limit(10)->get();
			$users = $users ? $users->merge($temp_users) : $temp_users;
		}

		$usersArray = [];
		foreach ($users as $index => $userItem) {

			$image = NULL;
			if ($userItem->avatar) {
				$image = $userItem->avatar->url('medium');
			}
			$divValues = [];
			
			foreach($userItem->divisions() as $value) {
				$divValues[] = $value;
			}

			array_push( $usersArray,
				json_encode([
					'name' => $userItem->full_name(),
					'occupation' => $userItem->job_title,
					'location' => $userItem->location,
					'division' => $divValues,
					'profileImage' => $image,
					'followers' => count($userItem->followers)
				])
			);
		}

		// $content_json = Helpers::return_json_results($content_json);
		return response()->json([
			'success' => 'cool',
			'message'=> 'Contents rendered',
			'content' => [
				'news' => $newsArray,
				'users' => $usersArray
			]
		]);
	}

	public function postFeedback(Request $request)
	{
		// $question1 = $request->input('question1');
		// $question2 = $request->input('question2');
		// $question3 = $request->input('question3');
		// $inputs=array($question1, $question2, $question3);
		$inputs = $request->all();
		Mail::send('emails.feedback-email', ['inputs' => $inputs], function($message) {
				$message->to('demhubcontact@gmail.com','feedback bot')->subject('DEMHUB Feedback');
		});

		if (Auth::user()) {
			return redirect()->route('userhome');
		} else  {
			$divisions = Division::all();
			return view('frontend.landing.index', [
					'divisions' => $divisions
	   	]);
		}
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function about()
	{
		$membersLarge = [
			"JenniferD" => [
				"name" => "Jennifer Duke Holmes",
				"position" => "Founder, CEO",
				"description" => "Jennifer has spent over 5 years in the Disaster and Emergency Management field as both an academic and an entrepreneur. She founded Hybrid Intuition Media in 2013 which develops digital media materials within an emergency management context. Jen has also been President of the global student membership for the International Association of Emergency Managers, the world's largest association of its kind."
			],
			"AndrewC" => [
				"name" => "Andrew Cram",
				"position" => "Director Of Finance",
				"description" => "An adventurous, entrepreneurially-minded Financial professional who has worked for Coca-Cola as a Senior Financial Analyst, Thomson Reuters and State Street. Through his work experience, education at The University of Western Ontario in Finance & Accounting, and continuing Chartered Financial Analyst (CFA) studies, Andrew has exceptional knowledge in valuations, financial modeling & analysis, contract negotiation, corporate finance, and project management."
			],
			"AldoR" => [
				"name" => "Aldo Rui­z Luna",
				"position" => "Lead Developer",
				"description" => "Results-driven, user-focused software developer with 4+ years of cumulative industry experience in automation, scripting and web applications. Deep understanding of MVC architecture and translating business needs into technical requirements. Articulate and strategic lateral thinker with an entrepreneurial spirit."
			]
		];

		$membersMedium = [
			"LeonH" => [
				"name" => "Leon Haggarty",
				"position" => "Full Stack Developer",
				"description" => NULL
			],
			"JiaoX" => [
				"name" => "Jiao Xue",
				"position" => "UI/UX Designer",
				"description" => NULL
			],
			"PriscillaW" => [
				"name" => "Priscilla Wong",
				"position" => "UI/UX Designer",
				"description" => NULL
			],
			"HilaryJ" => [
				"name" => "Hilary Julien",
				"position" => "Media Manager",
				"description" => NULL
			]
		];

		return view('frontend.about.index', [
			'membersLarge' => $membersLarge,
			'membersMedium' => $membersMedium,
		]);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function policy()
	{
		return view('frontend.landing.policy');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function terms()
	{
		return view('frontend.landing.terms');
	}

	public function signUpSuccess()
	{
		return view('frontend.landing.signUpSuccess');
	}
}
