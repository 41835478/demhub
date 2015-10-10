<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class UserController extends Controller {

	/**
	 * User Homepage
	 */
	public function showUserHome(){
		$divisions = Division::all();
		return view('frontend.user.userhome')
					->with('divisions', $divisions);
	}
	public function showResourceFilter(){
		$resourceRelation= ResourceRelation::all();
		$resourceEntry= ResourceEntry::all();
		$categories = Divisions::all();
		
		return view('frontend.user.resource-filter')
					->with('action', url("resource-filter"))
					->with('xmlcategories', $categories)	
					->with('resourceRelation', $resourceRelation)
					->with('resourceEntry', $resourceEntry);
					
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
