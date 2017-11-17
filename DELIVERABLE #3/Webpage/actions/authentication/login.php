<?php
    include_once('../../config/init.php');
    include_once('../../database/authentication.php');

    if(!$_POST['email'])
	    $_SESSION['field_errors'][] = "Email field cannot be empty.";
    if(!$_POST['password'])
	    $_SESSION['field_errors'][] = "Password field cannot be empty.";
    if(!$_POST['email'] || !$_POST['password']) {
        $_SESSION['form_values'] = $_POST;
        header('Location: ' . $BASE_URL);
        exit;
    }

    $email = strip_tags(trim($_POST['email']));
    $password = $_POST['password'];

    try{
        $user_data = get_user_data($email);
    }
    catch(PDOException $e){
        error_log($e->getMessage(), $MESSAGE_TYPE, $LOG_FILE);
        $_SESSION['error_messages'][] = 'Error getting user data.';
    }

    if($user_data != false) {
        $password_hash = generate_password_hash($password);
        $user_id = $user_data['user_id'];
        if($user_data['password'] == $password_hash) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $email;
            $_SESSION['success_messages'][] = 'Login successful.';
        }
        else {
            $_SESSION['form_values'] = $_POST;
            $_SESSION['error_messages'][] = 'Invalid password.';
        }
    }
    else {
        $_SESSION['form_values'] = $_POST;
        $_SESSION['error_messages'][] = 'Invalid email.';
    }

    header('Location: ' . $BASE_URL);
?>
