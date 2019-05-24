<?php
include_once 'authenticateUser.php';

$response = postJson('logoutSession', '1.0', json_encode(array('token' => $token)));
$responseJson = json_decode($response, true);
if ($responseJson === null or isset($responseJson['error'])) {
  print 'API Error' . PHP_EOL; // Handle me Daddy
}
else if (isset($responseJson['result'])) { // TODO: consider successful and invalid-logout separately
  print '[+] Result: ' . $responseJson['result']  . PHP_EOL;
}
else {
  print '[F] Fatal: ' . $response . PHP_EOL;
}
?>
