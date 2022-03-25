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
        case 'add_vc':
            include('./includes/add_vc.php');
            break;

        case 'edit_vc':
            $vc_id= $_GET['vc_id'];
            include "./includes/edit_vc.php";
            break;

        default:
            include('./includes/view_all_vc.php');
            break;
    }

?>