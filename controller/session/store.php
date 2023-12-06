<?php

require base_path('Validator.php');

// Get the variables from the /login form

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

// If there is any errors, return the /login view and show the error. 

if(! empty($errors)){
  return view('session/create.view.php', [
    'errors' => $errors
  ]);
}

// Retrieve the users from the database

require base_path('Database.php');
$config = require base_path('config.php');

$db = new Database($config['database']);

$user = $db->query('select * from users where email = :email', [
  'email' => $email
])->find();

// If the form submitted matched a user with a valid email address and password, log in and create a user SESSION like you did in the register page. 

// OR

// if not, reload the view and show an error like wrong password and username

// Create an if statement with variables that if a user does not exist or if the password does not match to a user, then you can not log in.
  
$is_valid_password = password_verify($password, $user['password']);

if($user && $is_valid_password){
 
    $_SESSION['user'] = [
      'email' => $email
    ];
  
    session_regenerate_id(true);
  
    header('location: /');
    exit();

}else{
  $errors['login'] = "No matching account found for that email address and password.";
  require view('session/create.view.php', [
    'errors' => $errors
  ]);
  
}