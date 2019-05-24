<?php
include_once '../hmac.php';
include_once './functions.php';

$email    = 'testing2@test.com';
$password = 'testy';

$response = postJson('authenticateUser', '1.0', json_encode(array('username' => $email,'password' => $password)));
$responseJson = json_decode($response, true);
if ($responseJson === null) {
  print 'API Error<br/>';
  exit();
}

if (isset($responseJson['token'])) {
  print "Token:" . $responseJson['token'] . '
';
$token = $responseJson['token'];
}
else if (isset($responseJson['error'])) {
  print "Handled exception: " . $responseJson['error'] . '
';
  exit();
} else {
  print "Unhandled exception: " . $response . '
';
  exit();
}
?>
