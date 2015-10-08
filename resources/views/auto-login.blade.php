@extends('layouts.master')

@section('content')

<?php

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
  $rmbr = null;
	$conn = mysqli_connect(getenv('DATABASE_HOST'),getenv('DATABASE_USERNAME'),getenv('DATABASE_PASSWORD'),getenv('DATABASE_NAME'));
	$query = mysqli_query($conn,"SELECT * FROM registration WHERE user_name='".$name."' ORDER BY id DESC");
	if ($query==""){
		echo 'nothing';
	}
	else{

		while ($obj=mysqli_fetch_object($query)){
			$name		 	= $obj-> user_name;
			$email 		= $obj-> user_email;
			$rmbr			= $obj-> remember_token;

		}

		mysqli_free_result($query);
	}



	$query = mysqli_query($conn,"UPDATE users SET user_name='".$name."',user_email='".$email."' WHERE remember_token='".$rmbr."'");
  var_dump($query);
  if ($query==""){
		echo 'nothing';
	}
	else{
		$recentUser = array('user_name'	=> $name,
							'user_email' => $email
							);
		// var_dump($recentUser);
		// Auth::login($name,$rmbr);




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
  $email=$_GET['email'];
	$name=$_GET['username'];
  $password = null;
  $rmbr=null;
	$conn = mysqli_connect(getenv('DATABASE_HOST'),getenv('DATABASE_USERNAME'),getenv('DATABASE_PASSWORD'),getenv('DATABASE_NAME'));
	$query = mysqli_query($conn,"SELECT * FROM registration WHERE user_name='".$name."' ORDER BY id DESC");

  if ($query==""){
		echo 'nothing';
	} else{

    while ($obj=mysqli_fetch_object($query)){
      $email 			= $obj-> user_email;
      $password		= $obj-> user_password;
      $rmbr			= $obj-> remember_token;
    }

    mysqli_free_result($query);
    mysqli_close($conn);

  }



    $user_email = $email;
    $user_name = $name;

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
      }
      else {
        // redirect to login with errors
        return Redirect::route('login')->with('message', 'The Username or E-Mail address provided was incorrect. Please try again!')
                        ->withInput(Request::all());
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
                        ->withInput(Request::all());

      }
    }
    else {
      // redirect to login with errors
      return Redirect::to('login')->with('message', 'The Username or Email address provided were incorrect. Please try again!');
    }





}

?>


@endsection('content')
