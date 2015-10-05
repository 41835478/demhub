@extends('layouts.master')

@section('content')

<?php

// echo "hello world";

//$db = mysql_select_db('single_edits');
if($_GET){
    if(isset($_GET['createUser'])){
        createUser();
    }
    elseif(isset($_GET['autoLogin'])){
        autoLogin();
    }
}

function createUser(){
	$name=$_GET['username'];
	$email=$_GET['email'];
	//$conn = mysqli_connect('localhost','root','root','demhub_v3');
	$conn = mysqli_connect('localhost','forge','R0SDQrIB8oWjyf5fuUUM','demhubprod');
	$query = mysqli_query($conn,"SELECT * FROM registration WHERE user_name='".$name."' ORDER BY id DESC");
	if ($query==""){
		echo 'nothing';
	}
	else{

		while ($obj=mysqli_fetch_object($query)){
			$name		 	= $obj-> user_name;
			$email 			= $obj-> user_email;
			// $password		= $obj-> user_password;
			$firstName		= $obj-> first_name;
			$lastName		= $obj-> last_name;
			$jobTitle		= $obj-> job_title;
			$orgAgency		= $obj-> org_agency;
			$phoneNumber	= $obj-> phone_number;
			$specialization	= $obj-> specialization;
// 			$updated_at 	= $obj-> updated_at;
// 			$created_at		= $obj-> created_at;
			$rmbr			= $obj-> remember_token;

		}

		// Auth::login($name,$rmbr);

		// Mail::send('emails.auth.welcome', array('user' => $name, 'email' => $email), function($message){
// 			$message->subject('DEMHUB Verification!');
// 		});

		mysqli_free_result($query);
	}
	$query = mysqli_query($conn,"UPDATE users SET user_name='".$name."',user_email='".$email."' WHERE remember_token='".$rmbr."'");
	if ($query==""){
		echo 'nothing';
	}
	else{
		$recentUser = array('user_name'	=> $name,
							'user_email' => $email
							);
		// var_dump($recentUser);
		// Auth::login($name,$rmbr);

		Mail::send('emails.auth.activate-account', array('user_name' => $name), function($message) {
				$message->to($_GET['email'], $_GET['username'])->subject('DEMHUB Account Activiated!');
			});


		mysqli_close($conn);


		echo'
	<div class="row" style="padding-top:100px">
	<div class="col-md-6 col-md-offset-3">
		<p>Success</p>
		<hr>
		</div>
		</div>';
	}
}
function autoLogin(){

			//print_r(Input::all());
			$name=$_GET['username'];
			$conn = mysqli_connect('localhost','root','root','demhub_v3');
			//$conn = mysqli_connect('localhost','forge','BQ88vbX8IJmg9MwnmMkz','demhubprod');
			$query = mysqli_query($conn,"SELECT * FROM registration WHERE user_name='".$name."' ORDER BY id DESC");
			if ($query==""){
				echo 'nothing';
			}
			else{

				while ($obj=mysqli_fetch_object($query)){
					// $name		 	= $obj-> user_name;
					$email 			= $obj-> user_email;
					$password		= $obj-> user_password;
					// $firstName		= $obj-> first_name;
		// 			$lastName		= $obj-> last_name;
		// 			$jobTitle		= $obj-> job_title;
		// 			$orgAgency		= $obj-> org_agency;
		// 			$phoneNumber	= $obj-> phone_number;
		// 			$specialization	= $obj-> specialization;
		// 			$updated_at 	= $obj-> updated_at;
		// 			$created_at		= $obj-> created_at;
					$rmbr			= $obj-> remember_token;

				}
				mysqli_free_result($query);
				mysqli_close($conn);

			}


			$input = array(
						'Username' 	=> $name,
						'Password' => $password,

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




?>
@endsection('content')
