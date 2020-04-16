<?php

require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_Ju8zBcbFhBHJEem3qONDocS100Mej5mXud');

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

echo $token;

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "email" => $email,
  "source" => $token
));

$charge = \Stripe\Charge::create(array(
  "amount" => 5000,
  "currency" => "usd",
  "description" => "Intro To React Course",
  "customer" => $customer->id
));

// Redirect to success
header('Location: success.php?tid=' . $charge->id . '&product=' . $charge->description);

