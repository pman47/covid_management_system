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

<div class="container mt-4">
        <div class="col d-flex justify-content-between align-items-center">
        <h1 class="page-header">Pincode</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post" class="d-flex align-items-center">

                <input type="number" class="form-control" name="pincode" placeholder="pincode" maxlength="6" required>

                <select name="stateId" id="selectedStateId" class="form-control mx-3">
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

                <select name="districtId" id="districts" class="form-control">
                    <option value="">Select District</option>
                </select>
                <input type="text" name="areaName" placeholder="Enter Area Name" class="mx-3 form-control" required>
                <button name="addArea" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
    
    <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
    <div class="tableBody">
            <table class="table">
                <thead>
                    <tr>
                        <th class="fs-5">PINCODE</th>
                        <th class="fs-5">AREA NAME</th>
                        <th class="fs-5">DISTRICT NAME</th>
                        <th class="fs-5">STATE NAME</th>
                        <th class="fs-5" colspan="2">COMMANDS</th>
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
                        echo "<td class='fs-5'>{$pincode}</td>";
                        echo "<td class='fs-5'>{$area_name}</td>";

                        $state_id = "";
                        $query = "SELECT district_name,state_id FROM district WHERE district_id = $district_id";
                        $viewDistrictName = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($viewDistrictName)){
                            $district_name = $row['district_name'];
                            $state_id = $row['state_id'];
                            echo "<td class='fs-5'>{$district_name}</td>";
                        }

                        $query = "SELECT state_name FROM state WHERE state_id = $state_id";
                        $viewStateName = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($viewStateName)){
                            $state_name = $row['state_name'];
                            echo "<td class='fs-5'>{$state_name}</td>";
                        }

                        echo "<td class='fs-5'><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='pincode.php?pincodeDelete={$pincode}'>DELETE</a></td>";
                        echo "<td class='fs-5'><a class='editBtn controlBtn' href='pincode.php?pincodeEdit={$pincode}'>EDIT</a></td>";
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
                            <div class="row g-3 justify-content-end align-items-center mt-3 fs-5">
                                <div class="col-auto">
                            <input type="number" class="form-control" name="updatePincode" placeholder="pincode" value="<?php if(isset($pincode)) echo $pincode;?>" maxlength="6" required>
                            </div>
                            <div class="col-auto">
                            <select name="UpdateStateId" id="updatedStateId" class="form-control">
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
                            </div>
                            <div class="col-auto">
                            <select name="updateDistrictId" id="updatedistricts" class="form-control">
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
                                </div>
                                <div class="col-auto">
                                    <input type="text" name="areaName" class="form-control" value="<?php if(isset($area_name)) echo $area_name;?>" placeholder="Enter Area Name" required>
                                </div>
                                <div class="col-auto">
                                    <button name="update_pincode" class="btn btn-primary">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>

            <?php } ?>

            <?php
            // UPDATE Category
            if(isset($_POST['updatePincode'])){
                $update_pincode = $_POST['updatePincode'];
                $update_area_name = $_POST['areaName'];
                $update_district_id = $_POST['updateDistrictId'];

                $query = "UPDATE pincode SET pincode = '{$update_pincode}', area_name = '{$update_area_name}', district_id = '{$update_district_id}' WHERE pincode = {$pincode}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    echo die("Update Query Failed" . mysqli_error($connection));
                }
                echo ("<script>location.href='pincode.php'</script>");
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