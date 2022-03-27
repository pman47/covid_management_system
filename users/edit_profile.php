<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    $user_id = $global_user_id;
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $get_user_details = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($get_user_details)){
        $user_name = $row['user_name'];
        $user_password = $row['password'];
        $user_aadhar_no = $row['user_aadhar_no'];
        $mobile_no = $row['mobile_no'];
        $user_email = $row['user_email'];
        $user_dob = $row['user_dob'];
        $user_gender = $row['user_gender'];
        $user_blood_group = $row['user_blood_group'];
    }
?>

<section class="h-100 bg-light">
<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow" style="border-radius: 1rem;">
          <div class="card-body p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <h1>Edit Profile</h1>

                    <label class="form-label fs-5" for="name">Name</label>
                    <input class="form-control fs-5 mb-3" type="text" name="name" id="name" value="<?php if(isset($user_name)) echo $user_name;?>" required>

                    <label class="form-label fs-5" for="mobileNo">Mobile No</label>
                    <input class="form-control fs-5 mb-3" type="tel" name="mobileNo" id="mobileNo" value="<?php if(isset($mobile_no)) echo $mobile_no;?>"pattern="[1-9]{1}[0-9]{9}" disabled>

                    <label class="form-label fs-5" for="mobileNo">Aadhar No</label>
                    <input class="form-control fs-5 mb-3" type="tel" name="mobileNo" id="mobileNo" value="<?php if(isset($user_aadhar_no)) echo $user_aadhar_no;?>"pattern="[1-9]{1}[0-9]{9}" disabled>
                    
                    <label class="form-label fs-5" for="email">Email</label>
                    <input class="form-control fs-5 mb-3" type="email" name="email" value="<?php if(isset($user_email)) echo $user_email;?>" id="email" required>

                    <label class="form-label fs-5" for="password">Password</label>
                    <input class="form-control fs-5 mb-3" type="password" name="password" id="password" value="<?php if(isset($user_password)) echo $user_password;?>" required>

                    <label class="form-label fs-5" for="dob">Date of Birth</label>
                    <input class="form-control fs-5 mb-3" type="date" name="dob" value="<?php if(isset($user_dob)) echo $user_dob;?>" id="dob" max="2003-12-31" required>

                    <label class="form-label fs-5" for="gender">Gender : </label>
                    <input class="radio" type="radio" name="gender" id="male" value="Male" <?php if($user_gender=='Male')echo "checked"; ?> required>
                    <label class="form-label fs-5" for="male" class="light">Male</label>
                    <input class="radio" type="radio" name="gender" id="female" value="Female" <?php if($user_gender=='Female')echo "checked"; ?>>
                    <label class="form-label fs-5" for="female" class="light">Female</label>
                    <br>
                    <label class="form-label fs-5" for="bloodGroup">Blood Group : </label>
                    <select class="form-group fs-5" name="bloodGroup" id="bloodGroup" required>
                        <option value=""></option>
                        <option value="A+" <?php if($user_blood_group=='A+')echo "selected"; ?> >A+</option>
                        <option value="B+" <?php if($user_blood_group=='B+')echo "selected"; ?> >B+</option>
                        <option value="O+" <?php if($user_blood_group=='O+')echo "selected"; ?> >O+</option>
                        <option value="AB+" <?php if($user_blood_group=='AB+')echo "selected"; ?> >AB+</option>
                        <option value="A-" <?php if($user_blood_group=='A-')echo "selected"; ?> >A-</option>
                        <option value="B-" <?php if($user_blood_group=='B-')echo "selected"; ?> >B-</option>
                        <option value="O-" <?php if($user_blood_group=='O-')echo "selected"; ?> >O-</option>
                        <option value="AB-" <?php if($user_blood_group=='AB-')echo "selected"; ?> >AB-</option>
                    </select>
                    <br>

                    <!-- <label for="aadharDocName" class="form-label fs-5">Aadhar Card Photo</label>
                    <input type="file" class="form-control fs-5 mb-3" name="aadharDocumentImage" id="aadharDocumentImage" accept="image/png, image/jpeg" required> -->

                    <button type="submit" class="btn btn-primary w-100 mt-3 fs-5 mb-0" name="editUser" id="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
</section>

<?php
    if(isset($_POST['editUser'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $bloodGroup = $_POST['bloodGroup'];

        $query = "UPDATE `users` SET `password`='{$password}',`user_name`='{$name}',`user_email`='{$email}',`user_dob`='{$dob}',`user_gender`='{$gender}',`user_blood_group`='{$bloodGroup}' WHERE user_id = '{$global_user_id}'";
        $update_query = mysqli_query($connection,$query);
        if(!$update_query){
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Profile Updated Successfully')</script>";
            echo "<script>location.href='./profile.php'</script>";
        }
    }
?>