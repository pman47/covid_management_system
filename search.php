<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php');?>


<?php
if(isset($_GET["for"])){
    if($_GET["for"]=="testing"){ 
        include('./includes/searchForTesting.php');
    }else if($_GET["for"]=="hospital"){ 
        include('./includes/searchForHospital.php');
    }
} ?>