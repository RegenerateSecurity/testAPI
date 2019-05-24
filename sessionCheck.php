<?php
include_once 'authenticateUser.php';
$response = postJson('sessionCheck', '1.0', json_encode(array('token' => $token)));
$responseJson = json_decode($response, true);
if ($responseJson === null) {
  print '[F] Fatal Error - API returned the bad daytas';
}
else if (isset($responseJson['error'])) {
  print '[!] Error: ' . $responseJson['error'] . PHP_EOL;
}
else if (isset($responseJson['result'])) {
  print '[+] Result: ' . $responseJson['result'] . PHP_EOL;
}
else {
  print '[F] Fatal Error - This should never happen. Got good JSON, but did not expect it';
}

?>
