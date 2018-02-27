<?php
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';

use Twilio\Rest\Client;

echo "Sending SMS! <br>";
// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC3a6b5fbd4c4e9412aab1581ac6574726';
$auth_token = 'cf1d8223c9fbc59d10b9daac6c795976';

// A Twilio number you own with SMS capabilities
$twilio_number = "+16042656953 ";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+16478222594',
    array(
        'from' => $twilio_number,
        'body' => 'Your next bus is delayed,kindly wait for 5-10 minutes near the stop.Apologies for the delay

        -lambton College'
    )
);

echo "Message has been sent <br>";

?>