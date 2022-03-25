<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    // Add Bed Count
    if(isset($_POST['addDoctor'])){
        $hospital_id = $global_hospital_id;
        $doctorName = $_POST['doctorName'];
        $doctorDescription = $_POST['doctorDescription'];
        $query = "INSERT INTO doctor_details (doctor_name,doctor_description,hospital_id) VALUES ('{$doctorName}','{$doctorDescription}','{$hospital_id}')";
        $addDoctor = mysqli_query($connection,$query);
        if(!$addDoctor){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Doctor Detail Added Successfully.')</script>";
            echo "<script>location.href='./doctorDetails.php'</script>";
        }
    }

    // Delete Wards
    if(isset($_GET['DeleteDoctor'])){
        $doctor_id = $_GET['DeleteDoctor'];
        $query = "DELETE FROM doctor_details WHERE doctor_id = '{$doctor_id}'";
        $delete = mysqli_query($connection,$query);
        if(!$delete){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Doctor deleted successfully');location.href='./doctorDetails.php'</script>";
        }
    }

?>


<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h5>Hospital Doctor details:</h5>
        <form class="d-flex" method="POST">
            <!-- Select Ward -->
            <div class="form-group">
                <input type="text" class="form-control" name="doctorName" id="" placeholder="Enter Doctor Name">
            </div>

            <!-- Total Beds -->
            <div class="form-group mx-sm-2">
                <input type="text" name="doctorDescription" class="form-control" id="price" placeholder="Enter Doctor Description">
            </div>

            <!-- btn -->
            <button type="submit" name="addDoctor" class="btn btn-success">+ Add</button>
        </form>
    </div>


    <!-- Ward table -->
    <div class="card px-5 py-3 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Doctor Name</th>
                <th scope="col">Doctor Description</th>
                <th scope="col" colspan="2">Commands</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM doctor_details WHERE hospital_id = $global_hospital_id";
                    $doctorDetail = mysqli_query($connection,$query);
                    if(mysqli_num_rows($doctorDetail)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row=mysqli_fetch_array($doctorDetail)){
                            $doctor_id = $row['doctor_id'];
                            $doctor_name = $row['doctor_name'];
                            $doctor_description = $row['doctor_description'];
                            echo "
                                <tr>
                                <th scope='row'>$index</th>
                                <th scope='row'>$doctor_name</th>
                                <td>$doctor_description</td>
                                <td><a href='doctorDetails.php?EditDoctor={$doctor_id}' class='card-link text-secondary'>Edit</a></td>
                                <td><a href='doctorDetails.php?DeleteDoctor={$doctor_id}' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Delete</a></td>
                                </tr>
                            ";
                            $index++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- EDIT WARDS -->
<?php
    if(isset($_GET['EditDoctor'])){
        $doctor_id = $_GET['EditDoctor'];
        $query = "SELECT * FROM doctor_details WHERE doctor_id = '{$doctor_id}'";
        $forEdit = mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($forEdit)){
            $doctor_name = $row['doctor_name'];
            $doctor_description = $row['doctor_description'];
        }

        ?>
        <div class="container pt-3">
            <div class="d-flex justify-content-end mb-2">
                <form class="d-flex" method="POST">
                    <div class="form-group">
                        <select class="form-control" name="ward" disabled>
                            <option value=""><?php echo $doctor_name; ?></option>
                        </select>
                    </div>
                    
                    <!-- Total Beds -->
                    <div class="form-group mx-sm-2">
                        <input type="text" name="updatedDoctorDescription" value="<?php if(isset($doctor_description)){echo $doctor_description;}?>" class="form-control" id="totalBeds" placeholder="Enter Total Beds">
                    </div>

                    <!-- btn -->
                    <button type="submit" name="UpdateDoctor" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
<?php } ?>

<?php
    if(isset($_POST['UpdateDoctor'])){
        $updatedDoctorDescription = $_POST['updatedDoctorDescription'];
        $query = "UPDATE doctor_details SET doctor_description = '{$updatedDoctorDescription}' WHERE doctor_id = {$doctor_id}";
        $check = mysqli_query($connection,$query);
        if(!$check){
            echo die("Update Query Failed" . mysqli_error($connection));
        }
        echo "<script>alert('Doctor Detail Updated');location.href='./doctorDetails.php'</script>";
    }
?>