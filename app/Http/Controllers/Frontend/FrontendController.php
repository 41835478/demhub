<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Models\Article;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Mail;

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

			return view('frontend.index', [
				'divisions' => $divisions
			]);
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
			return view('frontend.index', [
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
		return view('frontend.policy');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function terms()
	{
		return view('frontend.terms');
	}

	public function signUpSuccess()
	{
		return view('frontend.signUpSuccess');
	}
}
