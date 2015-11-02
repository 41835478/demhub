<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Access\User\User;
use App\Repositories\Frontend\User\UserContract;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use Image;

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
	public function showConnections()
	{
		$allDivisions = Division::all();
		$users = User::all();

		return view('frontend.user.dashboard.connections', compact([
						'allDivisions', 'users'
						]));
	}
}
