<?php
	include('../config/init.php');
	include('../actions/authentication/verify_login.php');

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/dashboard/?representative_id=' . $_SESSION['user_id']);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	$resp = curl_exec($curl);
	curl_close($curl);
	$arr = json_decode($resp, true);
	pr( $arr);
	$table_headersAgenda = ['Start Date', 'End Date', 'Title', 'Type', 'Client', 'Location'];

	include('../templates/common/header.php');
	include('../templates/dashboard/dashboard.php');
	include('../templates/common/footer.php');
?>
