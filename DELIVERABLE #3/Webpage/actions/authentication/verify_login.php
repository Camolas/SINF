<?php
    if(!$_SESSION['user_id']) {
        $_SESSION['error_messages'][] = 'Access forbidden. Undefined user.';
        header('Location: ' . $BASE_URL . 'pages/login.php');
        exit;
    }
?>
