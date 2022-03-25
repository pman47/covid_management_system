<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    // Add Bed Count
    if(isset($_POST['addWard'])){
        $hospital_id = $global_hospital_id;
        $ward_name = $_POST['wardName'];
        $total_beds = $_POST['wardTotalBeds'];
        $available_beds = $_POST['wardTotalBeds'];
        $query = "INSERT INTO ward_details (ward_name,Total_beds,Available_beds,hospital_id) VALUES ('{$ward_name}','{$total_beds}','{$available_beds}','{$hospital_id}')";
        $addWard = mysqli_query($connection,$query);
        if(!$addWard){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Ward Detail Added Successfully.')</script>";
            echo "<script>location.href='./wardDetails.php'</script>";
        }
    }

    // Delete Wards
    if(isset($_GET['DeleteWard'])){
        $ward_id = $_GET['DeleteWard'];
        $query = "DELETE FROM ward_details WHERE ward_id = '{$ward_id}'";
        $delete = mysqli_query($connection,$query);
        if(!$delete){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Ward deleted successfully');location.href='./wardDetails.php'</script>";
        }
    }

?>


<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h5>Hospital Ward details:</h5>
        <form class="d-flex" method="POST">
            <!-- Select Ward -->
            <div class="form-group">
                <input type="text" class="form-control" name="wardName" id="" placeholder="Enter Ward Name">
            </div>

            <!-- Total Beds -->
            <div class="form-group mx-sm-2">
                <input type="text" name="wardTotalBeds" class="form-control" id="price" placeholder="Enter Total Beds">
            </div>

            <!-- btn -->
            <button type="submit" name="addWard" class="btn btn-success">+ Add</button>
        </form>
    </div>


    <!-- Ward table -->
    <div class="card px-5 py-3 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Ward Name</th>
                <th scope="col">Total Beds</th>
                <th scope="col">Available Beds</th>
                <th scope="col" colspan="2">Commands</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM ward_details WHERE hospital_id = $global_hospital_id";
                    $allBedCount = mysqli_query($connection,$query);
                    if(mysqli_num_rows($allBedCount)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row=mysqli_fetch_array($allBedCount)){
                            $ward_id = $row['ward_id'];
                            $ward_name = $row['ward_name'];
                            $total_beds = $row['Total_beds'];
                            $available_beds = $row['Available_beds'];
                            echo "
                                <tr>
                                <th scope='row'>$index</th>
                                <th scope='row'>$ward_name</th>
                                <td>$total_beds</td>
                                <td>$available_beds</td>
                                <td><a href='wardDetails.php?EditWard={$ward_id}' class='card-link text-secondary'>Edit</a></td>
                                <td><a href='wardDetails.php?DeleteWard={$ward_id}' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Delete</a></td>
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
    if(isset($_GET['EditWard'])){
        $ward_id = $_GET['EditWard'];
        $query = "SELECT * FROM ward_details WHERE ward_id = '{$ward_id}'";
        $forEdit = mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($forEdit)){
            $ward_name = $row['ward_name'];
            $total_beds = $row['Total_beds'];
            $available_beds = $row['Available_beds'];
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
        $query = "UPDATE ward_details SET Total_beds = '{$updatedTotalBed}', Available_beds = '{$updatedAvailableBed}' WHERE ward_id = {$ward_id}";
        $check = mysqli_query($connection,$query);
        if(!$check){
            echo die("Update Query Failed" . mysqli_error($connection));
        }
        echo "<script>alert('Ward Updated');location.href='./wardDetails.php'</script>";
    }
?>