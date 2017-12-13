<?php
$BASE_DIR = 'C:\\xampp\\htdocs\\SINF\\DELIVERABLE #3\\Webpage\\'; //NAO USADO!!
$BASE_URL = 'http://localhost/Sinf/DELIVERABLE%20%233/Webpage/';

session_set_cookie_params(3600, $BASE_DIR);
session_start();

error_reporting(E_ERROR | E_WARNING); // E_NOTICE by default

//Uncoment when the DB is ready!!
$conn = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', '1234567890');
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn->exec('SET SCHEMA \'public\'');

$PRIMAVERA_ADDRESS = 'http://localhost:49822/';

$LOG_FILE = $BASE_DIR . "logfile.txt";
$MESSAGE_TYPE = 3;

$success_messages = $_SESSION['success_messages'] ? $_SESSION['success_messages']  : [];
$error_messages = $_SESSION['error_messages'] ? $_SESSION['error_messages'] : [];
$field_errors = $_SESSION['field_errors'] ? $_SESSION['field_errors'] : [];
$form_values = $_SESSION['form_values'] ? $_SESSION['field_errors'] : [];

unset($_SESSION['success_messages']);
unset($_SESSION['error_messages']);
unset($_SESSION['field_errors']);
unset($_SESSION['form_values']);

// To work whithot Log in
/*$_SESSION['user_id'] = "1";
$_SESSION['username'] = "sinf@fe.up.pt";
*/
//FUNCTIOIN TO DEBUG
function pr($data)
{
  echo "<pre>";
  print_r($data); // or var_dump($data);
  echo "</pre>";
}
?>
