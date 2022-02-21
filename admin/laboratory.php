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
        case 'add_lab':
            include('./includes/add_lab.php');
            break;

        case 'edit_lab':
            $lab_id= $_GET['lab_id'];
            include "./includes/edit_lab.php";
            break;

        default:
            include('./includes/view_all_lab.php');
            break;
    }

?>