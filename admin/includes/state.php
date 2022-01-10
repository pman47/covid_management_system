<?php

    if(isset($_GET["stateDelete"])){
        $stateId = $_GET["stateDelete"];
        $query = "DELETE FROM state WHERE state_id = '{$stateId}'";
        $deleteState = mysqli_query($connection,$query);
        header("Location: pincode.php");
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

<div class="Container">
    <div class="tableHeader">
        <h1 class="page-header">State</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post">
                <input type="text" name="stateName" placeholder="Enter State Name" required>
                <button name="addState" class="Btn"><span>&#43;</span> Add</button>
            </form>
        </div>
    </div>
    
    <div class="tableBody">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th colspan="2">COMMANDS</th>
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
                    echo "<td>{$state_id}</td>";
                    echo "<td>{$state_name}</td>";
                    echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='pincode.php?stateDelete={$state_id}'>DELETE</a></td>";
                    echo "<td><a class='editBtn controlBtn' href='pincode.php?stateEdit={$state_id}'>EDIT</a></td>";
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
            if(isset($_GET['stateEdit'])){
                $stateId = $_GET['stateEdit'];
                $query = "SELECT * FROM state WHERE state_id = {$stateId}";
                $edit_state = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_state)){
                    $state_id = $row['state_id'];
                    $state_name = $row['state_name'];
                    ?>

                    <div>
                        <label for="cat-title">Edit State</label>
                        <input value="<?php if(isset($state_name)){echo $state_name;} ?>" type="text" name="state_name">
                    </div>
                    <input type="submit" name="update_state" class="Btn" value="Update State">

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
                echo ("<script>location.href='pincode.php'</script>");
            }
            ?>
        </form>
    </div>
</div>
