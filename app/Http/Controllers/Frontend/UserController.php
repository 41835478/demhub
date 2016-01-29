<?php namespace App\Http\Controllers\Frontend;

use App\Models\Content;
use App\Models\Division;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ArticleMedia;
use Es;
use Config;

/**
 * Class UserController
 * @package App\Http\Controllers\Frontend
 */
class UserController extends Controller {

	/**
	 * User Homepage
	 */
	public function index(Request $request){
		$allDivisions = $navDivisions = Division::all();
		return view('frontend.user.userhome', compact([
			'allDivisions'
		]))->render();
	}

	public function getActivities() {
		$contents = Content::where('subclass', '!=', 'infoResource')
											->orderBy('updated_at', 'desc')
											->paginate(30);
		$allDivisions = $navDivisions = Division::all();
		$html = view('frontend.user._activity_feed', compact([
			'contents', 'allDivisions'
		]))->render();

		return $html;
	}
}
