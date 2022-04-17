<?php include('./includes/header.php'); ?>
<?php include('./includes/db.php');?>
<?php include('./includes/navigation.php'); ?>


<?php
    if(isset($_POST['requestForBed'])){
        $date = $_POST['date'];
        $hospital_id = $_GET['hospitalid'];
        $user_id = $_SESSION['user_id'];
        $ward_id = $_POST['selecteWardId'];
        // echo $date;
        // echo $lab_id;
        // echo $user_id;
        $query = "INSERT INTO `bed_requests`(`request_date`, `patient_status`, `user_id`, `hospital_id`, `ward_id`) VALUES ('{$date}','pending','{$user_id}','{$hospital_id}','{$ward_id}')";
        $registerBed = mysqli_query($connection,$query);
        if(!$registerBed){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            alert("Request Sended Successfully");
            window.location.href="./";
            </script>';
        }
    }
?>

<?php
    $hospital_id = $_GET['hospitalid'];
    $query = "SELECT * FROM hospitals INNER JOIN pincode ON hospitals.hospital_pincode = pincode.pincode INNER JOIN district ON pincode.district_id = district.district_id WHERE hospitals.hospital_id = '{$hospital_id}'";
    $getDetails = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($getDetails);
    $hospital_name = $row['hospital_name'];
    $hospital_username = $row['hospital_username'];
    $hospital_address = $row['hospital_address'];
    $contact_no = $row['contact_no'];
    $hospital_pincode = $row['hospital_pincode'];
    $area_name = $row['area_name'];
    $district_name = $row['district_name'];
    $hospital_accepting_status = $row['hospital_accepting_status'];
    ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>Hospital Details</h3>
        </div>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h3 class='card-title text-success'><?php echo $hospital_name; ?><small class='text-muted h5'>- <?php echo $hospital_username; ?></small></h3>
                        </div>
                        <div class="col">
                            <h5 class="card-text">+91 <?php echo $contact_no; ?></h5>
                        </div>
                    </div>
                    <h5 class="card-text"><?php echo $hospital_address; ?></h5>
                    
                    <h6 class="card-text">Pincode:
                        <b><?php echo $hospital_pincode; ?></b>
                        <?php echo "- ".$area_name.", ".$district_name;?>
                    </h6>

                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h3>Doctor Details</h3>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Doctor Name</th>
                            <th scope="col">Doctor Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM doctor_details WHERE hospital_id = '{$hospital_id}'";
                        $allDoctorDetails = mysqli_query($connection,$query);
                        $index = 1;
                        while($row = mysqli_fetch_assoc($allDoctorDetails)){
                            $doctor_name = $row['doctor_name'];
                            $doctor_description = $row['doctor_description'];
                            ?>
                            
                            <tr>
                                <th scope="row"><?php echo $index;?></th>
                                <td><?php echo $doctor_name;?></td>
                                <td><?php echo $doctor_description;?></td>
                            </tr>
                        <?php
                        $index++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<form action="requestForHospitalBed.php?hospitalid=<?php echo $hospital_id;?>" method="post">
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
                <h3>Ward Details</h3>
                <div class="d-flex">
                    <input type="date" class="form-control" name="date" required>
                    <input type="submit" name="requestForBed" onClick="javascript: return confirm('Are You Sure?');" value="Send Bed Request" class="btn btn-success rounded-pill px-4 mx-3"></label>
                </div>
            </div>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ward Name</th>
                            <th scope="col">Total Wards</th>
                            <th scope="col">Available Wards</th>
                            <th scope="col">Select Ward</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM ward_details WHERE hospital_id = '{$hospital_id}'";
                        $allWardDetails = mysqli_query($connection,$query);
                        $index = 1;
                        while($row = mysqli_fetch_assoc($allWardDetails)){
                            $ward_name = $row['ward_name'];
                            $ward_id = $row['ward_id'];
                            $Total_beds = $row['Total_beds'];
                            $Available_beds = $row['Available_beds'];
                            ?>
                            
                            <tr>
                                <th scope="row"><?php echo $index;?></th>
                                <td><?php echo $ward_name;?></td>
                                <td><?php echo $Total_beds;?></td>
                                <td><?php echo $Available_beds;?></td>
                                <td><input type="radio" name="selecteWardId" value="<?php echo $ward_id;?>"> </td>
                            </tr>
                        <?php
                        $index++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class=""></div>
        </div>
    </div>
</form>