<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
    $hospital_id = $global_hospital_id;
    $query = "SELECT * FROM hospitals WHERE hospital_id = '{$hospital_id}'";

    $viewHospitalDetail = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($viewHospitalDetail);
    $hospital_username =    $row["hospital_username"];
    $hospital_password =    $row["hospital_password"];
    $hospital_name =        $row["hospital_name"];
    $hospital_address =     $row["hospital_address"];
    $hospital_contact_no =  $row["contact_no"];
    $hospital_pincode =     $row["hospital_pincode"];
    $hospital_status =      $row["hospital_status"];
?>

<script>
    $(document).ready(function(){
        $("#pincode").select2();
    });
</script>

<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow" style="border-radius: 1rem;">
                <div class="card-body p-4">
                    <form class="row g-3" method="POST">

                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="text" name="updatedName" value="<?php if(isset($hospital_name)){echo $hospital_name;} ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="text" name="updatedUsername" disabled value="<?php if(isset($hospital_username)){echo $hospital_username;} ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" name="updatedPassword" value="<?php if(isset($hospital_password)){echo $hospital_password;} ?>">
                        </div>

                        <div class="col-md-12">
                            <label for="contact_no" class="form-label">Contact No</label>
                            <input type="text" class="form-control" name="updatedContactNo" id="contactNo" value="<?php if(isset($hospital_contact_no)){echo $hospital_contact_no;} ?>">
                        </div>

                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <!-- <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> -->
                            <textarea name="updatedAddress" class="form-control" id="address" rows="2" name="updatedAddress"><?php if(isset($hospital_address)){echo $hospital_address;} ?></textarea>
                        </div>

                        <!-- <div class="col-md-12">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" name="updatedPincode" class="form-control" id="pincode">
                        </div> -->
                        
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
                                        if($pincode==$hospital_pincode) echo "selected";
                                        echo "> $pincode    | $area_name,$district_name </option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mt-0">
                            <label for="pincode" class="form-label">Status</label><br>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <?php if($hospital_status=='open'){?>
                                    <input type="radio" class="btn-check" name="updatedStatus" value="open" id="btnradio1" checked>
                                <?php }else {?>
                                    <input type="radio" class="btn-check" name="updatedStatus" value="open" id="btnradio1">
                                <?php }?>
                                <label class="btn btn-outline-success" for="btnradio1">Open</label>
                                
                                <?php if($hospital_status=='close'){?>
                                    <input type="radio" class="btn-check" name="updatedStatus" value="close" id="btnradio2" checked>
                                <?php }else {?>
                                    <input type="radio" class="btn-check" name="updatedStatus" value="close" id="btnradio2">
                                <?php }?>
                                <label class="btn btn-outline-danger" for="btnradio2">Closed</label>
                                
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <button type="submit" name="editHospital" class="btn btn-outline-dark w-100" style="border-radius: 25px">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['editHospital'])){
        $hospital_username = $_POST["updatedUsername"];
        $hospital_password = $_POST["updatedPassword"];
        $hospital_name = $_POST["updatedName"];
        $hospital_address = $_POST["updatedAddress"];
        $hospital_contact_no = $_POST["updatedContactNo"];
        $hospital_pincode = $_POST["updatedPincode"];
        $hospital_status = $_POST["updatedStatus"];

        $query = "UPDATE hospitals SET hospital_name = '{$hospital_name}',hospital_password = '{$hospital_password}',hospital_address = '{$hospital_address}',hospital_pincode = '{$hospital_pincode}',contact_no = '{$hospital_contact_no}',hospital_status='{$hospital_status}' WHERE hospital_id = {$hospital_id}";
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