
<?php
    if(isset($_POST["submit"])){
        $hospitalName = $_POST["name"];
        $hospitalUserName = $_POST["username"];
        $hospitalPassword = $_POST["password"];
        $hospitalAddress = $_POST["address"];
        $hospitalPincode = $_POST["pincode"];
        $hospitalContact = $_POST["mobileNo"];
        // $vcAgeGroup = $_POST["ageGroup"];

        $query = "INSERT INTO hospitals (hospital_username, hospital_password, hospital_name, hospital_address, hospital_pincode, contact_no, hospital_status) ";
        $query .= "VALUES('{$hospitalUserName}','{$hospitalPassword}','{$hospitalName}','{$hospitalAddress}','{$hospitalPincode}','{$hospitalContact}','open')";
        $addHospital = mysqli_query($connection,$query);

        if(!$addHospital){
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Hospital Added Successfully.')</script>";
            echo "<script>location.href='hospital.php'</script>";
        }
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

<form action="" method="post" enctype="multipart/form-data" class="cmdForm">
    
    <h1>Add Hospital</h1>

    <label for="name">Hospital Name</label>
    <input type="text" name="name" id="name" required><br>
    
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required>
    
    <label for="password">Password</label>
    <input type="password" name="password" id="password" onkeyup='check();' required>
    
    <label for="confirmPassword">Confirm Password <span class='message' id="pwdMsg"></span></label>
    <input type="password" name="confirmPassword" id="confirmPassword" onkeyup='check();' required>

    <label for="mobileNo">Contact No</label>
    <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" required>
    
    <label for="address">Address</label>
    <textarea min="10" max="200" name="address" required> </textarea>
    
    <label for="pincode">Pincode</label>
    <input type="text" name="pincode" id="pincode" pattern="[1-9]{1}[0-9]{5}" maxlength="6" required>

    <button type="submit" name="submit" id="submit">Add</button>
</form>

<!-- <label for="mobileNo">Contact No</label>
    <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" required> -->
