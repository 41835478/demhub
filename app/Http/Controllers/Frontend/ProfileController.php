<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\User\UserContract;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;

use App\Models\Access\User\User;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Frontend
 */
class ProfileController extends Controller {

	/**
	 * @return mixed
     */
	public function edit() {
		return view('frontend.user.profile.edit')
			->withUser(auth()->user());
	}

	public function view_public_profile($id) {

		$user = User::findOrFail($id);
		return view('frontend.user.public_profile', compact(['user'])
	);
	}

	public function listing_of_profiles() {
		$secondMenu = true;
		$users = User::orderBy('id','DESC')->get();
		return view('frontend.user.profiles', compact(['users','secondMenu'])
	);
	}

	/**
	 * @param UserContract $user
	 * @param UpdateProfileRequest $request
	 * @return mixed
	 */
	public function update(UserContract $user, UpdateProfileRequest $request) {
		$user->updateProfile($request->all());
		return redirect()->route('dashboard')->withFlashSuccess(trans("strings.profile_successfully_updated"));
	}
}
