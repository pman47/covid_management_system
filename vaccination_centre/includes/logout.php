<?php 
    session_start();
    $_SESSION['user_role'] = null;
    $_SESSION['lab_id'] = null;
    $global_lab_id = null;
    header("Location: ../../");
?>