<?php

use Core\Database;
use Core\JwtHandler;

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo "</pre>";

    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    return base_path('views/' . $path);
}

function abort($code = 404)
{
    http_response_code($code);

    require view("{$code}.php");

    die();
}

function getCurrentUserId()
{

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

function redirect($url, $attributes = [])
{
    // Use parse_url to get the components of the URL
    $parsedUrl = parse_url($url);

    // If the URL has a query string
    if (isset($parsedUrl['query'])) {
        // Parse the existing query string into an array
        parse_str($parsedUrl['query'], $queryParams);

        // Extract the message and modifiers from the attributes
        extract($attributes);

        // Add or update the message and modifiers in the query string
        if (isset($message)) {
            $queryParams['message'] = $message;
        }

        if (isset($modifiers)) {
            $queryParams['modifiers'] = $modifiers;
        }

        // Rebuild the query string
        $newQueryString = http_build_query($queryParams);

        // Reconstruct the URL with the updated query string
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $url .= "://" . $_SERVER['HTTP_HOST'] . $parsedUrl['path'] . '?' . $newQueryString;
    } else {
        // If the URL does not have a query string, extract attributes
        extract($attributes);

        // Build the query string if attributes are present
        $queryString = '';
        if (isset($message)) {
            $queryString .= 'message=' . $message;
        }

        if (isset($modifiers)) {
            $queryString .= ($queryString ? '&' : '') . 'modifiers=' . $modifiers;
        }

        // Reconstruct the URL with the new query string
        $url = $url . ($queryString ? '?' . $queryString : '');
    }

    header('Location: ' . $url);
    exit();
}

function executeApiCall($apiUrl, $requestData, $additionalConfig = array())
{
    $ch = curl_init();

    $defaultConfig = array(
        CURLOPT_URL => $apiUrl,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $requestData,
        CURLOPT_SSL_VERIFYPEER => false,
    );

    $curlConfig = $defaultConfig + $additionalConfig; // Merge default and additional configurations

    curl_setopt_array($ch, $curlConfig);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return false; // Return false if there is a curl error
    }

    curl_close($ch);

    return $response;
}

// IS LOGGED IN FUNCTION

function isUserLoggedIn()
{
    return isset($_SESSION['user']['email']);
}

function getPrevUrl()
{
    return $_SERVER["HTTP_REFERER"];
}
