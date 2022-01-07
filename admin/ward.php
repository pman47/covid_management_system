<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    if(isset($_GET["wardTypeDelete"])){
        $ward_id = $_GET["wardTypeDelete"];
        $query = "DELETE FROM wards WHERE ward_id = '{$ward_id}'";
        $deleteWardType = mysqli_query($connection,$query);
        echo ("<script>location.href='ward.php'</script>");
    }

    if(isset($_POST["addWardType"])){
        $ward_name = $_POST["ward_name"];
        
        $ward = trim($ward_name," ");
        if($ward == '' || empty($ward)){
            echo "Empty value can not be added";
        }else{
            $query = "SELECT ward_name FROM wards WHERE ward_name = '{$ward_name}'";
            
            $checkIfExist=mysqli_query($connection,$query);
            
            if (mysqli_num_rows($checkIfExist) != 0)
            {
                echo '<script>
                alert("This Ward is Already Exist");
                </script>';
            }else{
                $query = "INSERT INTO wards(ward_name) VALUES ('{$ward_name}')";
                $addWardType = mysqli_query($connection,$query);
                
                if(!$addWardType){
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
        <h1 class="page-header">Wards</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post">
                <input type="text" name="ward_name" placeholder="Ward Name" required>
                <button name="addWardType" class="Btn"><span>&#43;</span> Add</button>
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
                    $query = "SELECT * FROM wards";
                    $viewAllTestingType = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($viewAllTestingType)){
                        $ward_id = $row['ward_id'];
                        $ward_name = $row['ward_name'];
                        echo "<tr>";
                        echo "<td>{$ward_id}</td>";
                        echo "<td>{$ward_name}</td>";
                        echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='ward.php?wardTypeDelete={$ward_id}'>DELETE</a></td>";
                        echo "<td><a class='editBtn controlBtn' href='ward.php?wardTypeEdit={$ward_id}'>EDIT</a></td>";
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
            if(isset($_GET['wardTypeEdit'])){
                $wardId = $_GET['wardTypeEdit'];
                $query = "SELECT * FROM wards WHERE ward_id = {$wardId}";
                $edit_ward_type = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_ward_type)){
                    $ward_name = $row['ward_name'];
                    ?>

                    <div>
                        <label for="cat-title">Edit Ward</label>
                        <input value="<?php if(isset($ward_name)){echo $ward_name;} ?>" type="text" name="ward_name" required>
                    </div>
                    <input type="submit" name="update_ward_type" class="Btn" value="Update Ward Name">

                <?php }
            } 
            ?>

            <?php
            // UPDATE Age Group
            if(isset($_POST['update_ward_type'])){
                $update_ward_name = $_POST['ward_name'];
                $query = "UPDATE wards SET ward_name = '{$update_ward_name}' WHERE ward_id = {$wardId}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    echo die("Update Query Failed" . mysqli_error($connection));
                }
                echo ("<script>location.href='ward.php'</script>");
            }
            ?>
        </form>
    </div>
</div>