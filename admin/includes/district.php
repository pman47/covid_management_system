<?php
ob_start();

    if(isset($_GET["districtDelete"])){
        $districtId = $_GET["districtDelete"];
        $query = "DELETE FROM district WHERE district_id = '{$districtId}'";
        $deleteDistrict = mysqli_query($connection,$query);
        header("Location: pincode.php");
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

<div class="Container">
    <div class="tableHeader">
        <h1 class="page-header">District</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post">
                <select name="stateId">
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
                <input type="text" name="districtName" placeholder="Enter District Name" required>
                <button name="addDistrict" class="Btn"><span>&#43;</span> Add</button>
            </form>
        </div>
    </div>
    
    <div class="tableBody">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DISTRICT NAME</th>
                        <th>STATE NAME</th>
                        <th colspan="2">COMMANDS</th>
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

                    echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='pincode.php?districtDelete={$district_id}'>DELETE</a></td>";
                    echo "<td><a class='editBtn controlBtn' href='pincode.php?districtEdit={$district_id}'>EDIT</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            </table>
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
                    $state_id = $row['state_id'];
                    ?>

                    <div>
                        <label for="cat-title">Edit District</label>
                        <select name="stateId">
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

                        <input value="<?php if(isset($district_name)){echo $district_name;} ?>" type="text" name="district_name">
                    </div>
                    <input type="submit" name="update_district" class="Btn" value="Update District">

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
                header("Location: pincode.php");
            }
            ?>
        </form>
    </div>
</div>

<?php ob_end_flush();?>