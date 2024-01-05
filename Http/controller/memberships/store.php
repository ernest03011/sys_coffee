<?php

use Core\Database;

// if (!class_exists('Database')) {
//     // If not, require it
//     require base_path('Database.php');
// }

$config = require base_path('config.php');
$db = new Database($config['database']);

$start_date = new DateTime('now', new DateTimeZone('America/Santo_Domingo'));

$billing_cycle = htmlspecialchars($_POST['billing_cycle']);
$billing_options = [
    '1' => "+1 month",
    '12' => "+1 year",
    "24" => "+2 year",
    "48" => "+4 year"
];

$expiration_date = clone $start_date;
$expiration_date->modify($billing_options[$billing_cycle]);

// JWT
$user_id = getCurrentUserId();
$result = false;

try {

    $db->query('Insert into memberships(user_id, subscription_duration, start_date, expiration_date) VALUES (:user_id, :subscription_duration, :start_date, :expiration_date)', [
        'user_id' => $user_id,
        'subscription_duration' => $billing_cycle,
        'start_date' => $start_date->format('Y-m-d'),
        'expiration_date' => $expiration_date->format('Y-m-d'),
    ]);

    $result = true;

} catch (Exception $e) {

    $result = false;
}

if (!$result) {

    $url = getPrevUrl();
    $errorMsg = 'Unable to create the subscription, double-check the details and try again';

    redirect($url, [
        'message' => urlencode($errorMsg),
    ]);
}

$data = [
    'active' => 1,
    'subscription_duration' => $billing_cycle,
    'start_date' => $start_date->format('Y-m-d'),
    'expiration_date' => $expiration_date->format('Y-m-d'),
];

require view('memberships/show.view.php',
    [
        'data' => $data,
    ]
);
