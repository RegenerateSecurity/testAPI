<?php
// A function to execute a prepared query against an array of vars
function execPrepare($mysqli, $query, $param) {
  $stmt = $mysqli->prepare($query);
  call_user_func_array(array($stmt, 'bind_param'), $param);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result;
}

// A function to execute a prepared query and return the number of rows
function numPrepare($mysqli, $query, $param) {
  $stmt = $mysqli->prepare($query);
  call_user_func_array(array($stmt, 'bind_param'), $param);
  $stmt->execute();
  $stmt->store_result();
  $result = $stmt->get_result();
  return $stmt->num_rows;
}

function clean($input) {
  $input = htmlspecialchars($input);    // Abstracted to make custom filtration possible later
  return $input;
}

function postJson($endpoint, $version, $payload) {
    global $apiHMAC;
    $signature = hash_hmac('sha3-512' , $payload , $apiHMAC);

    // Setup cURL
    $ch = curl_init('https://api.regeneratesecurity.com/api/'.$version.'/'.$endpoint.'/');
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Signature: '.$signature,
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => $payload
    ));

    // Send the request
    $response = curl_exec($ch);

    if($response === FALSE){ // Check for errors
        die(curl_error($ch));
    }

    return $response;
}
?>
