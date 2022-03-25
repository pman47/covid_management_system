<!-- HEADER -->
<?php include('./includes/header.php'); ?>
<!-- HEADER -->

<?php include('./includes/db.php');?>

<!-- NAVIGATION -->
<?php include('./includes/navigation.php'); ?>
<!-- NAVIGATION -->

<div class="container">
<?php
    $query = "SELECT * FROM laboratories WHERE lab_accepting_status	 = 'accepted'";
    $getAllDetails = mysqli_query($connection,$query);
    if(mysqli_num_rows($getAllDetails)==0){
        ?>
        <div class="card mt-4 shadow d-flex align-items-center justify-content-md-center" style="min-height:200px;">
            <h4>No Laboratory Requests Found</h4>
        </div>
        <?php
    }else{
        while($row = mysqli_fetch_assoc($getAllDetails)){
            $lab_name = $row['lab_name'];
            $lab_id = $row['lab_id'];
            $lab_username = $row['lab_username'];
            $lab_address = $row['lab_address'];
            $contact_no = $row['contact_no'];
            $lab_pincode = $row['lab_pincode'];
            ?>

            <div class="card mt-2 px-3 py-1 shadow">
                    <div class="card-body row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo "<a href='viewLabRequest.php?labid=$lab_id' class='link-secondary fs-3 aTagHead'>$lab_name</a>"; ?>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="card-text">+91 <?php echo $contact_no; ?></h6>
                                </div>
                            </div>
                            <h5 class="card-text"><?php echo $lab_address; ?></h5>
                            
                            <h6 class="card-text">Pincode:
                                <b><?php echo $lab_pincode; ?></b>
                            </h6>

                        </div>
                    </div>
                </div>

            <?php
        }
    }
?>
</div>