<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
    $patient_id = $_GET['patient_id'];
    $query = "SELECT * FROM bed_requests INNER JOIN users ON users.user_id = bed_requests.user_id INNER JOIN ward_details ON ward_details.ward_id = bed_requests.ward_id WHERE patient_id = $patient_id";
    $getDetails = mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($getDetails)){
        $user_name = $row['user_name'];
        $user_aadhar_no = $row['user_aadhar_no'];
        $mobile_no = $row['mobile_no'];
        $user_email = $row['user_email'];
        $user_dob = $row['user_dob'];
        $user_gender = $row['user_gender'];
        $user_blood_group = $row['user_blood_group'];
        $patient_status=$row['patient_status'];
        $ward_id=$row['ward_id'];
        $ward_name=$row['ward_name'];
        $Total_beds=$row['Total_beds'];
        $Available_beds=$row['Available_beds'];
    }
?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>User Details</h3>
            <?php
                if($patient_status=="pending"){
            ?>
            <div class="">
                <a onClick="javascript: return confirm('Are You Sure?');" href="bedRequests.php?accept=<?php echo $patient_id;?>" class="btn btn-outline-primary rounded-pill px-4 mx-3">Accept</a>
                <a onClick="javascript: return confirm('Are You Sure?');" href="bedRequests.php?reject=<?php echo $patient_id;?>" class="btn btn-outline-danger rounded-pill px-4">Reject</a>
            </div>
            <?php } ?>
        </div>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h3 class='card-title text-success'><?php echo $user_name;?></h3>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <h5 class="card-text">Aadhar No : <?php echo $user_aadhar_no; ?></h5>
                        </div>
                        <div class="col">
                            <h5 class="card-text">Mobile No : +91 <?php echo $mobile_no; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <h5 class="card-text">Email : <?php echo $user_email; ?></h5>
                        </div>
                        <div class="col">
                            <h5 class="card-text">Date of Birth : <?php echo $user_dob; ?></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h5 class="card-text">Gender : <?php echo $user_gender; ?></h5>
                        </div>
                        <div class="col">
                            <h5 class="card-text">Blood Group : <?php echo $user_blood_group; ?></h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h3>Requested For</h3>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ward Name</th>
                            <th scope="col">Total Beds</th>
                            <th scope="col">Available Beds</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <th scope="row">#</th>
                            <td><?php echo $ward_name;?></td>
                            <td><?php echo $Total_beds;?></td>
                            <td><?php echo $Available_beds;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>