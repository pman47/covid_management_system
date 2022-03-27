
<?php
    $vc_id = $global_vc_id;
    $query = "SELECT * FROM vaccination_centres WHERE vc_id = $vc_id";
    $get_vc_details = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($get_vc_details)){
        $vc_username = $row['vc_username'];
        $vc_name = $row['vc_name'];
        $vc_address = $row['vc_address'];
        $vc_cost_type = $row['vc_cost_type'];
        $vc_pincode = $row['vc_pincode'];
        $vc_status = $row['vc_status'];
    }
?>

<div class="container">
    <div class="card mt-5 px-5 py-3 shadow">
        <div class="card-body row">
            <div class="col-8">
                <?php
                    if($vc_status=='close'){
                        echo "<h3 class='card-title text-danger'>$vc_name <small class='text-muted h5'>- $vc_username </small></h3>";
                    }else{
                        echo "<h3 class='card-title text-success'>$vc_name <small class='text-muted h5'>- $vc_username </small></h3>";
                    }
                ?>
                <h5 class="card-text mb-2 mt-4"><?php echo $vc_address; ?></h5>
                
                <h6 class="card-text">Pincode:
                    <b><?php echo $vc_pincode; ?></b>
                    <?php
                        $query = "SELECT pincode.area_name,district.district_name FROM pincode INNER JOIN district ON pincode.district_id=district.district_id WHERE pincode.pincode = $vc_pincode";
                        $pincode_details = mysqli_query($connection,$query);
                        $row = mysqli_fetch_assoc($pincode_details);
                        echo "- ".$row['area_name'].", ".$row['district_name'];
                    ?>
                </h6>

            </div>
            <div class="col">
                <h6 class="card-text mb-1">Status</h6>
                <?php
                    if($vc_status=='close'){
                        echo "<a href='#' class='btn btn-danger rounded-pill px-4 mt-0 mb-4 disabled'>Closed</a>";
                    }else{
                        echo "<a href='#' class='btn btn-success rounded-pill px-4 mt-0 mb-4 disabled'>Open</a>";
                    }
                ?>
                
                <h5 class="card-text">Cost Type : <span class="badge rounded-pill bg-secondary"><?php echo $vc_cost_type; ?></span> </h5>
                <a href="./edit_vc_detail.php" class="card-link text-secondary">Edit Profile</a>
            </div>
        </div>
    </div>
</div>