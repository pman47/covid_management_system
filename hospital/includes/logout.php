<?php 
    session_start();
    $_SESSION['user_role'] = null;
    $_SESSION['hospital_id'] = null;
    $global_hospital_id = null;
    header("Location: ../../");
?>