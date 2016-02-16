<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Models\Article;
use App\Models\Content;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Http\Components\Emailer;
use League\Csv\Reader;
use DB;
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
			Emailer::sendInviteEmail($data);
		}

		return redirect('connections')
					->withFlashSuccess("Successfully sent invitiations!");
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
    public function contentThreadConnect ($contentId){
        $item=Content::where('id',$contentId)->first();


        $title=$item['name'];
        $content=$item['url'];

        header("Location: ".url('').'/forum/7-category/thread/connect/'.$contentId);
        die();
    }

	/**
	 * @return \Illuminate\View\View
	 */
	public function about()
	{
		$membersLarge = [

		];

		$membersMedium = [
            "JenniferD" => [
				"name" => "Jennifer Duke Holmes",
				"position" => "Founder, CEO",
				"description" => "Jennifer has spent over 5 years in the Disaster and Emergency Management field as both an academic and an entrepreneur. She founded Hybrid Intuition Media in 2013 which develops digital media materials within an emergency management context. Jen has also been President of the global student membership for the International Association of Emergency Managers, the world's largest association of its kind."
			],
            "PoyaR" => [
				"name" => "Poya Rahmati",
				"position" => "Chief Technology Officer",
				"description" => ""
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
			],
			"LeonH" => [
				"name" => "Leon Haggarty",
				"position" => "Full Stack Developer",
				"description" => NULL
			],
			"JiaoX" => [
				"name" => "Jiao Xue",
				"position" => "UI & UX Designer",
				"description" => NULL
			],
			"PriscillaW" => [
				"name" => "Priscilla Wong",
				"position" => "UI & UX Designer",
				"description" => NULL
			],
			"HilaryJ" => [
				"name" => "Hilary Julien",
				"position" => "Social Media",
				"description" => NULL
			]
		];
        $advisorsMedium = [
            "willO" => [
				"name" => "Will Ollerhead",
				"position" => "Strategic Business Development",
				"description" => NULL
			],
            "SeanK" => [
				"name" => "Sean Kondra",
				"position" => "Strategic Business Development",
				"description" => NULL
			],
            "richardS" => [
				"name" => "Richard Serino",
				"position" => "EM Preparedness & Technology",
				"description" => NULL
			],
            "JaneR" => [
				"name" => "Jane Rovins",
				"position" => "EM Science and Research",
				"description" => NULL
			],
            "MargV" => [
				"name" => "Marg Verbeek",
				"position" => "EM Industry and Consultation",
				"description" => NULL
			],
        ];

		return view('frontend.about.index', [
			'membersLarge' => $membersLarge,
			'membersMedium' => $membersMedium,
            'advisorsMedium' => $advisorsMedium
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

	}

	public function unsubscribe(Request $request)
	{
		$email = $request->input('email','na');
		$storage_file = storage_path() . '/app/unsubscribed_emails.json';
		if(file_exists($storage_file)){
			$current_list = json_decode(file_get_contents($storage_file));
		} else{
			$current_list = array();
		}

		$new_item['email'] = $email;
		$new_item['created'] = time();

		$current_list[] = $new_item;

		file_put_contents($storage_file, @json_encode($current_list));

		return view('frontend.user.unsubscribe', compact(['email']));
	}
}
