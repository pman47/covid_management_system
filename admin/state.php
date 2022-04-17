<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    if(isset($_GET["stateDelete"])){
        $stateId = $_GET["stateDelete"];
        $query = "DELETE FROM state WHERE state_id = '{$stateId}'";
        $deleteState = mysqli_query($connection,$query);
        header("Location: state.php");
    }

    if(isset($_POST["addState"])){
        $stateName = $_POST["stateName"];
        $state = trim($stateName," ");
        if($state == '' || empty($state)){
            echo "Empty value can not be added";
        }else{
            $query = "SELECT state_name FROM state WHERE state_name = '{$stateName}'";
            
            $checkIfExist=mysqli_query($connection,$query);
            
            if (mysqli_num_rows($checkIfExist) != 0)
            {
                echo '<script>
                alert("State is Already Exist");
                </script>';
            }else{
                $query = "INSERT INTO state(state_name) VALUES ('{$stateName}')";
                $addState = mysqli_query($connection,$query);
                
                if(!$addState){
                    die("QUERY FAILED " . mysqli_error($connection));
                }else{
                    // echo '<script>
                    // alert("State Added Successfully");
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
        <h1 class="page-header">State</h1>
        <form action="" method="post" class="d-flex align-items-center">
            <input class="form-control mx-3" type="text" name="stateName" placeholder="Enter State Name" required>
            <button name="addState" class="btn btn-primary">Add</button>
        </form>
    </div>
    
    <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
    <div class="tableBody">
            <table class="table">
                <thead>
                    <tr>
                        <th class="fs-5" scope="col">ID</th>
                        <th class="fs-5" scope="col">NAME</th>
                        <th class="fs-5" scope="col" colspan="2">COMMANDS</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php
                $query = "SELECT * FROM state";
                $viewAllState = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($viewAllState)){
                    $state_id = $row['state_id'];
                    $state_name = $row['state_name'];
                    echo "<tr>";
                    echo "<td class='fs-5'>{$state_id}</td>";
                    echo "<td class='fs-5'>{$state_name}</td>";
                    echo "<td class='fs-5'><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='state.php?stateDelete={$state_id}'>DELETE</a></td>";
                    echo "<td class='fs-5'><a class='editBtn controlBtn' href='state.php?stateEdit={$state_id}'>EDIT</a></td>";
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
            if(isset($_GET['stateEdit'])){
                $stateId = $_GET['stateEdit'];
                $query = "SELECT * FROM state WHERE state_id = {$stateId}";
                $edit_state = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_state)){
                    $state_id = $row['state_id'];
                    $state_name = $row['state_name'];
                    ?>

                    <div class="row g-3 justify-content-end align-items-center mt-3 fs-5">
                        <div class="col-auto">
                            <label class="fs-5 form-label" for="cat-title">Edit State</label>
                        </div>
                        <div class="col-auto">
                            <input class="fs-5 form-control" value="<?php if(isset($state_name)){echo $state_name;} ?>" type="text" name="state_name">
                        </div>
                        <div class="col-auto">
                            <input type="submit" name="update_state" class="btn btn-primary fs-5" value="Update State">
                        </div>
                    </div>

                <?php }
            } 
            ?>

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
