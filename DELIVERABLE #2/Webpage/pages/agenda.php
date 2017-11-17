<?php
	include('../config/init.php');
	//include('../actions/authentication/verify_login.php');
	
	include('../templates/common/header.php');
	include('../templates/agenda/agenda.php');
	include('../templates/common/footer.php');
	
?>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="<?=$BASE_URL?>bower_components/bootstrap-calendar/js/calendar.js"></script>
	<script type="text/javascript" src="<?=$BASE_URL?>bower_components/bootstrap-calendar/js/app.js"></script>