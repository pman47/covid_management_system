<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    // Add Bed Count
    if(isset($_POST['addBedCount'])){
        $hospital_id = $global_hospital_id;
        $ward_id = $_POST['wardId'];
        $total_beds = $_POST['wardTotalBeds'];
        $available_beds = $_POST['wardTotalBeds'];
        $query = "INSERT INTO bed_count (hospital_id,ward_id,total_beds,available_beds) VALUES ('{$hospital_id}','{$ward_id}','{$total_beds}','{$available_beds}')";
        $addBedCount = mysqli_query($connection,$query);
        if(!$addBedCount){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Bed Added Successfully.')</script>";
            echo "<script>location.href='./wardDetails.php'</script>";
        }
    }

    // Delete Wards
    if(isset($_GET['DeleteBed'])){
        $bed_count_id = $_GET['DeleteBed'];
        $query = "DELETE FROM bed_count WHERE bed_count_id = '{$bed_count_id}'";
        $delete = mysqli_query($connection,$query);
        if(!$delete){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>location.href='./wardDetails.php'</script>";
        }
    }

?>


<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h5>Hospital Ward details:</h5>
        <form class="d-flex" method="POST">
            <!-- Select Ward -->
            <div class="form-group">
                <select class="form-control" name="wardId">
                    <option value="#">Select Ward</option>

                    <?php
                        $query="SELECT * FROM wards";
                        $getWardTypes = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_array($getWardTypes)){
                            $ward_id = $row['ward_id'];
                            $ward_name = $row['ward_name'];

                            $query = "SELECT * FROM bed_count WHERE ward_id = $ward_id AND hospital_id = $global_hospital_id";
                            $check = mysqli_query($connection,$query);
                            if(mysqli_num_rows($check)!=1){
                                echo "<option value='$ward_id'>$ward_name</option>";
                            }

                        }
                    ?>
                </select>
            </div>

            <!-- Total Beds -->
            <div class="form-group mx-sm-2">
                <input type="text" name="wardTotalBeds" class="form-control" id="price" placeholder="Enter Total Beds">
            </div>

            <!-- btn -->
            <button type="submit" name="addBedCount" class="btn btn-success">+ Add</button>
        </form>
    </div>


    <!-- Ward table -->
    <div class="card px-5 py-3 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Ward Name</th>
                <th scope="col">Total Beds</th>
                <th scope="col">Available Beds</th>
                <th scope="col" colspan="2">Commands</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT bed_count.hospital_id, bed_count.bed_count_id, bed_count.ward_id, bed_count.total_beds, bed_count.available_beds, wards.ward_name FROM bed_count INNER JOIN wards ON bed_count.ward_id=wards.ward_id WHERE hospital_id = $global_hospital_id";
                    $allBedCount = mysqli_query($connection,$query);
                    if(mysqli_num_rows($allBedCount)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                    }else{
                        while($row=mysqli_fetch_array($allBedCount)){
                            $bed_count_id = $row['bed_count_id'];
                            $hospital_id = $row['hospital_id'];
                            $ward_id = $row['ward_id'];
                            $total_beds = $row['total_beds'];
                            $available_beds = $row['available_beds'];
                            $ward_name = $row['ward_name'];
                            echo "
                                <tr>
                                <th scope='row'>$ward_name</th>
                                <td>$total_beds</td>
                                <td>$available_beds</td>
                                <td><a href='wardDetails.php?EditBed={$bed_count_id}' class='card-link text-secondary'>Edit</a></td>
                                <td><a href='wardDetails.php?DeleteBed={$bed_count_id}' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Delete</a></td>
                                </tr>
                            ";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- EDIT WARDS -->
<?php
    if(isset($_GET['EditBed'])){
        $bed_count_id = $_GET['EditBed'];
        $query = "SELECT  bed_count.total_beds, bed_count.available_beds, wards.ward_name FROM bed_count INNER JOIN wards ON bed_count.ward_id=wards.ward_id WHERE bed_count.bed_count_id = '{$bed_count_id}'";
        $forEdit = mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($forEdit)){
            $ward_name = $row['ward_name'];
            $total_beds = $row['total_beds'];
            $available_beds = $row['available_beds'];
        }

        ?>
        <div class="container pt-3">
            <div class="d-flex justify-content-end mb-2">
                <form class="d-flex" method="POST">
                    <div class="form-group">
                        <select class="form-control" name="ward" disabled>
                            <option value=""><?php echo $ward_name; ?></option>
                        </select>
                    </div>
                    
                    <!-- Total Beds -->
                    <div class="form-group mx-sm-2">
                        <input type="text" name="updatedTotalBed" value="<?php if(isset($total_beds)){echo $total_beds;}?>" class="form-control" id="totalBeds" placeholder="Enter Total Beds">
                    </div>
                    
                    <!-- Available Beds -->
                    <div class="form-group mx-sm-2">
                        <input type="text" name="updatedAvailableBed" value="<?php if(isset($available_beds)){echo $available_beds;}?>" class="form-control" id="availableBeds" placeholder="Enter Available Beds">
                    </div>
                    
                    <!-- btn -->
                    <button type="submit" name="UpdateBedCount" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
<?php } ?>

<?php
    if(isset($_POST['UpdateBedCount'])){
        $updatedTotalBed = $_POST['updatedTotalBed'];
        $updatedAvailableBed = $_POST['updatedAvailableBed'];
        $query = "UPDATE bed_count SET total_beds = '{$updatedTotalBed}', available_beds = '{$updatedAvailableBed}' WHERE bed_count_id = {$bed_count_id}";
        $check = mysqli_query($connection,$query);
        if(!$check){
            echo die("Update Query Failed" . mysqli_error($connection));
        }
        echo "<script>location.href='./wardDetails.php'</script>";
    }
?>