<?php

namespace DEMHub\Http\Controllers\Auth;

use DEMHub\Models\User;
use Validator;
use Hash;
use DateTime;
use Auth;
use Redirect;
use DEMHub\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function login() {
  		if (Request::isMethod('get')) {
  			return view('guest/login')->with('action', url("login"));
  		}
  		else {
  			//print_r(Input::all());
  			$name = Request::input('username');
  			$password = Request::input('password');
  			$remember = Request::input('remember');
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
  						return Redirect::url('home')->with('message', 'Hello '.$user_name->user_name.'.');
  					}
  					else {
  						// redirect to login with errors
  						return Redirect::url('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
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
  						return Redirect::url('home')->with('message', 'Hello '.Auth::user()->user_name.'.');
  					}
  					else {
  						// redirect to login with errors
  						return Redirect::url('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
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


        $validate = Validator::make($input,
										array(
										'Username' 	=> 'unique:users,user_name|required|min:3|max:120',
										'Email' 	=> 'unique:users,user_email|required|email',
										'Password'	=> 'required|min:5|max:60'
										));

        if ($validate->fails()){
				  return Redirect::url('sign-up')->withInput(Input::all())
											->withErrors($validate->messages());
			  } else {
				  $rmbr = Request::input('_token');
				  $user = User::create(array(
            'user_name' 		=> $name,
            'user_email'		=> $email,
            'user_password'	=> Hash::make($password),
            'first_name'		=> $firstName,
            'last_name'			=> $lastName,
            'job_title'			=> $jobTitle,
            'org_agency'		=> $orgAgency,
            'phone_number'	=> $phoneNumber,
            'specialization'=> $specialization,
            'updated_at' 		=> app('currentDT'),
            'created_at'		=> app('currentDT'),
            'remember_token'	=> $rmbr
          ));

				  $registration = Registration::create(array(
										'user_name' 		=> $name,
										'user_email'		=> $email,
										'user_password'		=> $password,
										'first_name'		=> $firstName,
										'last_name'			=> $lastName,
										'job_title'			=> $jobTitle,
										'org_agency'		=> $orgAgency,
										'phone_number'		=> $phoneNumber,
										'specialization'	=> $specialization,
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

          $registration->save();
				  $user->user_avatar_id = $avatar->id;
				  $user->save();

			    Mail::send('emails.auth.welcome', array('user_name' => $user->user_name), function($message) {
					  $message->to(Request::input('email'),Request::input('username'))->subject('Welcome to DEMHUB!');
				  });

			    Mail::send('emails.auth.account-details', array(
										'user_name'			=> $name,
										'user_email'		=> $email,
										'first_name'		=> $firstName,
										'last_name'			=> $lastName,
										'job_title'			=> $jobTitle,
										'org_agency'		=> $orgAgency,
										'phone_number'		=> $phoneNumber,
										'specialization'	=> $specialization), function($message) {
					                 $message->to('jennifer.holmes@ryerson.ca','Jen Holmes')->subject('New DEMHUB Signup Request!');
				            }
          );

          $conn = mysqli_connect(getenv('DB_HOST'),getenv('DB_USERNAME'),getenv('DB_PASSWORD'),getenv('DB_NAME'));

          $query = mysqli_query($conn,"UPDATE users SET user_name='".$rmbr."',user_email='".$rmbr."',remember_token='".$rmbr."' WHERE user_name='".$name."'");
          if ($query==""){
      		  echo 'nothing';
      	  }

          $query = mysqli_query($conn,"UPDATE registration SET remember_token='".$rmbr."' WHERE user_name='".$name."'");
      	  if ($query==""){
      		  echo 'nothing';
      	  } else{
            mysqli_close($conn);
  				  return Redirect::url('signUpSuccess');
			    }

        }
      }
    }
}
