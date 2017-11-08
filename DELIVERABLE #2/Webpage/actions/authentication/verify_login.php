<?php
    if(!$_SESSION['user_id']) {
        $_SESSION['error_messages'][] = 'Access forbidden. Undefined user.';
        header('Location: ../pages/login.php');
        exit;
    }
?>
