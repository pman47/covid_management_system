<?php 
    session_start();
    $_SESSION['user_role'] = null;
    header("Location: ../../");
?>