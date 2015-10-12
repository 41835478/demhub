<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use SimplePie;


/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class UserController extends Controller {

	/**
	 * User Homepage
	 */
	public function showUserHome(){
        $allDivisions = Division::all();

        $newsFeeds = array();
        foreach ($allDivisions as $div) {
          $newsFeeds = array_merge($newsFeeds, $div->newsFeeds->lists('url')->all());
        }
        $newsFeeds = $this -> simplepie_feed($newsFeeds);
		return view('frontend.user.userhome', [
					'divisions'  => $division,
					'allDivisions' => $allDivisions,
					'newsFeeds' => $newsFeeds
					]);
						
	}
    
	
	/**
	 * @return \Illuminate\View\View
	 */
	public function macros()
	{
		return view('frontend.macros');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function about()
	{
		return view('frontend.about');
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
}
