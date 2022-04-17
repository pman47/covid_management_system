<?php include('./includes/header.php'); ?>
<?php include('./includes/db.php');?>
<?php include('./includes/navigation.php'); ?>


<?php
    $vc_id = $_GET['vcid'];
    $query = "SELECT * FROM vaccination_centres INNER JOIN pincode ON vaccination_centres.vc_pincode = pincode.pincode INNER JOIN district ON pincode.district_id = district.district_id WHERE vaccination_centres.vc_id = '{$vc_id}'";
    $getDetails = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($getDetails);
    $vc_name = $row['vc_name'];
    $vc_username = $row['vc_username'];
    $vc_address = $row['vc_address'];
    $vc_pincode = $row['vc_pincode'];
    $area_name = $row['area_name'];
    $district_name = $row['district_name'];
    $vc_accepting_status = $row['vc_accepting_status'];

    $vc_cost_type = $row['vc_cost_type'];

    ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>Vaccination Centre Details</h3>
            <?php
                if($vc_accepting_status!="accepted"){
            ?>
            <div class="">
                <a onClick="javascript: return confirm('Are You Sure?');" href="vcRequests.php?update=<?php echo $vc_id; ?>" class="btn btn-outline-primary rounded-pill px-4 mx-3">Accept</a>
                <a onClick="javascript: return confirm('Are You Sure?');" href="vcRequests.php?reject=<?php echo $vc_id; ?>" class="btn btn-outline-danger rounded-pill px-4">Reject</a>
            </div>
            <?php } ?>
        </div>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <div class="col">
                    <h3 class='card-title text-success'><?php echo $vc_name; ?><small class='text-muted h5'>- <?php echo $vc_username; ?></small></h3>
                    <h5 class="card-text">Address : <?php echo $vc_address; ?></h5>
                    
                    <h5 class="card-text">Pincode:
                        <b><?php echo $vc_pincode; ?></b>
                        <?php echo "- ".$area_name.", ".$district_name;?>
                    </h5>
                    
                    <h5 class="card-text">Cost Type : <?php echo $vc_cost_type; ?></h5>
                    
                    <h5 class="card-text">Age Group :</h5>
                    <?php
                        $query = "SELECT * FROM vc_age_group INNER JOIN age_group ON vc_age_group.age_group_id=age_group.age_group_id WHERE `vc_id` = '{$vc_id}'";
                        $ageGroups = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($ageGroups)){
                            $age_from = $row['age_from'];
                            $age_to = $row['age_to'];
                        ?>

                        <span class="badge rounded-pill bg-secondary fs-6"><?php echo $age_from . "-" . $age_to; ?></span>

                    <?php } ?>
                    



                </div>
            </div>
        </div>
    </div>