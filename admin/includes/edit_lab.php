
<?php
    // UPDATE Category
    if(isset($_POST['submit'])){
        $updateLabName = $_POST['name'];
        $updateLabUsername = $_POST['username'];
        $updateLabAddress = $_POST['address'];
        $updateLabPincode = $_POST['pincode'];
        $updateLabContactNo = $_POST['mobileNo'];
        $query = "UPDATE laboratories SET lab_name = '{$updateLabName}',lab_username = '{$updateLabUsername}',lab_address = '{$updateLabAddress}',lab_pincode = '{$updateLabPincode}',contact_no = '{$updateLabContactNo}' WHERE lab_id = {$lab_id}";
        $update_query = mysqli_query($connection,$query);
        if(!$update_query){
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Laboratory Updated Successfully.')</script>";
            echo "<script>location.href='laboratory.php'</script>";
        }
    }
?>

<?php
if(isset($_GET["lab_id"])){
    $lab_id = $_GET["lab_id"];
    $query = "SELECT * FROM laboratories WHERE lab_id = '{$lab_id}'";
    $view_all_lab = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($view_all_lab)){
        $lab_name = $row["lab_name"];
        $lab_username = $row["lab_username"];
        $lab_address = $row["lab_address"];
        $lab_contactNo = $row["contact_no"];
        $lab_pincode = $row["lab_pincode"];
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data" class="cmdForm">

        <h1>Edit Laboratory</h1>

        <label for="name">Laboratory Name</label>
        <input type="text" name="name" id="name" value="<?php if(isset($lab_name)){echo $lab_name;} ?>"  required><br>

        <label for="username">Username</label>
        <input type="text" name="username" value="<?php if(isset($lab_username)){echo $lab_username;} ?>" id="username" required>

        <label for="address">Address</label>
        <textarea min="10" max="200" name="address" required><?php if(isset($lab_address)){echo $lab_address;} ?></textarea>

        <label for="mobileNo">Contact No</label>
        <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" value="<?php if(isset($lab_contactNo)){echo $lab_contactNo;} ?>" required>

        <label for="pincode">Pincode</label>
        <!-- <input type="text" name="pincode" id="pincode" pattern="[1-9]{1}[0-9]{5}" value="<?php if(isset($lab_pincode)){echo $lab_pincode;} ?>" maxlength="6" required> -->
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
                    if($pincode==$lab_pincode) echo "selected";
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