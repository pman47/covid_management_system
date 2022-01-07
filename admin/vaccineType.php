<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    if(isset($_GET["vaccineTypeDelete"])){
        $vaccine_type_id = $_GET["vaccineTypeDelete"];
        $query = "DELETE FROM vaccine_type WHERE vaccine_id = '{$vaccine_type_id}'";
        $deleteVaccineType = mysqli_query($connection,$query);
        echo ("<script>location.href='vaccineType.php'</script>");
    }

    if(isset($_POST["addVaccineType"])){
        $vaccine_name = $_POST["vaccine_name"];
        $vaccine_price = $_POST["vaccine_price"];
        
        $vaccine = trim($vaccine_name," ");
        if($vaccine == '' || empty($vaccine)){
            echo "Empty value can not be added";
        }else{
            $query = "SELECT vaccine_name FROM vaccine_type WHERE vaccine_name = '{$vaccine_name}'";
            
            $checkIfExist=mysqli_query($connection,$query);
            
            if (mysqli_num_rows($checkIfExist) != 0)
            {
                echo '<script>
                alert("Vaccine is Already Exist");
                </script>';
            }else{
                $query = "INSERT INTO vaccine_type(vaccine_name,vaccine_price) VALUES ('{$vaccine_name}','{$vaccine_price}')";
                $addVaccineType = mysqli_query($connection,$query);
                
                if(!$addVaccineType){
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
        <h1 class="page-header">Vaccine Types</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post">
                <input type="text" name="vaccine_name" placeholder="Vaccine Name" required>
                <input type="number" name="vaccine_price" min="0" max="5000" placeholder="Price" required>
                <button name="addVaccineType" class="Btn"><span>&#43;</span> Add</button>
            </form>
        </div>
    </div>
    
    <div class="tableBody">
            <table>
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>PRICE</th>
                        <th colspan="2">COMMANDS</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php
                    $query = "SELECT * FROM vaccine_type";
                    $viewAllVaccineType = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($viewAllVaccineType)){
                        $vaccine_id = $row['vaccine_id'];
                        $vaccine_name = $row['vaccine_name'];
                        $vaccine_price = $row['vaccine_price'];
                        echo "<tr>";
                        echo "<td>{$vaccine_name}</td>";
                        echo "<td>{$vaccine_price}</td>";
                        echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='vaccineType.php?vaccineTypeDelete={$vaccine_id}'>DELETE</a></td>";
                        echo "<td><a class='editBtn controlBtn' href='vaccineType.php?vaccineTypeEdit={$vaccine_id}'>EDIT</a></td>";
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
            if(isset($_GET['vaccineTypeEdit'])){
                $vaccineId = $_GET['vaccineTypeEdit'];
                $query = "SELECT * FROM vaccine_type WHERE vaccine_id = {$vaccineId}";
                $edit_vaccine_type = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_vaccine_type)){
                    $vaccine_name = $row['vaccine_name'];
                    $vaccine_price = $row['vaccine_price'];
                    ?>

                    <div>
                        <label for="cat-title">Edit Vaccine Type</label>
                        <input value="<?php if(isset($vaccine_name)){echo $vaccine_name;} ?>" type="text" name="vaccine_name" required>
                        <input value="<?php if(isset($vaccine_price)){echo $vaccine_price;} ?>" type="number" max="5000" min="0" name="vaccine_price" required>
                    </div>
                    <input type="submit" name="update_vaccine_type" class="Btn" value="Update Vaccine">

                <?php }
            } 
            ?>

            <?php
            // UPDATE Age Group
            if(isset($_POST['update_vaccine_type'])){
                $update_vaccine_name = $_POST['vaccine_name'];
                $update_vaccine_price = $_POST['vaccine_price'];
                $query = "UPDATE vaccine_type SET vaccine_name = '{$update_vaccine_name}',vaccine_price = '{$update_vaccine_price}' WHERE vaccine_id = {$vaccineId}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    echo die("Update Query Failed" . mysqli_error($connection));
                }
                echo ("<script>location.href='vaccineType.php'</script>");
            }
            ?>
        </form>
    </div>
</div>