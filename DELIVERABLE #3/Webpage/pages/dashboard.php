<?php
	include('../config/init.php');
	include('../actions/authentication/verify_login.php');
	
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/dashboard/?representative_id=' . $_SESSION['user_id']);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	$arr = json_decode($resp, true)[0];
	$table_headersAgenda = ['Start Date', 'End Date', 'Title', 'Type', 'Client', 'Location'];
	
	include('../templates/common/header.php');
	include('../templates/dashboard/dashboard.php');
	include('../templates/common/footer.php');
?>
