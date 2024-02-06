<?php

namespace Http\controller\session;
use Core\JwtHandler;
use Core\Database;


class Manager
{

  public static function getCurrentUserId(){
    
    $has_token = isset($_SESSION['user']['jwt_token']) ? true : false;
    $data = '';
    $jwt = new JwtHandler();

    $config = require base_path('config.php');
    $db = new Database($config['database']);

    if ($has_token) {
        $token = $_SESSION['user']['jwt_token'];
        $data = $jwt->decode($token);
    }

    if (! $data == '') {

        $user = $db->query('select * from users where email = :email', [
            'email' => $_SESSION['user']['email'],
        ])->find();

        //Payload can be anything you want to store in the token
        $payload = $user['user_id'];

        $jwtToken = $jwt->encode("http://localhost:8080/", $payload);

        $_SESSION['user']['jwt_token'] = (string) $jwtToken;

        $data = $payload;
    }

    return $data;
  }

  // Metodo para saber si es admin o no, y puede ser estatico
  public static function isCurrentUserAnAdmin(){

    $user_id = self::getCurrentUserId() ?? false;
    
    if($user_id != false){
      try {
        $config = require base_path('config.php');
        $db = new Database($config['database']);   
        
        $test = $db->query('select * from admin_users WHERE user_id = :user_id', [
          'user_id' => $user_id
        ])->find();

        $result = empty($test) ? false : true; 

        return $result;
      } catch (\Exception $e) {
        return false;
      }
    }else{
      return false;
    }

  }

  public static function logout(){
    $_SESSION = [];

    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

    redirect("/");
  }

  public static function isUserLoggedIn() 
  {
    return isset($_SESSION['user']['email']);
  }
  
}
