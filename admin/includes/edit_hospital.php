
<?php
    // UPDATE
    if(isset($_POST['submit'])){
        $updateHospitalName = $_POST['name'];
        $updateHospitalUsername = $_POST['username'];
        $updateHospitalAddress = $_POST['address'];
        $updateHospitalPincode = $_POST['pincode'];
        $updateHospitalContactNo = $_POST['mobileNo'];
        $query = "UPDATE hospitals SET hospital_name = '{$updateHospitalName}',hospital_username = '{$updateHospitalUsername}',hospital_address = '{$updateHospitalAddress}',hospital_pincode = '{$updateHospitalPincode}',contact_no = '{$updateHospitalContactNo}' WHERE hospital_id = {$hospital_id}";
        $update_query = mysqli_query($connection,$query);
        if(!$update_query){
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Hospital Updated Successfully.')</script>";
            echo "<script>location.href='Hospital.php'</script>";
        }
    }
?>

<?php
    if(isset($_GET["hospital_id"])){
        $hospital_id = $_GET["hospital_id"];
        $query = "SELECT * FROM hospitals WHERE hospital_id = '{$hospital_id}'";
        $view_all_hospital = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($view_all_hospital)){
            $hospital_name = $row["hospital_name"];
            $hospital_username = $row["hospital_username"];
            $hospital_address = $row["hospital_address"];
            $hospital_contactNo = $row["contact_no"];
            $hospital_pincode = $row["hospital_pincode"];
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data" class="cmdForm">
            
            <h1>Edit Hospital</h1>

            <label for="name">Hospital Name</label>
            <input type="text" name="name" id="name" value="<?php if(isset($hospital_name)){echo $hospital_name;} ?>"  required><br>
            
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php if(isset($hospital_username)){echo $hospital_username;} ?>" id="username" required>
            
            <label for="address">Address</label>
            <textarea min="10" max="200" name="address" required> <?php if(isset($hospital_address)){echo $hospital_address;} ?> </textarea>

            <label for="mobileNo">Contact No</label>
            <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" value="<?php if(isset($hospital_contactNo)){echo $hospital_contactNo;} ?>" required>
            
            <label for="pincode">Pincode</label>
            <!-- <input type="text" name="pincode" id="pincode" pattern="[1-9]{1}[0-9]{5}" value="<?php if(isset($hospital_pincode)){echo $hospital_pincode;} ?>" maxlength="6" required> -->
            <select name="pincode" class="pincodeTag" id="pincode" placeholder="Select Your Favorite">
                <option value="0">-- Select Pincode --</option>
                <?php
                    $query = "SELECT pincode.pincode, pincode.area_name, district.district_name FROM pincode INNER JOIN district ON pincode.district_id = district.district_id";
                    $getValues = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($getValues)){
                        $pincode = $row['pincode'];
                        $area_name = $row['area_name'];
                        $district_name = $row['district_name'];
                        echo "<option value='$pincode'";
                        if($pincode==$hospital_pincode) echo "selected";
                        echo "> $pincode    | $area_name,$district_name </option>";
                    }
                ?>
            </select>

            <button type="submit" name="submit" id="submit">Update</button>
        </form>
        <?php
    }
?>

<script>
    $(document).ready(function(){
        $("#pincode").select2();
    });
</script>