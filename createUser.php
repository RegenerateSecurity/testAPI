<?php
include_once '../hmac.php';
include_once './functions.php';

$email = 'testing2@test.com';
$password = 'testy';

$response = postJson('usernameCheck', '1.0', json_encode(array('username' => $email)));
$responseJson = json_decode($response, true);

if ($responseJson === null) {
  die('[F] Fatal; API Error, could not decode JSON' . PHP_EOL);
}
else if ($responseJson['result'] == "taken") {
  die('[!] Error - did not expect test user to be taken' . PHP_EOL);
}
else if ($responseJson['result'] == "available") {
  $response = postJson('createUser', '1.0', json_encode(array('username' => $email,'password' => $password)));
  $responseJson = json_decode($response, true);
  if ($responseJson === null) {
    print '[F] Fatal Error - API returned not the good JSON<br/>';
  }
  else if ($responseJson['result'] == "created") {
    print $response . PHP_EOL;
  }
  else {
  die('[!] Error - API gave us an error response, ' . $responseJson['error'] . PHP_EOL);
  }
}
else if (isset($responseJson['error'])) {
  die('[!] Error - API gave us an error response, ' . $responseJson['error'] . PHP_EOL);
}

?>
