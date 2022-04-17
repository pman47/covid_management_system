
<?php
    $lab_id = $global_lab_id;
    $query = "SELECT * FROM laboratories WHERE lab_id = $lab_id";
    $get_lab_details = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($get_lab_details)){
        $lab_username = $row['lab_username'];
        $lab_name = $row['lab_name'];
        $lab_address = $row['lab_address'];
        $lab_contact_no = $row['contact_no'];
        $lab_pincode = $row['lab_pincode'];
        $lab_status = $row['lab_status'];
    }
?>

<div class="container">
    <div class="card mt-5 px-5 py-3 shadow">
        <div class="card-body row">
            <div class="col-8">
                <?php
                    if($lab_status=='close'){
                        echo "<h3 class='card-title text-danger'>$lab_name <small class='text-muted h5'>- $lab_username </small></h3>";
                    }else{
                        echo "<h3 class='card-title text-success'>$lab_name <small class='text-muted h5'>- $lab_username </small></h3>";
                    }
                ?>
                <!-- <h5 class="card-subtitle mb-2 text-muted">username : <?php echo $lab_username; ?></h5> -->
                <h5 class="card-text mb-2 mt-4"><?php echo $lab_address; ?></h5>
                
                <h6 class="card-text">Pincode:
                    <b><?php echo $lab_pincode; ?></b>
                    <?php
                        $query = "SELECT pincode.area_name,district.district_name FROM pincode INNER JOIN district ON pincode.district_id=district.district_id WHERE pincode.pincode = $lab_pincode";
                        $pincode_details = mysqli_query($connection,$query);
                        $row = mysqli_fetch_assoc($pincode_details);
                        echo "- ".$row['area_name'].", ".$row['district_name'];
                    ?>
                </h6>

            </div>
            <div class="col">
                <h6 class="card-text mb-1">Status</h6>
                <?php
                    if($lab_status=='close'){
                        echo "<a href='#' class='btn btn-danger rounded-pill px-4 mt-0 mb-4 disabled'>Closed</a>";
                    }else{
                        echo "<a href='#' class='btn btn-success rounded-pill px-4 mt-0 mb-4 disabled'>Open</a>";
                    }
                ?>
                
                <h5 class="card-text">+91 <?php echo $lab_contact_no; ?></h5>
                <a href="./edit_laboratory_detail.php" class="card-link text-secondary">Edit Profile</a>
            </div>
        </div>
    </div>
</div>