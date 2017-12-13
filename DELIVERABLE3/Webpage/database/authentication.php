<?php
    function generate_password_hash($password) {
        return hash('sha256', $password);
    }

    function get_user_data($email) {
	    global $conn;
	    $stmt = $conn->prepare("SELECT * FROM users WHERE users.email LIKE ?");
	    $stmt->execute(array("$email"));
	    $data = $stmt->fetch();
	    return $data;
    }
?>
