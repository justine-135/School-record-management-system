<?php
// If empty, redirect to login page
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
    header("Location: ./login.php");
}
else{
    // If inactive for 15 mins, logout user
    if ((time() - $_SESSION['last_login_timestamp']) > 900) {
        session_destroy();
    }
    else{
        $_SESSION['last_login_timestamp'] = time();
    }
}