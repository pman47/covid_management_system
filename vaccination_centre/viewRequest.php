<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
    $vaccination_id = $_GET['vaccination_id'];
    $query = "SELECT * FROM vaccination_requests INNER JOIN users ON users.user_id = vaccination_requests.user_id WHERE vaccination_id = $vaccination_id";
    $getDetails = mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($getDetails)){
        $user_name = $row['user_name'];
        $user_aadhar_no = $row['user_aadhar_no'];
        $mobile_no = $row['mobile_no'];
        $user_email = $row['user_email'];
        $user_dob = $row['user_dob'];
        $user_gender = $row['user_gender'];
        $user_blood_group = $row['user_blood_group'];
        $vaccination_status=$row['vaccination_status'];
    }
?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>User Details</h3>
            <?php
                if($vaccination_status=="pending"){
            ?>
            <div class="">
                <a onClick="javascript: return confirm('Are You Sure?');" href="vaccination_Requests.php?accept=<?php echo $vaccination_id;?>" class="btn btn-outline-primary rounded-pill px-4 mx-3">Accept</a>
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
        <h3>Vaccination Details</h3>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vaccination Date</th>
                            <th scope="col">Dose no</th>
                            <th scope="col">Vaccine Name</th>
                            <th scope="col">Time Slot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $query = "SELECT * FROM vaccination_list INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_id = '{$testing_id}'";
                        $query = "SELECT * FROM vaccination_requests INNER JOIN users ON users.user_id = vaccination_requests.user_id INNER JOIN vaccine_type ON vaccine_type.vaccine_id = vaccination_requests.vaccine_type INNER JOIN time_slot ON time_slot.time_slot_id = vaccination_requests.time_slot WHERE vaccination_id = '{$vaccination_id}'";
                        $allTestings = mysqli_query($connection,$query);
                        $index = 1;
                        $total = 0;
                        while($row = mysqli_fetch_assoc($allTestings)){
                            $date = $row['vaccination_date'];
                            $user_name = $row['user_name'];
                            $dose_no = $row['dose_no'];
                            $vaccine_name = $row['vaccine_name'];
                            $time_from = $row['time_from'];
                            $time_to = $row['time_to'];
                            $vaccination_status = $row['vaccination_status'];
                            $vaccination_id  = $row['vaccination_id'];
                            ?>
                            
                            <tr>
                                <th scope="row"><?php echo $index;?></th>
                                <td><?php echo $date;?></td>
                                <td><?php echo $dose_no;?></td>
                                <td><?php echo $vaccine_name;?></td>
                                <td><?php echo $time_from . " - " . $time_to;?></td>
                            </tr>
                        <?php
                        $index++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>