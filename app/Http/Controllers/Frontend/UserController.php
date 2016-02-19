<?php namespace App\Http\Controllers\Frontend;

use App\Models\Content;
use App\Models\Division;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Article;
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
		$allDivisions = Division::all();

		return view('frontend.user.userhome', compact([
			'allDivisions'
		]))->render();
	}

	public function getActivities() {
		$contents = Content::where('subclass', '!=', 'infoResource')
                                            ->where('deleted','!=',1)
											->orderBy('publish_date', 'desc')
											->orderBy('updated_at', 'desc')
											->paginate(30);
		$allDivisions = Division::all();
		$type = 'teaser';
		$html = view('frontend.user._activity_feed', compact([
			'contents', 'allDivisions', 'type'
		]))->render();

		return $html;
	}

    public function getArticles($scope) {
		if (is_numeric($scope)) {
			$contents = Article::where('divisions', 'LIKE', '%|'.$scope.'|%')
								->orderBy('publish_date', 'desc')
								->orderBy('updated_at', 'desc')
								->paginate(30);
		} else {
			$contents = Article::orderBy('publish_date', 'desc')
								->orderBy('updated_at', 'desc')
								->paginate(30);
		}

		$allDivisions = Division::all();
		$type = 'teaser';
		$html = view('frontend.user._activity_feed', compact([
			'contents', 'allDivisions', 'type'
		]))->render();

		return $html;
	}
}
