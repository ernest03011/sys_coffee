<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$conPassword = htmlspecialchars($_POST['conPassword']);

$errors = [];

if(!Validator::string($username))
{
  $errors['username'] = 'The username is required';
}
if(!Validator::string($password, 8, 255))
{
  $errors['password'] = 'Both password and confirm password are required. Make sure to use strong password. Try again!';
}
if(!Validator::string($conPassword, 8, 255))
{
  $errors['password'] = 'Both password and confirm password are required. Make sure to use strong password. Try again!';
}
if(!Validator::email($email))
{
  $errors['email'] = 'The email is required';
}

if($password != $conPassword){
  $errors['password'] = 'Password does not match';
}


if(! empty($errors)){
  require view('registration/create.view.php', [
    'errors' => $errors
  ]);
  exit();
}

try {
  $user = $db->query('select * from users where email = :email OR username = :username', [
    'email' => $email,
    'username' => $username
  ])->find();

} catch (\Exception $th) {
  $errors['registration'] = 'Registration failed. Please try again.';
  require view('registration/create.view.php', [
    'errors' => $errors
  ]);

  exit();
}


if($user){

  $errors['registration'] = 'Registration failed. Please try again.';
  require view('registration/create.view.php', [
    'errors' => $errors
  ]);

  exit();

} else{

  try {

    $db->query('Insert into users(username, email, password) VALUES (:username, :email, :password)', [
      'username' => $username,
      'email' => $email, 
      'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);
    
    $_SESSION['user'] = [
      'email' => $email
    ];
  
    session_regenerate_id(true);
  
    redirect("/");

  } catch (\Exception $e) {

    $errors['registration'] = 'Registration failed. Please try again.';
    require view('registration/create.view.php', [
      'errors' => $errors
    ]);
  
    exit();
  }


}









