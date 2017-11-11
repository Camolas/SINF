<?php
	include('../config/init.php');
	//include('../actions/authentication/verify_login.php');
	
	/*$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/agenda/');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	$resp = curl_exec($curl);
	curl_close($curl);
	
	$obj = json_decode($resp);

	$table_headers = ["Hour","Title","Type","Location","Notes"];
	$entries = [];
	foreach ($obj as $activity) {
		$entry = [$activity->hour, $activity->title, $activity->type, $activity->location, $activity->notes];
		array_push($entries, $entry);
	}*/

	include('../templates/common/header.php');
	include('../templates/agenda.php');
	include('../templates/common/footer.php');
?>
