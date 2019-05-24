<?php
include_once '../hmac.php';
include_once './functions.php';

$email    = 'testing2@test.com';
$password = 'testy';

$response = postJson('authenticateUser', '1.0', json_encode(array('username' => $email,'password' => $password)));
$responseJson = json_decode($response, true);
if ($responseJson === null) {
  die('[F] Fatal error - API returned falafel instead of JSON' . PHP_EOL);
}
else if (isset($responseJson['error'])) {
  die('[!] Error: ' . $responseJson['error'] . PHP_EOL);
}
else if (isset($responseJson['token'])) {
  print '[+] Token: ' . $responseJson['token'] . PHP_EOL;
}
else {
  die('[F] Fatal - received JSON but did not expect it' . PHP_EOL);
}
?>
