<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
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
				"description" => "Through work experience with Coca-Cola, Thomson Reuters and State Street, combined with University of Western Ontario Finance & Accounting degree (passed CMA entrance Exam), Chartered Financial Analyst (CFA) studies, has developed a thorough knowledge and understanding of contract and securities valuations, corporate finance, financial analysis, and capital markets."
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
