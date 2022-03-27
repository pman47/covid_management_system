<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
ob_start();

    if(isset($_GET["districtDelete"])){
        $districtId = $_GET["districtDelete"];
        $query = "DELETE FROM district WHERE district_id = '{$districtId}'";
        $deleteDistrict = mysqli_query($connection,$query);
        header("Location: district.php");
    }

    if(isset($_POST["addDistrict"])){
        $state_id = $_POST['stateId'];
        $districtName = $_POST["districtName"];
        $district = trim($districtName," ");
        if($district == '' || empty($district)){
            echo "Empty value can not be added";
        }else{
            $query = "SELECT district_name FROM district WHERE district_name = '{$districtName}'";
            
            $checkIfExist=mysqli_query($connection,$query);
            
            if (mysqli_num_rows($checkIfExist) != 0)
            {
                echo '<script>
                alert("District is Already Exist");
                </script>';

            }else{
                $query = "INSERT INTO district(district_name,state_id) VALUES ('{$districtName}','{$state_id}')";
                $addDistrict = mysqli_query($connection,$query);
                
                if(!$addDistrict){
                    die("QUERY FAILED " . mysqli_error($connection));
                }else{
                    // echo '<script>
                    // alert("District Added Successfully");
                    // </script>';
                }
            }
        }
    }
?>


<!-- Page Content -->

<div id="msg"></div>

<div class="container mt-4">
        <div class="col d-flex justify-content-between align-items-center">
        <h3>District</h3>
            <form action="" method="post" class="d-flex align-items-center">
                <select class="form-control fs-5" name="stateId">
                    <?php
                        $query = "SELECT * FROM state";
                        $viewAllState = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($viewAllState)){
                            $state_id = $row['state_id'];
                            $state_name = $row['state_name'];
                            echo "<option value='$state_id'>$state_name</option>";
                        }
                    ?>
                </select>
                <input class="form-control mx-3 fs-5" type="text" name="districtName" placeholder="Enter District Name" required>
                <button name="addDistrict" class="btn fs-5 btn-primary">Add</button>
            </form>
    </div>
    
    <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
    <div class="tableBody">
            <table class="table fs-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">DISTRICT NAME</th>
                        <th scope="col">STATE NAME</th>
                        <th scope="col" colspan="2">COMMANDS</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php
                $query = "SELECT * FROM district";
                $viewAllDistrict = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($viewAllDistrict)){
                    $district_id = $row['district_id'];
                    $district_name = $row['district_name'];
                    $state_id = $row['state_id'];

                    echo "<tr>";
                    echo "<td>{$district_id}</td>";
                    echo "<td>{$district_name}</td>";

                    $query = "SELECT state_name FROM state WHERE state_id = $state_id";
                    $viewStateName = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($viewStateName)){
                        $state_name = $row['state_name'];
                        echo "<td>{$state_name}</td>";
                    }

                    echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='district.php?districtDelete={$district_id}'>DELETE</a></td>";
                    echo "<td><a class='editBtn controlBtn' href='district.php?districtEdit={$district_id}'>EDIT</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            </table>
    </div>
    </div>
    </div>

    <div class="tableFooter">
        <hr>
        <form action="" method="post">
            <?php
            if(isset($_GET['districtEdit'])){
                $districtId = $_GET['districtEdit'];
                $query = "SELECT * FROM district WHERE district_id = {$districtId}";
                $edit_district = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_district)){
                    $district_id = $row['district_id'];
                    $district_name = $row['district_name'];
                    $stateId = $row['state_id'];
                    ?>

                    <div class="row g-3 justify-content-end align-items-center mt-3 fs-5">
                        <div class="col-auto">
                            <label class="form-label fs-5" for="cat-title">Edit District</label>
                        </div>
                        <div class="col-auto">
                            <select class="form-control fs-5" name="stateId" value>
                                <?php
                                    $query = "SELECT * FROM state";
                                    $viewAllState = mysqli_query($connection,$query);
                                    while($row = mysqli_fetch_assoc($viewAllState)){
                                        $state_id = $row['state_id'];
                                        $state_name = $row['state_name'];
                                        if($state_id == $stateId){
                                            echo "<option value='$state_id' selected>$state_name</option>";
                                        }else
                                        echo "<option value='$state_id'>$state_name</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <input class="form-control fs-5" value="<?php if(isset($district_name)){echo $district_name;} ?>" type="text" name="district_name">
                        </div>
                        <div class="col-auto">
                            <input type="submit" name="update_district" class="btn btn-primary fs-5" value="Update District">
                        </div>
                    </div>

                <?php }
            } 
            ?>

            <?php
            // UPDATE Category
            if(isset($_POST['update_district'])){
                $update_district_name = $_POST['district_name'];
                $update_state_id = $_POST["stateId"];
                $query = "UPDATE district SET district_name = '{$update_district_name}',state_id = '{$update_state_id}' WHERE district_id = {$districtId}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    echo die("Update Query Failed" . mysqli_error($connection));
                }
                header("Location: district.php");
            }
            ?>
        </form>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<?php ob_end_flush();?>