
<?php
    if(isset($_POST["submit"])){
        $vcName = $_POST["name"];
        $vcUserName = $_POST["username"];
        $vcPassword = $_POST["password"];
        $vcAddress = $_POST["address"];
        $vcPincode = $_POST["pincode"];
        $vcCostType = $_POST["costType"];
        $vcAgeGroup = $_POST["ageGroup"];

        $query = "INSERT INTO vaccination_centres (vc_username, vc_password, vc_name, vc_address, vc_cost_type, vc_pincode, vc_age_group) ";
        $query .= "VALUES('{$vcUserName}','{$vcPassword}','{$vcName}','{$vcAddress}','{$vcCostType}','{$vcPincode}','{$vcAgeGroup}')";

        $addVc = mysqli_query($connection,$query);
        if(!$addVc){
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Vaccination Centre Added Successfully.')</script>";
            echo "<script>location.href='vc.php'</script>";
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
    
    <h1>Add Vaccination Centre</h1>

    <label for="name">Vaccination Centre Name</label>
    <input type="text" name="name" id="name" required><br>
    
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required>
    
    <label for="password">Password</label>
    <input type="password" name="password" id="password" onkeyup='check();' required>
    
    <label for="confirmPassword">Confirm Password <span class='message' id="pwdMsg"></span></label>
    <input type="password" name="confirmPassword" id="confirmPassword" onkeyup='check();' required>
    
    <label for="address">Address</label>
    <textarea min="10" max="200" name="address" required> </textarea>
    
    <label for="pincode">Pincode</label>
    <input type="text" name="pincode" id="pincode" pattern="[1-9]{1}[0-9]{5}" maxlength="6" required>

    <label for="costType">Cost Type</label>
    <select name="costType" id="costType" required>
        <option value="free">Free</option>
        <option value="paid">Paid</option>
    </select>

    <label for="ageGroup">Age Group</label>
    <select name="ageGroup" id="ageGroup" required>
        <option value="none">--- Select Age Group ---</option>
        <?php
            $query = "SELECT * FROM age_group";
            $viewAllAgeGroup = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($viewAllAgeGroup)){
                $age_group_id = $row['age_group_id'];
                $age_from = $row['age_from'];
                $age_to = $row['age_to'];
                echo "<option value='$age_group_id'>$age_from - $age_to</option>";
            }
        ?>
    </select>

    <button type="submit" name="submit" id="submit">Add</button>
</form>

<!-- <label for="mobileNo">Contact No</label>
    <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" required> -->