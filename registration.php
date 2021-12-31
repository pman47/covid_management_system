<!-- Header -->
<?php include('./includes/header.php')?>
<!-- Navigation -->
<?php include('./includes/navigation.php')?>
<!-- DB Connection -->
<?php include('./includes/db.php') ?>


<?php
    $aadharNumberExist = false;
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $mobileNo = $_POST['mobileNo'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $bloodGroup = $_POST['bloodGroup'];
        $aadharNo = $_POST['aadharNo'];

        $query = "SELECT * FROM users WHERE user_aadhar_no = $aadharNo";
        $checkAadharNo = mysqli_query($connection,$query);
        confirm($checkAadharNo);

        $count = mysqli_num_rows($checkAadharNo);
        if($count>=1){
            $aadharNumberExist = true;
        }



        // $filename = $_FILES["aadharDocumentImage"]["name"];
        // $tempname = $_FILES["aadharDocumentImage"]["tmp_name"];

        // $folder = "Documents/" . $aadharNo . "/";
        // if(!file_exists($folder)){
        //     mkdir("Documents/" . $aadharNo);
        //     $folder .= $filename;
        //     move_uploaded_file($tempname, $folder);
        // }else{
        //     echo "Aadhar Number is Already Exists";
        // }

        // $query = "INSERT INTO users (password, user_name, user_aadhar_no, mobile_no, user_email, user_dob, user_gender, user_blood_group, aadhar_document_name) ";
        // $query .= "VALUES('{$password}','{$name}','{$aadharNo}','{$mobileNo}','{$email}','{$dob}','{$gender}','{$bloodGroup}','{$filename}')";

        // $register = mysqli_query($connection,$query);
        // confirm($register);
    }





?>

<script>

    var check = function() {
        if((document.getElementById('password').value === document.getElementById('confirmPassword').value) && document.getElementById('password').value == ""){
            document.getElementById('pwdMsg').innerHTML = ' ';
        }
        else if (document.getElementById('password').value === document.getElementById('confirmPassword').value) {
            document.getElementById('pwdMsg').style.color = 'green';
            document.getElementById('pwdMsg').innerHTML = 'matching';
            document.getElementById('submit').disabled = false;
        } else {
            document.getElementById('pwdMsg').style.color = 'red';
            document.getElementById('pwdMsg').innerHTML = 'not matching';
            document.getElementById('submit').disabled = true;
        }
    }
    function Hi(){
        console.log("Hi");
    }
</script>

<!-- Page Content -->
<form action="" method="post" enctype="multipart/form-data">
    
    <h1>Registration Form</h1>

    <label for="name">Name</label>
    <input type="text" name="name" id="name" required>

    <label for="mobileNo">Mobile No</label>
    <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" required>
    
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" onkeyup='check();' required>

    <label for="confirmPassword">Confirm Password <span class='message' id="pwdMsg"></span></label>
    <input type="password" name="confirmPassword" id="confirmPassword" onkeyup='check();' required>

    <label for="dob">Date of Birth</label>
    <input type="date" name="dob" id="dob" max="2003-12-31" required>

    <label for="gender">Gender</label>
    <input type="radio" name="gender" id="male" value="Male" required>
    <label for="male" class="light">Male</label>
    <input type="radio" name="gender" id="female" value="Female">
    <label for="female" class="light">Female</label>

    <br><br>
    <label for="bloodGroup">Blood Group</label>
    <select name="bloodGroup" id="bloodGroup" required>
        <option value=""></option>
        <option value="A+">A+</option>
        <option value="B+">B+</option>
        <option value="O+">O+</option>
        <option value="AB+">AB+</option>
        <option value="A-">A-</option>
        <option value="B-">B-</option>
        <option value="O-">O-</option>
        <option value="AB-">AB-</option>
    </select>

    <label for="aadharNo">Aadhar Card No</label>
    <input type="text" name="aadharNo" id="aadharNo" pattern="[0-9]{12}" onchange='Hi();' required>

    <label for="aadharDocName">Aadhar Card Photo</label>
    <input type="file" name="aadharDocumentImage" id="aadharDocumentImage" accept="image/png, image/jpeg" required>

    <button type="submit" name="submit" id="submit">Register</button>
</form>

<!-- Footer -->
<?php include('./includes/footer.php')?>