<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    // Add Testing
    if(isset($_POST['addLabTesting'])){
        $lab_id = $global_lab_id;
        $testing_id = $_POST['testingName'];
        $testing_price = $_POST['testingPrice'];
        $query = "INSERT INTO labs_testings (lab_id,tt_id,price) VALUES ('{$lab_id}','{$testing_id}','{$testing_price}')";
        $addTesting = mysqli_query($connection,$query);
        if(!$addTesting){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Testing Added Successfully.')</script>";
            echo "<script>location.href='./lab_to_testing.php'</script>";
        }
    }

    // Delete Testing
    if(isset($_GET['DeleteTesting'])){
        $LT_id = $_GET['DeleteTesting'];
        $query = "DELETE FROM labs_testings WHERE LT_id = '{$LT_id}'";
        $delete = mysqli_query($connection,$query);
        if(!$delete){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>location.href='./lab_to_testing.php'</script>";
        }
    }

?>


<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h5>Lab Testing details:</h5>
        <form class="d-flex" method="POST">
            <!-- Select Testing -->
            <div class="form-group">
                <select class="form-control" name="testingName">
                    <option value="#">Select Testing Name</option>

                    <?php
                        $query="SELECT * FROM testing_types";
                        $getTestingTypes = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_array($getTestingTypes)){
                            $testing_id = $row['tt_id'];
                            $testing_name = $row['tt_name'];

                            $query = "SELECT * FROM labs_testings WHERE tt_id = $testing_id AND lab_id = $global_lab_id";
                            $check = mysqli_query($connection,$query);
                            if(mysqli_num_rows($check)!=1){
                                echo "<option value='$testing_id'>$testing_name</option>";
                            }

                        }
                    ?>
                </select>
            </div>

            <!-- price -->
            <div class="form-group mx-sm-2">
                <input type="text" name="testingPrice" class="form-control" id="price" placeholder="Enter Price">
            </div>

            <!-- btn -->
            <button type="submit" name="addLabTesting" class="btn btn-success">+ Add</button>
        </form>
    </div>


    <!-- Testing table -->
    <div class="card px-5 py-3 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Testing Name</th>
                <th scope="col">Testing Price</th>
                <th scope="col" colspan="2">Commands</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT labs_testings.lab_id, labs_testings.LT_id, labs_testings.tt_id, labs_testings.price, testing_types.tt_name FROM labs_testings INNER JOIN testing_types ON labs_testings.tt_id=testing_types.tt_id";
                    $allLabTesting = mysqli_query($connection,$query);
                    if(mysqli_num_rows($allLabTesting)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                    }else{
                        while($row=mysqli_fetch_array($allLabTesting)){
                            $LT_id = $row['LT_id'];
                            $lab_id = $row['lab_id'];
                            $tt_id = $row['tt_id'];
                            $price = $row['price'];
                            $tt_name = $row['tt_name'];
                            echo "
                                <tr>
                                <th scope='row'>$tt_name</th>
                                <td>$price</td>
                                <td><a href='lab_to_testing.php?EditTesting={$LT_id}' class='card-link text-secondary'>Edit</a></td>
                                <td><a href='lab_to_testing.php?DeleteTesting={$LT_id}' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Delete</a></td>
                                </tr>
                            ";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- EDIT TESTING -->
<?php
    if(isset($_GET['EditTesting'])){
        $LT_id = $_GET['EditTesting'];
        $query = "SELECT  labs_testings.price, testing_types.tt_name FROM labs_testings INNER JOIN testing_types ON labs_testings.tt_id=testing_types.tt_id WHERE labs_testings.LT_id = '{$LT_id}'";
        $forEdit = mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($forEdit)){
            $price = $row['price'];
            $tt_name = $row['tt_name'];
        }

        ?>
        <div class="container pt-3">
            <div class="d-flex justify-content-end mb-2">
                <form class="d-flex" method="POST">
                    <div class="form-group">
                        <select class="form-control" name="testingName" disabled>
                            <option value=""><?php echo $tt_name; ?></option>
                        </select>
                    </div>
                    
                    <!-- price -->
                    <div class="form-group mx-sm-2">
                        <input type="text" name="updatedPrice" value="<?php if(isset($price)){echo $price;}?>" class="form-control" id="price" placeholder="Enter Price">
                    </div>
                    
                    <!-- btn -->
                    <button type="submit" name="UpdateTesting" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
<?php } ?>

<?php
    if(isset($_POST['UpdateTesting'])){
        $updatedPrice = $_POST['updatedPrice'];
        $query = "UPDATE labs_testings SET price = '{$updatedPrice}' WHERE LT_id = {$LT_id}";
        $check = mysqli_query($connection,$query);
        if(!$check){
            echo die("Update Query Failed" . mysqli_error($connection));
        }
        echo "<script>location.href='./lab_to_testing.php'</script>";
    }
?>