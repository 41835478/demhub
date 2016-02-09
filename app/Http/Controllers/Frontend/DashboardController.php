<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\follow_relationships;
use App\Models\Access\User\User;
use App\Models\Division;
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
		$divisions = Division::all();
		return view('frontend.user.dashboard.index', compact([
			'divisions'
		]))->withUser(auth()->user());
	}

	public function showConnections()
	{
		$user 	= auth()->user();
		$users 	= $user->following;

		return view('frontend.user.dashboard.connections', compact([
			'users'
		]));
	}
}
