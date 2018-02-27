<<?php
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';

use Twilio\Rest\Client;

echo "Sending SMS! <br>";
// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC9b0cde7ca249ad2b38e40227d0207295';
$auth_token = '6221a5ed04940e2e9322e195784526d1';

// A Twilio number you own with SMS capabilities
$twilio_number = "+14153230423 ";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+16478818867',
    array(
        'from' => $twilio_number,
        'body' => 'I sent this message in under 10 minutes!'
    )
);

echo "Done sending SMS! <br>";

?>