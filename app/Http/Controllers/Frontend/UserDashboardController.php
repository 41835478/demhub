<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use Request;
use Auth;
/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class UserDashboardController extends Controller {

	/**
	 * User Homepage
	 */
	public function showSelfProfile() {
		$division = Division::all();
		$userMenu = false;
		$user = Auth::user();
		
		//go to users settings page
		if (Request::isMethod('get')) {
			$userid = Auth::user()->id;

			return view('frontend.user.user_dashboard.self_profile')
						->with('action', url('self_profile'))
						->with('divisions', $division)
						->with('allDivisions', $division)
						->with('userMenu', $userMenu)
						->with('user', $user);
		}
		else {
			$id = Auth::user()->id;
			$user = User::where('id', '=', $id)->first();
			$inputs;

			if (Input::hasFile('user_image')){
				    //
				    $inputs = array(
							'Username' 	=> Input::get('user_name'),
							'Image'		=> Input::file('user_image')
							);
					//print_r(Input::all());
			}
			else {
				$inputs = array(
							'Username' => Input::get('user_name'),
							);
			}
			//unique:users,user_name|
			$validate = Validator::make($inputs,
										array(
										'Username' 	=> 'required|min:3|max:120',
										'Image'		=> 'max:2000|mimes:jpeg,JPG,jpg,JPEG,png,PNG'
										));
			if ($validate->fails()){
				return Redirect::route('self_profile')->withErrors($validate->messages());
			}
			else {

				if (Input::file('user_image')->isValid()){

					$destinationPath = public_path().'/images/user'; // upload path
					$extension = Input::file('user_image')->getClientOriginalExtension(); // getting image extension
					$fileName = str_random(40).'.'.$extension; // re-name image
					Input::file('user_image')->move($destinationPath, $fileName); // uploading file to given path
					$img = Image::make($destinationPath.'/'.$fileName);
					$img->resize(100, null, function($c){
						$c->aspectRatio();
					});
					$img->save();
					$imageFile = $img->filename.'.'.$extension;
					$avatar = Avatar::where('avatar_user_id', '=', $id)
									->first();
					$avatar->file_name = $imageFile;
					$avatar->save();
					// sending back with message
					Session::flash('success', 'Upload successfull!');

				}
				else {
					Session::flash('error', 'uploaded file is not valid');
				}
				$user->user_name = Input::get('user_name');
				$user->job_title = Input::get('job_title');
				$user->org_agency = Input::get('org_agency');
				$user->specialization = Input::get('specialization');
				
				$user->save();
				
				return Redirect::route('self_profile');

			
				}
		
			}

	
		}


	
	
	
	

	/**
	 * @return \Illuminate\View\View
	 */
	public function terms()
	{
		return view('frontend.terms');
	}
}
