<?php
// set post fields
$post = [
    'username' => 'Ali_Mansour2004',
    'password' => 'P@ssw0rd_2020',
];

$ch = curl_init('http://localhost/postman_practice/pages/login_action.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true); // Ensure POST method is set
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    var_dump($response);
}

// close the connection, release resources used
curl_close($ch);

