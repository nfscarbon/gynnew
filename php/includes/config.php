<?php
session_start();

// if (isset($_SESSION['email'])) 
// {
//   	$_SESSION['msg'] = "You must log in first";
//   	header('location: user/index.php');
// }

//var_dump($_SESSION);

if (isset($_GET['logout'])) 
{
	session_destroy();
	unset($_SESSION['logged_user']);
	header("location: ../login.php");
}


// initializing variables
$username 	= "";
$email    	= "";
$errors 	= []; 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project_gym');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $MemberName     			= mysqli_real_escape_string($db, $_POST['MemberName']);
  $MemberEmailId        	= mysqli_real_escape_string($db, $_POST['MemberEmailId']);
  $MembePhone        		= mysqli_real_escape_string($db, $_POST['MembePhone']);
  $MemberPassword   		= mysqli_real_escape_string($db, $_POST['MemberPassword']);
  $confirm_MemberPassword   = mysqli_real_escape_string($db, $_POST['confirm_MemberPassword']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($MemberName)) { array_push($errors, "Name is required"); }
  if (empty($MembePhone)) { array_push($errors, "Email is required"); }
  if (empty($MembePhone)) { array_push($errors, "Phone is required"); }
  if (empty($MemberPassword)) { array_push($errors, "Password is required"); }

  if ($MemberPassword != $confirm_MemberPassword) {
    array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM members WHERE MemberEmailId='$MemberEmailId' OR MembePhone='$MembePhone' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['MembePhone'] === $MembePhone) {
      array_push($errors, "Phone already exists");
    }

    if ($user['MemberEmailId'] === $MemberEmailId) {
      array_push($errors, "email already exists");
    }
  }


  if (count($errors) == 0) 
  {
    $password = sha1($MemberPassword);

    $query = "INSERT INTO members (MemberName, MemberEmailId, MembePhone, MemberPassword) 
              VALUES('$MemberName', '$MemberEmailId', '$MembePhone', '$password')";

              //exit();
    mysqli_query($db, $query);

    $_SESSION['success'] = "You are successfully registred. Login now.";
    header('location: login.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) 
{
  $email 	= mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) 
  {
  	array_push($errors, "Email is required");
  }

  if (empty($password)) 
  {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) 
  {
  	$password 	= sha1($password);
  	$query 		= "SELECT * FROM members WHERE MemberEmailId = '".$email."' AND MemberPassword = '".$password."' AND MemberActiveStatus = 1";

  	$results 	= mysqli_query($db, $query);

  	if (mysqli_num_rows($results) == 1) 
  	{
  	  	$_SESSION['logged_user'] = mysqli_fetch_assoc($results);

		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
  	}
  	else 
  	{
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}