<?php
	include('../config/init.php');
	include('../actions/authentication/verify_login.php');
	
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here

	if($_GET['id']) {
		curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/target_customers/?representative_id=' . $_SESSION['user_id'] . '&target_customer_id=' . $_GET['id']);
	} else {
		curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/target_customers/?representative_id=' . $_SESSION['user_id']);
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	$arr = json_decode($resp);
	
	$table_headers = ["Name", "Date/Hour", "Location", "Cell Number"];
	
	include('../templates/common/header.php');
	include('../templates/target_customers/target_customers.php');
	include('../templates/common/footer.php');
?>
