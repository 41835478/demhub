<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Publication;
use App\Models\Access\User\User;
use App\Repositories\Frontend\User\UserContract;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use Illuminate\Http\Request;
use Image;
use Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller {

	/**
	 * @return mixed
	 */
	public function index()
	{
		return view('frontend.user.dashboard.index')
			->withUser(auth()->user());
	}


	public function test()
	{
		return view('frontend.user.dashboard.test')
			->withUser(auth()->user());
	}

	public function showConnections()
	{

		$users = User::where('id', '!=', Auth::id())
									->where('user_name', '!=', 'demhub')
									->orderBy('id','DESC')->get();

		return view('frontend.user.dashboard.connections', compact([
					'users'
		]));
	}

	public function showBookmarks()
	{
		$users = User::all();
		$publications = Publication::all();

		return view('frontend.user.dashboard.bookmarks', compact([
					'users', 'publications'
		]));
	}
}
