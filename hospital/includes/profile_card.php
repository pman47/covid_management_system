
<?php
    $hospital_id = $global_hospital_id;
    $query = "SELECT * FROM hospitals WHERE hospital_id = $hospital_id";
    $get_hospital_details = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($get_hospital_details)){
        $hospital_username = $row['hospital_username'];
        $hospital_name = $row['hospital_name'];
        $hospital_address = $row['hospital_address'];
        $hospital_contact_no = $row['contact_no'];
        $hospital_pincode = $row['hospital_pincode'];
        $hospital_status = $row['hospital_status'];
    }
?>

<div class="container">
    <div class="card mt-5 px-5 py-3 shadow">
        <div class="card-body row">
            <div class="col-8">
                <?php
                    if($hospital_status=='close'){
                        echo "<h3 class='card-title text-danger'>$hospital_name <small class='text-muted h5'>- $hospital_username </small></h3>";
                    }else{
                        echo "<h3 class='card-title text-success'>$hospital_name <small class='text-muted h5'>- $hospital_username </small></h3>";
                    }
                ?>

                <h5 class="card-text mb-2 mt-4"><?php echo $hospital_address; ?></h5>
                
                <h6 class="card-text">Pincode:
                    <b><?php echo $hospital_pincode; ?></b>
                    <?php
                        $query = "SELECT pincode.area_name,district.district_name FROM pincode INNER JOIN district ON pincode.district_id=district.district_id WHERE pincode.pincode = $hospital_pincode";
                        $pincode_details = mysqli_query($connection,$query);
                        $row = mysqli_fetch_assoc($pincode_details);
                        echo "- ".$row['area_name'].", ".$row['district_name'];
                    ?>
                </h6>

            </div>
            <div class="col">
                <h6 class="card-text mb-1">Status</h6>
                <?php
                    if($hospital_status=='close'){
                        echo "<a href='#' class='btn btn-danger rounded-pill px-4 mt-0 mb-4 disabled'>Closed</a>";
                    }else{
                        echo "<a href='#' class='btn btn-success rounded-pill px-4 mt-0 mb-4 disabled'>Open</a>";
                    }
                ?>
                
                <h5 class="card-text">+91 <?php echo $hospital_contact_no; ?></h5>
                <a href="./edit_hospital_detail.php" class="card-link text-secondary">Edit Profile</a>
            </div>
        </div>
    </div>

</div>