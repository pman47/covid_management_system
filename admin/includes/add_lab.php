
<?php
    if(isset($_POST["submit"])){
        $labName = $_POST["name"];
        $labUserName = $_POST["username"];
        $labPassword = $_POST["password"];
        $labAddress = $_POST["address"];
        $labPincode = $_POST["pincode"];
        $labContact = $_POST["mobileNo"];
        // $vcAgeGroup = $_POST["ageGroup"];

        $query = "INSERT INTO laboratories (lab_username, lab_password, lab_name, lab_address, lab_pincode, contact_no, lab_status) ";
        $query .= "VALUES('{$labUserName}','{$labPassword}','{$labName}','{$labAddress}','{$labPincode}','{$labContact}','open')";
        $addLab = mysqli_query($connection,$query);

        if(!$addLab){
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Laboratory Added Successfully.')</script>";
            echo "<script>location.href='laboratory.php'</script>";
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
    
    <h1>Add Laboratory</h1>

    <label for="name">Laboratory Name</label>
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
