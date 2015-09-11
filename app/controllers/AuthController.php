<?php

class AuthController extends BaseController {

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
			return View::make('guest/sign-up')->with('action', URL::route("sign-up"));
		}
		else {
			//print_r(Input::all());
			$name = Input::get('username');
			$email = Input::get('email');
			$password = Input::get('password');
			$remember = Input::get('remember');
			$input = array(
						'Username' 	=> $name,
						'Email' 	=> $email,
						'Password' => $password,
						'Remember' => $remember
						);
			
			
			$validate = Validator::make($input,
										array(
										'Username' 	=> 'unique:users,user_name|required|min:3|max:120',
										'Email' 	=> 'unique:users,user_email|required|email',
										'Password'	=> 'required|min:5|max:60'
										));
			if ($validate->fails()){
				return Redirect::route('sign-up')->withInput(Input::all())
											->withErrors($validate->messages());
			}
			else {
				$rmbr = false;
				if(!empty($remember)){
					$rmbr = true;
				}
				
				$user = User::create(array(
										'user_name' 		=> $name,
										'user_email'		=> $email,
										'user_password'		=> Hash::make($password),
										'updated_at' 		=> app('currentDT'),
										'created_at'		=> app('currentDT'),
										'remember_token'	=> $rmbr
										));
				$avatar = Avatar::create(array(
										'avatar_user_id'	=> $user->id,
										'file_name'			=> 'defaultavatar.svg',
										'updated_at'		=> app('currentDT'),
										'created_at'		=> app('currentDT')
										));

				$user->user_avatar_id = $avatar->id;
				$user->save();	
				
				Auth::login($user);
				
				$user = Auth::user()->user_name;
				$email = Auth::user()->user_email;
				Mail::send('emails.auth.welcome', array('user' => $user, 'email' => $email), function($message){
					$message->to(Auth::user()->user_email, Auth::user()->user_name)->subject('Welcome to DEMHUB!');
				});

				return Redirect::route('home');
										
										
			}
											
		}
	}
	
	public function login() {
		if (Request::isMethod('get')) {
			return View::make('guest/login')->with('action', URL::route("login"));
		}
		else {
			//print_r(Input::all());
			$name = Input::get('username');
			$password = Input::get('password');
			$remember = Input::get('remember');
			$input = array(
						'Username' 	=> $name,
						'Password' => $password,
						'Remember' => $remember
						);
			
			
			$validate1 = Validator::make($input,
										array(
										'Username' 	=> 'required|min:3|max:120',
										'Password'	=> 'required|min:5|max:60'
										));
			if ($validate1->fails()){
				return Redirect::to('login')->withInput(Input::all())
											->withErrors($validate1->messages());
			}
			else {
				$user_name = User::where('user_name', '=', $name)->first();
				$user_email = User::where('user_email', '=', $name)->first();
				
				if ($user_name) {
					//print_r($password);
					if (Hash::check($password, $user_name->user_password)){
						$rmbr = false;
						if(!empty($remember)){
							$rmbr = true;
						}
						$dt = new DateTime();
						$dt = $dt->format('Y-m-d H:i:s');
										
						Auth::login($user_name, $rmbr);
						return Redirect::route('home')->with('message', 'Hello '.$user_name->user_name.'.');
					}
					else {
						// redirect to login with errors
						return Redirect::route('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
														->withInput(Input::all());
					}
				}
				elseif ($user_email) {
					if (Hash::check($password, $user_email->user_password)){
						$rmbr = false;
						if(!empty($remember)){
							$rmbr = true;
						}
						$dt = new DateTime();
						$dt = $dt->format('Y-m-d H:i:s');
										
						Auth::login($user_email);
						return Redirect::route('home')->with('message', 'Hello '.Auth::user()->user_name.'.');
					}
					else {
						// redirect to login with errors
						return Redirect::route('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
														->withInput(Input::all());
						
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
		$code = Input::get( 'code' );
	
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
	
		}
		// if not ask for permission first
		else {
			// get googleService authorization
			$url = $googleService->getAuthorizationUri();
			//print_r($url);
			// return to google login url
			return Redirect::to( (string)$url );
		}
	    
	}

	
	public function loginWithTwitter() {
		// Oauth token
		$token = Input::get('oauth_token');
	
		// Verifier token
		$verifier = Input::get('oauth_verifier');
		
		if (!empty($token) && !empty($verifier)){
			// Request access token
			$accessToken = Twitter::oAuthAccessToken($token, $verifier);
			print_r($accessToken);
		}
		else {
			// Reqest tokens
			$tokens = Twitter::oAuthRequestToken();
		
			// Redirect to twitter
			Twitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
			exit;
			
		}
		
	}

	 public function loginWithLinkedin() {
	 	// $linkedin = array(
	 	// 				'client_id'     => '785y5med7h97c5',
			//             'redirect_uri'   =>  'http://localhost/demhub_v3/public/linkedin',
			//             'scope'         => 'r_basicprofile&r_emailaddress&r_contactinfo&r_fullprofile&r_network&rw_groups',
			//             'client_secret' => 'v911EVQopiSlQBCz',
	 	// 			);
	 	// $url = 'https://www.linkedin.com/uas/oauth2/authorization?
	 	// 			response_type=code&
	 	// 			client_id=785y5med7h97c5&
	 	// 			redirect_uri=http://localhost/demhub_v3/public&
	 	// 			state=190231278N&
	 	// 			scope=r_basicprofile&r_emailaddress&r_fullprofile&r_network&rw_groups';
	 	
	 	// $url = preg_replace('/\s+/', '', $url);
	 	
	 	// $code = Input::get('code');
	 	// $state = Input::get('state');
	 	// if (!$code){
	 	// 	return Redirect::to($url);
	 	// }
	 	// else {
	 	// 	if ($state === '190231278N'){
	 	// 		if ($code){

	 	// 		}
	 	// 	}
	 	// 	else {
	 	// 		return Redirect::route('login');
	 	// 	}
	 	// }
	 	$provider = new Linkedin(Config::get('social.linkedin'));
	    if ( !Input::has('code')) {
	        // If we don't have an authorization code, get one
	        $provider->authorize();
	    } 
	    else {
	        try {
	            // Try to get an access token (using the authorization code grant)
	            $t = $provider->getAccessToken('authorization_code', array('code' => Input::get('code')));
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
	            } 
	            catch (Exception $e) {
	                echo 'Unable to get user details';
	            }

	        } 
	        catch (Exception $e) {
	            echo 'Unable to get access token';
	        }
	    }
    }
	
	public function logoutUser() {
		if (Auth::check()){
			Auth::logout();
			return Redirect::route('home');	
		}
		else {
			return Redirect::route('login');
		}
	}
	
	public function settingsUser() {
		//go to users settings page
		if (Request::isMethod('get')) {
			$userid = Auth::user()->id;

			return View::make('user.settings')
						->with('action', URL::route('user-settings'));
		}
		else {
			$id = Auth::user()->id;
			$user = User::where('id', '=', $id)->first();
			$inputs;

			if (Input::hasFile('user_image')){
				    //
				    $inputs = array(
							'Username' 	=> Input::get('username'),
							'Image'		=> Input::file('user_image')
							);
					//print_r(Input::all());
			}
			else {
				$inputs = array(
							'Username' => Input::get('username'),
							);
			}
			//unique:users,user_name|
			$validate = Validator::make($inputs,
										array(
										'Username' 	=> 'required|min:3|max:120',
										'Image'		=> 'max:2000|mimes:jpeg,JPG,jpg,JPEG,png,PNG'
										));
			if ($validate->fails()){
				return Redirect::route('user-settings')->withErrors($validate->messages());  	
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
				$user->user_name = Input::get('username');
				$user->save();
				return Redirect::route('home');
				
			}
		}
	
	}
	
}
