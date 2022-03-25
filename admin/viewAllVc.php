<!-- HEADER -->
<?php include('./includes/header.php'); ?>
<!-- HEADER -->

<?php include('./includes/db.php');?>

<!-- NAVIGATION -->
<?php include('./includes/navigation.php'); ?>
<!-- NAVIGATION -->

<div class="container">
<?php
    $query = "SELECT * FROM vaccination_centres WHERE vc_accepting_status = 'accepted'";
    $getAllDetails = mysqli_query($connection,$query);
    if(mysqli_num_rows($getAllDetails)==0){
        ?>
        <div class="card mt-4 shadow d-flex align-items-center justify-content-md-center" style="min-height:200px;">
            <h4>No Vaccination Centre Found</h4>
        </div>
        <?php
    }else{
        while($row = mysqli_fetch_assoc($getAllDetails)){
            $vc_name = $row['vc_name'];
            $vc_id = $row['vc_id'];
            $vc_username = $row['vc_username'];
            $vc_address = $row['vc_address'];
            $vc_pincode = $row['vc_pincode'];
            ?>

            <div class="card mt-2 px-3 py-1 shadow">
                    <div class="card-body row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo "<a href='viewVcRequest.php?vcid=$vc_id' class='link-secondary fs-3 aTagHead'>$vc_name</a>"; ?>
                                </div>
                            </div>
                            <h5 class="card-text"><?php echo $vc_address; ?></h5>
                            
                            <h6 class="card-text">Pincode:
                                <b><?php echo $vc_pincode; ?></b>
                            </h6>

                        </div>
                    </div>
                </div>

            <?php
        }
    }
?>
</div>