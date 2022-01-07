<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    if(isset($_GET["testingTypeDelete"])){
        $tt_id = $_GET["testingTypeDelete"];
        $query = "DELETE FROM testing_types WHERE tt_id = '{$tt_id}'";
        $deleteTestingType = mysqli_query($connection,$query);
        echo ("<script>location.href='testingType.php'</script>");
    }

    if(isset($_POST["addTestingType"])){
        $tt_name = $_POST["testing_name"];
        
        $tt = trim($tt_name," ");
        if($tt == '' || empty($tt)){
            echo "Empty value can not be added";
        }else{
            $query = "SELECT tt_name FROM testing_types WHERE tt_name = '{$tt_name}'";
            
            $checkIfExist=mysqli_query($connection,$query);
            
            if (mysqli_num_rows($checkIfExist) != 0)
            {
                echo '<script>
                alert("Testing Type is Already Exist");
                </script>';
            }else{
                $query = "INSERT INTO testing_types(tt_name) VALUES ('{$tt_name}')";
                $addTestingType = mysqli_query($connection,$query);
                
                if(!$addTestingType){
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
        <h1 class="page-header">Testing Types</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post">
                <input type="text" name="testing_name" placeholder="Testing Name" required>
                <button name="addTestingType" class="Btn"><span>&#43;</span> Add</button>
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
                    $query = "SELECT * FROM testing_types";
                    $viewAllTestingType = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($viewAllTestingType)){
                        $tt_id = $row['tt_id'];
                        $tt_name = $row['tt_name'];
                        echo "<tr>";
                        echo "<td>{$tt_id}</td>";
                        echo "<td>{$tt_name}</td>";
                        echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='testingType.php?testingTypeDelete={$tt_id}'>DELETE</a></td>";
                        echo "<td><a class='editBtn controlBtn' href='testingType.php?testingTypeEdit={$tt_id}'>EDIT</a></td>";
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
            if(isset($_GET['testingTypeEdit'])){
                $ttId = $_GET['testingTypeEdit'];
                $query = "SELECT * FROM testing_types WHERE tt_id = {$ttId}";
                $edit_testing_type = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_testing_type)){
                    $testing_name = $row['tt_name'];
                    ?>

                    <div>
                        <label for="cat-title">Edit Testing Type</label>
                        <input value="<?php if(isset($testing_name)){echo $testing_name;} ?>" type="text" name="testing_name" required>
                    </div>
                    <input type="submit" name="update_testing_type" class="Btn" value="Update Testing">

                <?php }
            } 
            ?>

            <?php
            // UPDATE Age Group
            if(isset($_POST['update_testing_type'])){
                $update_testing_name = $_POST['testing_name'];
                $query = "UPDATE testing_types SET tt_name = '{$update_testing_name}' WHERE tt_id = {$ttId}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    echo die("Update Query Failed" . mysqli_error($connection));
                }
                echo ("<script>location.href='testingType.php'</script>");
            }
            ?>
        </form>
    </div>
</div>