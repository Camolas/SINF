<?php
	include('../config/init.php');
	include('../actions/authentication/verify_login.php');
	
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/opportunities/?representative_id=1');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	// Send the request & save response to $resp
	$resp = json_decode(curl_exec($curl), true);
	// Close request to clear up some resources
	curl_close($curl);
	
	include('../templates/common/header.php');
	include('../templates/opportunities/opportunities.php');
	include('../templates/common/footer.php');
	
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?=$BASE_URL?>js/opportunities.js"></script>