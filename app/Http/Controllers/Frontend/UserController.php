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
		$division = Division::all();
		// foreach ($division as $division){
// 		$divisionInd = Division::where('slug', $division->id);
//
// 		$newsFeedsTemp = $divisionInd->newsFeeds->lists('url')->all();
//
// 		}
		return view('frontend.user.userhome', [
					'divisions'  => $division
					
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
