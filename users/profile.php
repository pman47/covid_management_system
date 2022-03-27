<?php include('./includes/header.php')?>
<?php include('./includes/navigation.php')?>
<?php include('./includes/db.php') ?>


<?php
    $user_id = $global_user_id;
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $get_user_details = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($get_user_details)){
        $user_name = $row['user_name'];
        $user_aadhar_no = $row['user_aadhar_no'];
        $mobile_no = $row['mobile_no'];
        $user_email = $row['user_email'];
        $user_dob = $row['user_dob'];
        $user_gender = $row['user_gender'];
        $user_blood_group = $row['user_blood_group'];
    }
?>

<div class="container">
    <div class="card mt-5 px-5 py-3 shadow">
        <div class="card-body row">
            <div class="col">
                <?php
                    echo "<h3 class='card-title text-success'>$user_name</h3>";
                ?>
                <h5 class="card-text mb-2 mt-2">Aadhar No : <?php echo $user_aadhar_no; ?></h5>
                <h5 class="card-text mb-2 mt-2">Mobile No : <?php echo $mobile_no; ?></h5>
                <h5 class="card-text mt-2">Email : <?php echo $user_email; ?></h5>
            </div>
            <div class="col">
                <a href="edit_profile.php" class="link-secondary">Edit Profile</a>
                <h5 class="card-text mb-2 mt-2">DOB : <?php echo $user_dob; ?></h5>
                <h5 class="card-text mb-2 mt-2">Gender : <?php echo $user_gender; ?></h5>
                <h5 class="card-text mt-2">Blood Group : <?php echo $user_blood_group; ?></h5>
            </div>
        </div>
    </div>
</div>

<?php include("./includes/vaccination_details.php"); ?>
<?php include("./includes/bed_requests.php"); ?>

<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h3>Lab Testing Requests:</h3>
    </div>

    <!-- Testing table -->
    <div class="card px-5 fs-5 py-3 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Laboratory Name</th>
                <th scope="col">Testing Details</th>
                <th scope="col">Total Price</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $query = "SELECT * FROM testing_requests INNER JOIN testing_list ON testing_list.testing_id = testing_requests.testing_id INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_requests.lab_id = $global_lab_id";
                    $query = "SELECT * FROM testing_requests INNER JOIN laboratories ON laboratories.lab_id = testing_requests.lab_id WHERE user_id = $global_user_id";
                    $getTestingRequests = mysqli_query($connection,$query);
                    if(mysqli_num_rows($getTestingRequests)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Requests Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row=mysqli_fetch_array($getTestingRequests)){
                            $date = $row['testing_date'];
                            $testing_status = $row['testing_status'];
                            $lab_name = $row['lab_name'];
                            $testing_id = $row['testing_id'];
                            
                            if($testing_status=='accepted'){
                                echo "<tr class='table-success'>";
                            }else if($testing_status=='rejected'){
                                echo "<tr class='table-danger'>";
                            }else{
                                echo "<tr>";
                            }

                            echo "
                                <th scope='row'>$index</th>
                                <td>$date</td>
                                <td>$lab_name</td>
                                <td>
                            ";

                            $query = "SELECT * FROM testing_list INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_id = '{$testing_id}'";
                            $total_price = 0;
                            $getPrices = mysqli_query($connection,$query);
                            echo "<table class='table'>
                            <thead>
                                <tr>
                                <th scope='col'>Name</th>
                                <th scope='col'>Price</th>
                                </tr>
                            </thead>
                            <tbody>";
                            while($row = mysqli_fetch_array($getPrices)){ ?>
                                <tr>
                                    <th scope='row'><?php echo $row['testing_name'];?></th>
                                    <td><?php echo $row['testing_price'];?></td>
                                </tr>

                            <?php $total_price = $total_price + $row['testing_price'];}
                            echo "</tbody></table></td>
                                <td>$total_price</td>
                                <td>$testing_status</td>";
                            $index++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>