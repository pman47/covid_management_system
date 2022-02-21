<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>


<?php

    if(isset($_GET["pincodeDelete"])){
        $pincode = $_GET["pincodeDelete"];
        $query = "DELETE FROM pincode WHERE pincode = '{$pincode}'";
        $deletepincode = mysqli_query($connection,$query);
        // header("Location: pincode.php");
        echo ("<script>location.href='pincode.php'</script>");
    }

    if(isset($_POST["addArea"])){
        $pincode = $_POST['pincode'];
        $state_id = $_POST['stateId'];
        $district_id = $_POST['districtId'];
        $areaName = $_POST["areaName"];
        $area = trim($areaName," ");
        if($area == '' || empty($area)){
            echo "Empty value can not be added";
        }else{
            $query = "SELECT pincode FROM pincode WHERE pincode = '{$pincode}'";
            
            $checkIfExist=mysqli_query($connection,$query);
            
            if (mysqli_num_rows($checkIfExist) != 0)
            {
                echo '<script>
                alert("Pincode is Already Exist");
                </script>';

            }else{
                $query = "INSERT INTO pincode(pincode,area_name,district_id) VALUES ('{$pincode}','{$areaName}','{$district_id}')";
                $addArea = mysqli_query($connection,$query);
                
                if(!$addArea){
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
<script>
$(document).ready(function() {
	$('#selectedStateId').on('change', function() {
		var state_id = this.value;
		$.ajax({
			url: "./includes/getDistricts.php",
			type: "POST",
			data: {
				state_id: state_id
			},
			cache: false,
			success: function(result){
				$("#districts").html(result);
			}
		});
	});
});
</script>

<div id="msg"></div>

<div class="Container" style="margin-bottom: 150px;">
    <div class="tableHeader">
        <h1 class="page-header">Pincode</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post">

                <input type="number" name="pincode" placeholder="pincode" maxlength="6" required>

                <select name="stateId" id="selectedStateId">
                    <option value="">Select State</option>
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

                <select name="districtId" id="districts">
                    <option value="">Select District</option>
                </select>
                <input type="text" name="areaName" placeholder="Enter Area Name" required>
                <button name="addArea" class="Btn"><span>&#43;</span> Add</button>
            </form>
        </div>
    </div>
    
    <div class="tableBody">
            <table>
                <thead>
                    <tr>
                        <th>PINCODE</th>
                        <th>AREA NAME</th>
                        <th>DISTRICT NAME</th>
                        <th>STATE NAME</th>
                        <th colspan="2">COMMANDS</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php
                    $query = "SELECT * FROM pincode";
                    $viewAllArea = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($viewAllArea)){
                        $pincode = $row['pincode'];
                        $area_name = $row['area_name'];
                        $district_id = $row['district_id'];
                        // $state_id = $row['state_id'];

                        echo "<tr>";
                        echo "<td>{$pincode}</td>";
                        echo "<td>{$area_name}</td>";

                        $state_id = "";
                        $query = "SELECT district_name,state_id FROM district WHERE district_id = $district_id";
                        $viewDistrictName = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($viewDistrictName)){
                            $district_name = $row['district_name'];
                            $state_id = $row['state_id'];
                            echo "<td>{$district_name}</td>";
                        }

                        $query = "SELECT state_name FROM state WHERE state_id = $state_id";
                        $viewStateName = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($viewStateName)){
                            $state_name = $row['state_name'];
                            echo "<td>{$state_name}</td>";
                        }

                        echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='pincode.php?pincodeDelete={$pincode}'>DELETE</a></td>";
                        echo "<td><a class='editBtn controlBtn' href='pincode.php?pincodeEdit={$pincode}'>EDIT</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
    </div>
    <div class="tableFooter">
        <hr>
    </div>

    <div class="tableFooter">
        <hr>
        <form action="" method="post">
            <?php
            if(isset($_GET['pincodeEdit'])){
                $pincode = $_GET['pincodeEdit'];
                $query = "SELECT * FROM pincode WHERE pincode = {$pincode}";
                $edit_pincode = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_pincode)){
                    $area_name = $row['area_name'];
                    $district_id = $row['district_id'];
                    $query = "SELECT district_name,state_id from district where district_id = $district_id";
                    $getDistrict = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($getDistrict)){
                        $district_name = $row['district_name'];
                        $state_id = $row['state_id'];
                    }

                    $query = "SELECT state_name from state where state_id = $state_id";
                    $getState = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($getState)){
                        $state_name = $row['state_name'];
                    }

                    }?>
                    <div class="tableControls">
                        <!-- <input type="text" placeholder="Search"> -->
                        <form action="" method="post">
                            <input type="number" name="updatePincode" placeholder="pincode" value="<?php if(isset($pincode)) echo $pincode;?>" maxlength="6" required>
                            <select name="UpdateStateId" id="updatedStateId">
                                <option value="">Select State</option>
                                <?php
                                    $query = "SELECT * FROM state";
                                    $viewAllState = mysqli_query($connection,$query);
                                    while($row = mysqli_fetch_assoc($viewAllState)){
                                        $id = $row['state_id'];
                                        $name = $row['state_name'];
                                        echo "<option value='$id'";
                                        if($id==$state_id) echo "selected";
                                        echo ">$name</option>";
                                    }
                                ?>
                            </select>

                            <select name="updateDistrictId" id="updatedistricts">
                                <option value="">Select District</option>
                                <?php
                                    $query = "SELECT * FROM district";
                                    $viewAllDistrict = mysqli_query($connection,$query);
                                    while($row = mysqli_fetch_assoc($viewAllDistrict)){
                                        $d_id = $row['district_id'];
                                        $d_name = $row['district_name'];
                                        if($d_id == $district_id){
                                            echo "<option value='$d_id' selected>$d_name</option>";
                                        }else
                                        echo "<option value='$d_id'>$d_name</option>";
                                    }
                                ?>
                            </select>
                            <input type="text" name="areaName" value="<?php if(isset($area_name)) echo $area_name;?>" placeholder="Enter Area Name" required>
                            <button name="addArea" class="Btn"><span>&#43;</span> Add</button>
                        </form>
                    </div>

            <?php } ?>

            <?php
            // UPDATE Category
            if(isset($_POST['update_state'])){
                $update_state_name = $_POST['state_name'];
                $query = "UPDATE state SET state_name = '{$update_state_name}' WHERE state_id = {$stateId}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    echo die("Update Query Failed" . mysqli_error($connection));
                }
                echo ("<script>location.href='state.php'</script>");
            }
            ?>
        </form>
    </div>


</div>

<script>
$(document).ready(function() {
	$('#updatedStateId').on('change', function() {
		var state_id = this.value;
		$.ajax({
			url: "./includes/getDistricts.php",
			type: "POST",
			data: {
				state_id: state_id,
			},
			cache: false,
			success: function(result){
				$("#updatedistricts").html(result);
			}
		});
	});
});
</script>