<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\follow_relationships;
use App\Models\Access\User\User;
use App\Repositories\Frontend\User\UserContract;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use Illuminate\Http\Request;
use Image;
use Auth;

/**
 * Class DashboardController.
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

		$user=auth()->user();
		$users=$user->following;
	
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
