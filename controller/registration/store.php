<?php

require base_path('Validator.php');

// Retrieve user input (e.g., username and password) from the registration form.

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate and sanitize input:

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

// Query the database to check if a user with the entered username already exists.

if (!class_exists('Database')) {
  // If not, require it
  require base_path('Database.php');
}
$config = require base_path('config.php');

$db = new Database($config['database']);

$user = $db->query('select * from users where email = :email', [
  'email' => $email
])->find();

#### If yes, redirect to a login page:
// If the username already exists, redirect the user to a login page with a relevant message.

#### If not, save to the database and log the user in:
// If the username doesn't exist, hash the password for security.
// Save the user's information (username, hashed password) to the database.
// Set up a session to log the user in.
// Redirect the user to a dashboard or home page.


if($user){

  header('location: /');
  exit();

} else{

 // Add salt & pepper to the password.

 // ??? MISSING //

  $user = $db->query('Insert into users(username, email, password) VALUES (:username, :email, :password)', [
    'username' => $username,
    'email' => $email, 
    'password' => password_hash($password, PASSWORD_DEFAULT)
  ]);
  
  $_SESSION['user'] = [
    'email' => $email
  ];

  session_regenerate_id(true);

  header('location: /');
  exit();

}









