<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<!-- Page Content -->


<?php 
    if(isset($_GET['source'])){
        $source = $_GET['source'];
    }else{
        $source = '';
    }

    switch($source){
        case 'add_hospital':
            include('./includes/add_hospital.php');
            break;

        case 'edit_hospital':
            $hospital_id= $_GET['hospital_id'];
            include "./includes/edit_hospital.php";
            break;

        default:
            include('./includes/view_all_hospital.php');
            break;
    }

?>