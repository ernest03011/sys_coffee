<?php 
  
  if(!class_exists('JwtHandler')){
    // If not, require it
    require base_path("JWTHandler.php");
  }

  if (!class_exists('Database')) {
    // If not, require it
    require base_path('Database.php');
  }


  function dd($value){
    echo '<pre>';
    var_dump($value);
    echo "</pre>";

    die();
  }

  function base_path($path){
    return BASE_PATH . $path;
  }

  function view($path,  $attributes = []){
    extract($attributes);
    return base_path('views/' . $path);
  }

  function abort($code = 404){
    http_response_code($code);

    require view("{$code}.php");

    die();
  }

  function getCurrentUserId(){
  
    $token =  $_SESSION['user']['jwt_token'];  
    $jwt = new JwtHandler();

    $config = require base_path('config.php');
    $db = new Database($config['database']);

    $data =  $jwt->decode($token);

    if(! $data){
    
      $user = $db->query('select * from users where email = :email', [
        'email' => $_SESSION['user']['email']
      ])->find();
      
      //Payload can be anything you want to store in the token
      $payload = $user['user_id'];

      $jwtToken = $jwt->encode("http://localhost:8080/", $payload);

      $_SESSION['user']['jwt_token'] = (string) $jwtToken;
        
      $data =  $jwt->decode((string) $jwtToken);
    }
    
    return $data;
  }
