
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
    <div class="card mt-5 px-5 py-3">
        <div class="card-body row">
            <div class="col-7">
                <?php
                    if($lab_status=='close'){
                        echo "<h3 class='card-title text-danger'>$lab_name</h3>";
                    }else{
                        echo "<h3 class='card-title text-success'>$lab_name</h3>";
                    }
                ?>
                <h5 class="card-subtitle mb-2 text-muted">username : <?php echo $lab_username; ?></h5>
                <h5 class="card-text mb-2"><?php echo $lab_address; ?></h5>
                
                <a href="#" class="card-link">Edit Profile</a>

            </div>
            <div class="col-3">
                <h6 class="card-text mb-1">Status</h6>
                <?php
                    if($lab_status=='close'){
                        echo "<a href='#' class='btn btn-danger rounded-pill px-4 mt-0 mb-4 disabled'>Closed</a>";
                    }else{
                        echo "<a href='#' class='btn btn-success rounded-pill px-4 mt-0 mb-4 disabled'>Open</a>";
                    }
                ?>
                
                <h5 class="card-text">+91 <?php echo $lab_contact_no; ?></h5>
                <h6 class="card-text">Pincode: <b><?php echo $lab_pincode; ?></b></h6>
            </div>
        </div>
    </div>

</div>