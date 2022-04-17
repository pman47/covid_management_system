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
<?php include("./includes/testing_requests.php"); ?>