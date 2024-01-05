<?php

use Core\Database;
use Core\Validator;
use Core\JwtHandler;


$email = $_POST['email'];
$password = $_POST['password'];

// Sanatize and validate inputs

$errors = [];

if(!Validator::string($password, 8, 255)){
  $errors['password'] = 'The password is required';
}
if(!Validator::email($email)){
  $errors['email'] = 'The email is required';
}

if(! empty($errors)){
  return view('session/create.view.php', [
    'errors' => $errors
  ]);
}

$config = require base_path('config.php');

$db = new Database($config['database']);

$user = $db->query('select * from users where email = :email', [
  'email' => $email
])->find();

$is_valid_password = password_verify($password, $user['password']);

if($user && $is_valid_password){
 
    session_regenerate_id(true);

    $jwt = new JwtHandler();

    //Payload can be anything you want to store in the token
    $payload = $user['user_id'];

    $jwtToken = $jwt->encode("http://localhost:8080/", $payload);

    $_SESSION['user'] = [ 
      'email' => $email,
      'jwt_token' => (string) $jwtToken
    ];

    redirect("/");

}else{
  $errors['login'] = "No matching account found for that email address and password.";
  require view('session/create.view.php', [
    'errors' => $errors
  ]);
  
}