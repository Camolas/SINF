<?php
include_once('../config/init.php');
session_set_cookie_params(3600, $BASE_URL);
session_start();

session_unset();
session_destroy();

unset($_SESSION['user_id']);
unset($_SESSION['username']);
pr($_SESSION);

header('Location: ' . $BASE_URL);
?>
