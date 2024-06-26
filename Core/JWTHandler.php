<?php

namespace Core;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler
{
    protected $secrect;
    protected $issuedAt;
    protected $expire;

    function __construct()
    {
        // set your default time-zone
        date_default_timezone_set('Asia/Kolkata');
        $this->issuedAt = time();

        // Token Validity (3600 second = 1hr)
        $this->expire = $this->issuedAt + 86400;

        // Set your strong secret or signature
        $this->secrect = "HCwXE1Iii9X6Yt2pBivZy134CxwvypRCEnJA6EsmEH9Xmwgb5X6VCRW0fbrSj85xZ7t0iXZbq0Gkd1dRW7j1IUri2yTxIxKXk4Ap";
        // $this->secrect = base64_encode(random_bytes(32));
    }

    public function encode($iss, $data)
    {

        $token = array(
            //Adding the identifier to the token (who issue the token)
            "iss" => $iss,
            "aud" => $iss,
            // Adding the current timestamp to the token, for identifying that when the token was issued.
            "iat" => $this->issuedAt,
            // Token expiration
            "exp" => $this->expire,
            // Payload
            "data" => $data
        );

        return JWT::encode($token, $this->secrect, 'HS256');
    }

    public function decode($token)
    {
        try {
            $decode = JWT::decode($token, new Key($this->secrect, 'HS256'));
            return $decode->data;
        } catch ( Exception $exception) {

            $_SESSION = [];

            session_destroy();

            $params = session_get_cookie_params();
            setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            
            abort(Response::UNATHURIZED);
        }
    }
}