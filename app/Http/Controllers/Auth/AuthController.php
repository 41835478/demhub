<?php

namespace DEMHub\Http\Controllers\Auth;

use DEMHub\Models\User;
use DEMHub\Models\Registration;
use DEMHub\Models\Avatar;
use Validator;
use Hash;
use DateTime;
use Auth;
use Redirect;
use Mail;
use DEMHub\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Auth Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'AuthController@');
	|
	*/
	public function sign_up() {
		if (Request::isMethod('get')) {
			return view('guest/sign-up')->with('action', url("sign-up"));
		} else {
			$name = Request::input('username');
			$email = Request::input('email');
			$password = Request::input('password');
			$remember = Request::input('remember');
			$firstName = Request::input('firstName');
			$lastName = Request::input('lastName');
			$jobTitle = Request::input('jobTitle');
			$orgAgency = Request::input('orgAgency');
			$phoneNumber = Request::input('phoneNumber');
			$specialization = Request::input('specialization');
			$remember = Request::input('remember');
			$input = array(
						'Username' 	=> $name,
						'Email' 	=> $email,
						'Password' => $password,
						'Remember' => $remember,
						'firstName' => $firstName,
						'lastName' => $lastName,
						'jobTitle' => $jobTitle,
						'orgAgency' => $orgAgency,
						'phoneNumber' => $phoneNumber,
						'specialization' => $specialization
			);

			$validate = Validator::make($input, array(
				'Username' 	=> 'unique:users,user_name|required|min:3|max:120',
				'Email' 		=> 'unique:users,user_email|required|email',
				'Password'	=> 'required|min:5|max:60'
			));

			if ($validate->fails()){
				return Redirect::route('sign-up')->withInput(Request::all())
											->withErrors($validate->messages());
			} else {
				$rmbr = Request::input('_token');
				$user = User::create(array(
					'user_name' 			=> $name,
					'user_email'			=> $email,
					'user_password'		=> Hash::make($password),
					'first_name'			=> $firstName,
					'last_name'				=> $lastName,
					'job_title'				=> $jobTitle,
					'org_agency'			=> $orgAgency,
					'phone_number'		=> $phoneNumber,
					'specialization'	=> $specialization,
					'remember_token'	=> $rmbr
				));

				// $registration = Registration::create(array(
				// 						'user_name' 		=> $name,
				// 						'user_email'		=> $email,
				// 						'user_password'		=> $password,
				// 						'first_name'		=> $firstName,
				// 						'last_name'			=> $lastName,
				// 						'job_title'			=> $jobTitle,
				// 						'org_agency'		=> $orgAgency,
				// 						'phone_number'		=> $phoneNumber,
				// 						'specialization'	=> $specialization,
				// 						'remember_token'	=> $rmbr
				// ));

				$avatar = Avatar::create(array(
										'avatar_user_id'	=> $user->id,
										'file_name'			=> 'defaultavatar.svg'
				));

				// $registration->save();
				$user->user_avatar_id = $avatar->id;
				$user->save();

				// Mail::send('emails.auth.welcome', array('user_name' => $user->user_name), function($message) {
				// 	$message->to(Request::input('email'),Request::input('username'))->subject('Welcome to DEMHUB!');
				// });
				//
				// Mail::send('emails.auth.account-details', array(
				// 						'user_name'			=> $name,
				// 						'user_email'		=> $email,
				// 						'first_name'		=> $firstName,
				// 						'last_name'			=> $lastName,
				// 						'job_title'			=> $jobTitle,
				// 						'org_agency'		=> $orgAgency,
				// 						'phone_number'		=> $phoneNumber,
				// 						'specialization'	=> $specialization
				// ), function($message) {
				// 	$message->to('jennifer.holmes@ryerson.ca','Jen Holmes')->subject('New DEMHUB Signup Request!');
				// });

				// $conn = mysqli_connect(getenv('DATABASE_HOST'),getenv('DATABASE_USERNAME'),getenv('DATABASE_PASSWORD'),getenv('DATABASE_NAME'));
				// $query = mysqli_query($conn,"UPDATE users SET user_name='".$rmbr."',user_email='".$rmbr."',remember_token='".$rmbr."' WHERE user_name='".$name."'");
				//
				// if ($query==""){
				// 	echo 'nothing';
				// }
				//
				// $query = mysqli_query($conn,"UPDATE registration SET remember_token='".$rmbr."' WHERE user_name='".$name."'");
				// if ($query==""){
				// 	echo 'nothing';
				// } else{
				// 	mysqli_close($conn);
					return Redirect::route('signUpSuccess');
				// }
			}
		}
	}

	public function login() {
		if (Request::isMethod('get')) {
			return view('guest/login')->with('action', url("login"));
		} else {
			$name = Request::input('username');
			$password = Request::input('password');
			$remember = Request::input('remember');
			$input = array(
				'Username' => $name,
				'Password' => $password,
				'Remember' => $remember
			);

			$validate1 = Validator::make($input, array(
				'Username' 	=> 'required|min:3|max:120',
				'Password'	=> 'required|min:5|max:60'
			));

			if ($validate1->fails()){
				return Redirect::to('login')->withInput(Request::all())
											->withErrors($validate1->messages());
			} else {
				$user_name = User::where('user_name', '=', $name)->first();
				$user_email = User::where('user_email', '=', $name)->first();

				if ($user_name) {
					if (Hash::check($password, $user_name->user_password)) {
						$rmbr = false;
						if(!empty($remember)){
							$rmbr = true;
						}
						$dt = new DateTime();
						$dt = $dt->format('Y-m-d H:i:s');

						Auth::login($user_name, $rmbr);
						return Redirect::route('home')->with('message', 'Hello '.$user_name->user_name.'.');
					} else {
						// redirect to login with errors
						return Redirect::route('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
														->withInput(Request::all());
					}
				} elseif ($user_email) {
					if (Hash::check($password, $user_email->user_password)){
						$rmbr = false;
						if(!empty($remember)){
							$rmbr = true;
						}
						$dt = new DateTime();
						$dt = $dt->format('Y-m-d H:i:s');

						Auth::login($user_email);
						return Redirect::route('')->with('message', 'Hello '.Auth::user()->user_name.'.');
					} else {
						// redirect to login with errors
						return Redirect::route('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
														->withInput(Request::all());

					}
				} else {
					// redirect to login with errors
					return Redirect::to('login')->with('message', 'The Username or Email address provided were incorrect. Please try again!');
				}

			}
		}
	}

	public function loginIntial() {
		if (Request::isMethod('get')) {
			return view('guest/login')->with('action', url("login"));
		} else {
			$name = Request::input('username');
			$password = Request::input('password');
			$remember = Request::input('remember');
			$input = array(
						'Username' 	=> $name,
						'Password' => $password,
						'Remember' => $remember
			);

			$validate1 = Validator::make($input, array(
										'Username' 	=> 'required|min:3|max:120',
										'Password'	=> 'required|min:5|max:60'
			));

			if ($validate1->fails()){
				return Redirect::to('login')->withInput(Request::all())
											->withErrors($validate1->messages());
			} else {
				$user_name = User::where('user_name', '=', $name)->first();
				$user_email = User::where('user_email', '=', $name)->first();

				if ($user_name) {
					if (Hash::check($password, $user_name->user_password)){
						$rmbr = false;
						if(!empty($remember)){
							$rmbr = true;
						}
						$dt = new DateTime();
						$dt = $dt->format('Y-m-d H:i:s');

						Auth::login($user_name, $rmbr);
						return Redirect::route('home')->with('message', 'Hello '.$user_name->user_name.'.');
					} else {
						// redirect to login with errors
						return Redirect::route('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
														->withInput(Request::all());
					}
				} elseif ($user_email) {
					if (Hash::check($password, $user_email->user_password)){
						$rmbr = false;
						if(!empty($remember)){
							$rmbr = true;
						}
						$dt = new DateTime();
						$dt = $dt->format('Y-m-d H:i:s');

						Auth::login($user_email);
						return Redirect::route('home')->with('message', 'Hello '.Auth::user()->user_name.'.');
					} else {
						// redirect to login with errors
						return Redirect::route('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
														->withInput(Request::all());

					}
				}
				else {
					// redirect to login with errors
					return Redirect::to('login')->with('message', 'The Username or Email address provided were incorrect. Please try again!');
				}

			}
		}
	}

	public function loginWithGoogle() {
		// get data from input
		$code = Request::input( 'code' );

		// get google service
		$googleService = OAuth::consumer( 'Google' );

		// check if code is valid

		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {

			// This was a callback request from google, get the token
			$token = $googleService->requestAccessToken( $code );

			// Send a request with it
			$result = json_decode( $googleService->request("https://www.googleapis.com/oauth2/v1/userinfo"), true );

			$message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			echo $message. "<br/>";

			//Var_dump
			//display whole array().
			dd($result);

		}	else { // if not ask for permission first
			// get googleService authorization
			$url = $googleService->getAuthorizationUri();

			// return to google login url
			return Redirect::to( (string)$url );
		}

	}

	public function loginWithTwitter() {
		// Oauth token
		$token = Request::input('oauth_token');

		// Verifier token
		$verifier = Request::input('oauth_verifier');

		if (!empty($token) && !empty($verifier)){
			// Request access token
			$accessToken = Twitter::oAuthAccessToken($token, $verifier);
			print_r($accessToken);
		} else {
			// Reqest tokens
			$tokens = Twitter::oAuthRequestToken();

			// Redirect to twitter
			Twitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
			exit;
		}

	}

	public function loginWithLinkedin() {

		$provider = new Linkedin(Config::get('social.linkedin'));
	  if ( !Input::has('code')) {
	    // If we don't have an authorization code, get one
	    $provider->authorize();
	  } else {
	    try {
	    	// Try to get an access token (using the authorization code grant)
	      $t = $provider->getAccessToken('authorization_code', array('code' => Request::input('code')));
	      try {
	        // We got an access token, let's now get the user's details
	        $userDetails = $provider->getUserDetails($t);
	        $resource = '/v1/people/~:(firstName,lastName,pictureUrl,positions,educations,threeCurrentPositions,threePastPositions,dateOfBirth,location)';
	        $params = array('oauth2_access_token' => $t->accessToken, 'format' => 'json');
	        $url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
	        $context = stream_context_create(array('http' => array('method' => 'GET')));
	        $response = file_get_contents($url, false, $context);
	        $data = json_decode($response);
	        echo '<pre>';
	        print_r($data);
	        echo '/<pre>';
	        //return Redirect::to('/')->with('data',$data);
	      } catch (Exception $e) {
	        echo 'Unable to get user details';
	      }
	    } catch (Exception $e) {
	      echo 'Unable to get access token';
	    }
	  }
  }

	public function logoutUser() {
		if (Auth::check()){
			Auth::logout();
			return Redirect::route('');
		} else {
			return Redirect::route('login');
		}
		return Redirect::route('login');
	}

	public function settingsUser() {
		$categories = Xmlcategories::all();
		//go to users settings page
		if (Request::isMethod('get')) {
			$userid = Auth::user()->id;

			return view('user.settings')
						->with('action', url('user-settings'))
						->with('xmlcategories', $categories);
		} else {
			$id = Auth::user()->id;
			$user = User::where('id', '=', $id)->first();
			$inputs;

			if (Input::hasFile('user_image')){
				$inputs = array(
					'Username' 	=> Request::input('user_name'),
					'Image'		=> Input::file('user_image')
				);
			} else {
				$inputs = array(
					'Username' => Request::input('user_name'),
				);
			}

			$validate = Validator::make($inputs, array(
				'Username' 	=> 'required|min:3|max:120',
				'Image'		=> 'max:2000|mimes:jpeg,JPG,jpg,JPEG,png,PNG'
			));

			if ($validate->fails()){
				return Redirect::route('user-settings')->withErrors($validate->messages());
			} else {
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

				} else {
					Session::flash('error', 'uploaded file is not valid');
				}

				$user->user_name = Request::input('user_name');
				$user->job_title = Request::input('job_title');
				$user->org_agency = Request::input('org_agency');
				$user->specialization = Request::input('specialization');
				$user->save();
				return Redirect::route('home');

			}
		}

	}

}
