<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
    $testing_id = $_GET['testing_id'];
    $query = "SELECT * FROM testing_requests INNER JOIN users ON users.user_id = testing_requests.user_id WHERE testing_id = $testing_id";
    $getDetails = mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($getDetails)){
        $user_name = $row['user_name'];
        $user_aadhar_no = $row['user_aadhar_no'];
        $mobile_no = $row['mobile_no'];
        $user_email = $row['user_email'];
        $user_dob = $row['user_dob'];
        $user_gender = $row['user_gender'];
        $user_blood_group = $row['user_blood_group'];
        $testing_status=$row['testing_status'];
    }
?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>User Details</h3>
            <?php
                if($testing_status=="pending"){
            ?>
            <div class="">
                <a onClick="javascript: return confirm('Are You Sure?');" href="testingRequests.php?accept=<?php echo $testing_id;?>" class="btn btn-outline-primary rounded-pill px-4 mx-3">Accept</a>
                <a onClick="javascript: return confirm('Are You Sure?');" href="testingRequests.php?reject=<?php echo $testing_id;?>" class="btn btn-outline-danger rounded-pill px-4">Reject</a>
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
        <h3>Testing Details</h3>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Testing Name</th>
                            <th scope="col">Testing Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM testing_list INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_id = '{$testing_id}'";
                        $allTestings = mysqli_query($connection,$query);
                        $index = 1;
                        $total = 0;
                        while($row = mysqli_fetch_assoc($allTestings)){
                            $testing_name = $row['testing_name'];
                            $testing_price = $row['testing_price'];
                            $total += $testing_price;
                            ?>
                            
                            <tr>
                                <th scope="row"><?php echo $index;?></th>
                                <td><?php echo $testing_name;?></td>
                                <td><?php echo $testing_price;?></td>
                            </tr>
                        <?php
                        $index++;
                        } ?>
                        <tr>
                            <th scope="row">-</th>
                            <th scope="row">TOTAL PRICE</th>
                            <th scope="row"><?php echo $total;?>/-</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>