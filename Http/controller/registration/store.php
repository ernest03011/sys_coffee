<?php

use Core\Database;
use Core\Validator;

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if(!Validator::string($username)){
  $errors['username'] = 'The username is required';
}
if(!Validator::string($password, 8, 255)){
  $errors['password'] = 'The password is required';
}
if(!Validator::email($email)){
  $errors['email'] = 'The email is required';
}

if(! empty($errors)){
  return view('registration/create.view.php', [
    'errors' => $errors
  ]);
}

$config = require base_path('config.php');

$db = new Database($config['database']);

$user = $db->query('select * from users where email = :email', [
  'email' => $email
])->find();

if($user){

  header('location: /');
  exit();

} else{

  $user = $db->query('Insert into users(username, email, password) VALUES (:username, :email, :password)', [
    'username' => $username,
    'email' => $email, 
    'password' => password_hash($password, PASSWORD_DEFAULT)
  ]);
  
  $_SESSION['user'] = [
    'email' => $email
  ];

  session_regenerate_id(true);

  redirect("/");

}









