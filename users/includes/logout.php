<?php 
    session_start();
    $_SESSION['user_role'] = null;
    $_SESSION['user_id'] = null;
    $_SESSION['user_name'] = null;
    header("Location: ../../");
?>