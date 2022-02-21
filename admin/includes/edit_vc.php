
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
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            if(isset($_POST["ageGroup"]))
            {
                foreach ($_POST['ageGroup'] as $ageGroup){
                    $query = "INSERT INTO vc_age_group (vc_id, age_group_id) ";
                    $query .= "VALUES('{$vc_id}','{$ageGroup}')";
                    $addAgeGroup = mysqli_query($connection,$query);
                }
            }

            if(!$addAgeGroup){
                $connection;
                die("QUERY FAILED " . mysqli_error($connection));
            }else{
                echo "<script>alert('Vaccination Centre Updated Successfully.')</script>";
                echo "<script>location.href='vc.php'</script>";
            }
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
        // $vc_age_group = $row["vc_age_group"];
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
    <select name="ageGroup[]" id="ageGroup" required>
        <?php

            $query = "SELECT * FROM age_group";
            $getAllAgeGroups = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($getAllAgeGroups)){
                $age_group_id = $row['age_group_id'];
                $age_from = $row['age_from'];
                $age_to = $row['age_to'];

                $query1 = "SELECT * FROM vc_age_group WHERE vc_id = '$vc_id' AND age_group_id = '$age_group_id'";
                $check = mysqli_query($connection,$query1);
                if($check>0){
                    echo "<option value='$age_group_id' selected>$age_from - $age_to</option>";
                }else{
                    echo "<option value='$age_group_id'>$age_from - $age_to</option>";
                }



            }


            // $query = "SELECT * FROM vc_age_group WHERE vc_id = '$vc_id'";
            // $viewAllAgeGroup = mysqli_query($connection,$query);
            // while($row = mysqli_fetch_assoc($viewAllAgeGroup)){
            //     $age_group_id = $row['age_group_id'];
            //     $query = "SELECT * FROM age_group WHERE age_group_id = $age_group_id";
            //     $getAgeGroup = mysqli_query($connection,$query);
            //     while($col = mysqli_fetch_assoc($getAgeGroup)){
            //         $age_from = $col['age_from'];
            //         $age_to = $col['age_to'];
            //     }
            //     // if($age_group_id == $vc_age_group)
            //     // echo "<option value='$age_group_id' selected>$age_from - $age_to</option>";
            //     // else
            //     echo "<option value='$age_group_id'>$age_from - $age_to</option>";
            // }
        ?>
    </select>

    <button type="submit" name="submit" id="submit">Update</button>
</form>
<?php
    }
?>