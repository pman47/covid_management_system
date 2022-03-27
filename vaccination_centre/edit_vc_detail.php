<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
    $vc_id = $global_vc_id;
    $query = "SELECT * FROM vaccination_centres WHERE vc_id = '{$vc_id}'";

    $viewVcDetail = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($viewVcDetail);
    $vc_username = $row["vc_username"];
    $vc_password = $row["vc_password"];
    $vc_name = $row["vc_name"];
    $vc_address = $row["vc_address"];
    $vc_cost_type = $row["vc_cost_type"];
    $vc_pincode = $row["vc_pincode"];
    $vc_status = $row["vc_status"];
?>

<script>
    $(document).ready(function(){
        $("#pincode").select2();
    });
</script>

<div class="container pt-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow" style="border-radius: 1rem;">
                <div class="card-body p-4">
                    <form class="row g-3" method="POST">

                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="text" name="updatedName" value="<?php if(isset($vc_name)){echo $vc_name;} ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="text" name="updatedUsername" disabled value="<?php if(isset($vc_username)){echo $vc_username;} ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" name="updatedPassword" value="<?php if(isset($vc_password)){echo $vc_password;} ?>">
                        </div>


                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <!-- <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> -->
                            <textarea name="updatedAddress" class="form-control" id="address" rows="2" name="updatedAddress"><?php if(isset($vc_address)){echo $vc_address;} ?></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="pincode" class="form-label">Pincode</label>
                            <select class="form-select w-100" name="updatedPincode" id="pincode">
                                <option value="">-- Select Pincode --</option>
                                <?php
                                    $query = "SELECT pincode.pincode, pincode.area_name, district.district_name FROM pincode INNER JOIN district ON pincode.district_id = district.district_id";
                                    $getValues = mysqli_query($connection,$query);
                                    while($row = mysqli_fetch_assoc($getValues)){
                                        $pincode = $row['pincode'];
                                        $area_name = $row['area_name'];
                                        $district_name = $row['district_name'];
                                        echo "<option value='$pincode'";
                                        if($pincode==$vc_pincode) echo "selected";
                                        echo "> $pincode    | $area_name,$district_name </option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="pincode" class="form-label">Status</label><br>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <?php if($vc_status=='open'){?>
                                    <input type="radio" class="btn-check" name="updatedStatus" value="open" id="btnradio1" checked>
                                <?php }else {?>
                                    <input type="radio" class="btn-check" name="updatedStatus" value="open" id="btnradio1">
                                <?php }?>
                                <label class="btn btn-outline-success" for="btnradio1">Open</label>
                                
                                <?php if($vc_status=='close'){?>
                                    <input type="radio" class="btn-check" name="updatedStatus" value="close" id="btnradio2" checked>
                                <?php }else {?>
                                    <input type="radio" class="btn-check" name="updatedStatus" value="close" id="btnradio2">
                                <?php }?>
                                <label class="btn btn-outline-danger" for="btnradio2">Closed</label>
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="pincode" class="form-label">Cost Type</label><br>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <?php if($vc_cost_type=='free'){?>
                                    <input type="radio" class="btn-check" name="updatedCostType" value="free" id="btnradio3" checked>
                                <?php }else {?>
                                    <input type="radio" class="btn-check" name="updatedCostType" value="free" id="btnradio3">
                                <?php }?>
                                <label class="btn btn-outline-success" for="btnradio3">Free</label>
                                
                                <?php if($vc_cost_type=='paid'){?>
                                    <input type="radio" class="btn-check" name="updatedCostType" value="paid" id="btnradio4" checked>
                                <?php }else {?>
                                    <input type="radio" class="btn-check" name="updatedCostType" value="paid" id="btnradio4">
                                <?php }?>
                                <label class="btn btn-outline-danger" for="btnradio4">Paid</label>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Age Group</label>
                            <?php
                                $query = "SELECT * FROM age_group";
                                $getAllAgeGroup = mysqli_query($connection,$query);
                                while($row=mysqli_fetch_assoc($getAllAgeGroup)){
                                    $age_group_id = $row['age_group_id'];
                                    $age_from = $row['age_from'];
                                    $age_to = $row['age_to'];
                                    $query = "SELECT * FROM vc_age_group WHERE age_group_id = $age_group_id AND vc_id = $global_vc_id";
                                    $checkIfExist = mysqli_query($connection,$query);
                                    $total = mysqli_num_rows($checkIfExist);
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="updatedCheckBox[]" value="<?php echo $age_group_id;?>" id="flexCheckDefault" <?php if($total>0) echo 'checked'; ?> >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <?php echo $age_from . " - " . $age_to;?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>


                        <div class="col-12 mt-5">
                            <button type="submit" name="editVc" class="btn btn-outline-dark w-100" style="border-radius: 25px">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['editVc'])){
        $vc_password = $_POST["updatedPassword"];
        $vc_name = $_POST["updatedName"];
        $vc_address = $_POST["updatedAddress"];
        $vc_costType = $_POST["updatedCostType"];
        $vc_pincode = $_POST["updatedPincode"];
        $vc_status = $_POST["updatedStatus"];
        $vc_ageGroup = $_POST['updatedCheckBox'];
        $query = "DELETE FROM vc_age_group WHERE vc_id = '{$global_vc_id}'";
        $deleteAgeGroups = mysqli_query($connection,$query);
        
        foreach ($vc_ageGroup as $age_id) {
            $query = "INSERT INTO vc_age_group(`vc_id`, `age_group_id`) VALUES ('{$global_vc_id}','{$age_id}')";
            $add_age_group = mysqli_query($connection,$query);
            confirm($add_age_group);
        }

        $query = "UPDATE vaccination_centres SET vc_name = '{$vc_name}',vc_password = '{$vc_password}',vc_address = '{$vc_address}',vc_pincode = '{$vc_pincode}',vc_cost_type = '{$vc_costType}',vc_status='{$vc_status}' WHERE vc_id = {$vc_id}";
        $update_query = mysqli_query($connection,$query);
        if(!$update_query){
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Details Updated Successfully')</script>";
            echo "<script>location.href='./'</script>";
        }
    }
?>