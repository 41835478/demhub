<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\User\UserContract;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Models\Division;
use App\Models\Access\User\User;
use Auth;

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

	public function view_public_profile($user_name) {
		$secondMenu = true;
		$allDivisions = Division::all();
		$type = 'teaser';
		if(is_numeric($user_name)){
			$user = User::where('id', $user_name)->firstOrFail();
		} else{
			$user = User::where('user_name', $user_name)->firstOrFail();
		}

		return view('frontend.user.public_profile', compact([
			'user', 'secondMenu', 'allDivisions', 'type'
		]));
	}

	public function listing_of_profiles() {
		$secondMenu = true;
		$type = 'teaser';
		$users = User::where('id', '!=', Auth::id())
									->where('user_name', '!=', 'demhub')
									->orderBy('id','DESC')->get();
		return view('frontend.user.profiles',
			compact(['users','secondMenu','type'])
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

	public function followUser($id) {
		if (!Auth::user()->is_following($id)) {
			Auth::user()->following()->attach($id);
		}

		// TODO - Do this properly
        // $content_json = Helpers::return_json_results($content_json);
        return response()->json([
            'success' => 'cool',
            'message'=> 'Contents rendered',
            'content' => 'blah'
        ]);
	}

	public function unfollowUser($id) {
		if (Auth::user()->is_following($id)) {
			Auth::user()->following()->detach($id);
		}

		// TODO - Do this properly
        // $content_json = Helpers::return_json_results($content_json);
        return response()->json([
            'success' => 'cool',
            'message'=> 'Contents rendered',
            'content' => 'blah'
        ]);
	}
}
