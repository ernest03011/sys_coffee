<?php

use Core\Database;
use Http\controller\session\Manager;
use Http\controller\memberships\MembershipManager;



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

$user_id = Manager::getCurrentUserId();

$membershipManager = new MembershipManager($db);
$result = $membershipManager->createMembership($user_id, $billing_cycle, $start_date, $expiration_date);


if (! $result) {

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
