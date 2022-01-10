
<?php
    // UPDATE Category
    if(isset($_POST['submit'])){
        $updateVcName = $_POST['name'];
        $updateVcUsername = $_POST['username'];
        $updateVcAddress = $_POST['address'];
        $updateVcPincode = $_POST['pincode'];
        $updateVcCostType = $_POST['costType'];
        $updateVcAgeGroup = $_POST['ageGroup'];
        $query = "UPDATE vaccination_centres SET vc_name = '{$updateVcName}',vc_username = '{$updateVcUsername}',vc_address = '{$updateVcAddress}',vc_pincode = '{$updateVcPincode}',vc_cost_type = '{$updateVcCostType}',vc_age_group = '{$updateVcAgeGroup}' WHERE vc_id = {$vc_id}";
        $update_query = mysqli_query($connection,$query);
        if(!$update_query){
            echo die("Update Query Failed" . mysqli_error($connection));
        }
        header("Location: vc.php");
    }
?>

<?php
if(isset($_GET["vc_id"])){
    $vc_id = $_GET["vc_id"];
    $query = "SELECT * FROM vaccination_centres WHERE vc_id = '{$vc_id}'";
    $view_all_vc = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($view_all_vc)){
        $vc_name = $row["vc_name"];
        $vc_username = $row["vc_username"];
        $vc_address = $row["vc_address"];
        $vc_cost_type = $row["vc_cost_type"];
        $vc_age_group = $row["vc_age_group"];
        $vc_pincode = $row["vc_pincode"];
    }
?>

<form action="" method="post" enctype="multipart/form-data" class="cmdForm">
    
    <h1>Edit Vaccination Centre</h1>

    <label for="name">Vaccination Centre Name</label>
    <input type="text" name="name" id="name" value="<?php if(isset($vc_name)){echo $vc_name;} ?>"  required><br>
    
    <label for="username">Username</label>
    <input type="text" name="username" value="<?php if(isset($vc_username)){echo $vc_username;} ?>" id="username" required>
    
    <label for="address">Address</label>
    <textarea min="10" max="200" name="address" required> <?php if(isset($vc_address)){echo $vc_address;} ?> </textarea>
    
    <label for="pincode">Pincode</label>
    <input type="text" name="pincode" id="pincode" pattern="[1-9]{1}[0-9]{5}" value="<?php if(isset($vc_pincode)){echo $vc_pincode;} ?>" maxlength="6" required>

    <label for="costType">Cost Type</label>
    <select name="costType" id="costType" required>
        <?php if($vc_cost_type == "free"){ ?>
            <option value="free" selected>Free</option>
            <option value="paid">Paid</option>
        <?php } else { ?>
                <option value="free">Free</option>
                <option value="paid" selected>Paid</option>
        <?php } ?>
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
                if($age_group_id == $vc_age_group)
                echo "<option value='$age_group_id' selected>$age_from - $age_to</option>";
                else
                echo "<option value='$age_group_id'>$age_from - $age_to</option>";
            }
        ?>
    </select>

    <button type="submit" name="submit" id="submit">Update</button>
</form>
<?php
    }
?>