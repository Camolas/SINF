<?php
include('../config/init.php');
include('../actions/authentication/verify_login.php');

// load clients
$curl2 = curl_init();
curl_setopt($curl2, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/clientes/');
curl_setopt($curl2, CURLOPT_RETURNTRANSFER, TRUE);
$resp2 = curl_exec($curl2);
curl_close($curl2);
$clients = json_decode($resp2, true);

//Load oppotunities
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/opportunities/?representative_id=' . $_SESSION['user_id']);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$oports = json_decode(curl_exec($curl), true);
curl_close($curl);


include('../templates/common/header.php');
include('../templates/agenda/create_event.php');
include('../templates/common/footer.php');
?>
