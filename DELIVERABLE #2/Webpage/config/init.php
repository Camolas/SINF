<?php
    session_set_cookie_params(3600, '/SINF/DELIVERABLE%20%232/Webpage/');
    session_start();

    error_reporting(E_ERROR | E_WARNING); // E_NOTICE by default

	$BASE_DIR = 'C:\\xampp\\htdocs\\SINF\\DELIVERABLE #2\\Webpage\\';

    $conn = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', 'postgres');
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec('SET SCHEMA \'public\'');
	
	$PRIMAVERA_ADDRESS = 'http://localhost:49822/';

    $LOG_FILE = $BASE_DIR . "logfile.txt";
    $MESSAGE_TYPE = 3;
	
	$success_messages = $_SESSION['success_messages'];
    $error_messages = $_SESSION['error_messages'];
    $field_errors = $_SESSION['field_errors'];
    $form_values = $_SESSION['form_values'];

    $_SESSION['success_messages'] = [];
    $_SESSION['error_messages'] = [];
    $_SESSION['field_errors'] = [];
    $_SESSION['form_values'] = [];
	
	// To remove
	$_SESSION['user_id'] = "1";
    $_SESSION['username'] = "sinf@fe.up.pt";
?>
