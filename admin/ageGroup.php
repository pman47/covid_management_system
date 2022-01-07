<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    if(isset($_GET["ageGroupDelete"])){
        $age_group_id = $_GET["ageGroupDelete"];
        $query = "DELETE FROM age_group WHERE age_group_id = '{$age_group_id}'";
        $deleteState = mysqli_query($connection,$query);
        echo ("<script>location.href='ageGroup.php'</script>");
    }

    if(isset($_POST["addAgeGroup"])){
        $age_from = $_POST["from"];
        $age_to = $_POST["to"];
            
        $query = "INSERT INTO age_group(age_from,age_to) VALUES ('{$age_from}','{$age_to}')";
        $addState = mysqli_query($connection,$query);
        
        if(!$addState){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            // echo '<script>
            // alert("State Added Successfully");
            // </script>';
        }
        
    }
?>


<!-- Page Content -->

<div id="msg"></div>

<div class="Container">
    <div class="tableHeader">
        <h1 class="page-header">Age Group</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post">
                <input type="number" name="from" placeholder="From" min="0" required>
                <input type="number" name="to" placeholder="To" max="120" required>
                <button name="addAgeGroup" class="Btn"><span>&#43;</span> Add</button>
            </form>
        </div>
    </div>
    
    <div class="tableBody">
            <table>
                <thead>
                    <tr>
                        <th>FROM</th>
                        <th>TO</th>
                        <th colspan="2">COMMANDS</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php
                    $query = "SELECT * FROM age_group";
                    $viewAllAgeGroup = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($viewAllAgeGroup)){
                        $age_group_id = $row['age_group_id'];
                        $age_from = $row['age_from'];
                        $age_to = $row['age_to'];
                        echo "<tr>";
                        echo "<td>{$age_from}</td>";
                        echo "<td>{$age_to}</td>";
                        echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='ageGroup.php?ageGroupDelete={$age_group_id}'>DELETE</a></td>";
                        echo "<td><a class='editBtn controlBtn' href='ageGroup.php?ageGroupEdit={$age_group_id}'>EDIT</a></td>";
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
            if(isset($_GET['ageGroupEdit'])){
                $ageGroupId = $_GET['ageGroupEdit'];
                $query = "SELECT * FROM age_group WHERE age_group_id = {$ageGroupId}";
                $edit_age_group = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_age_group)){
                    $age_from = $row['age_from'];
                    $age_to = $row['age_to'];
                    ?>

                    <div>
                        <label for="cat-title">Edit Age Group</label>
                        <input value="<?php if(isset($age_from)){echo $age_from;} ?>" type="number" name="age_from" min="0" required>
                        <input value="<?php if(isset($age_to)){echo $age_to;} ?>" type="number" name="age_to" max="120" required>
                    </div>
                    <input type="submit" name="update_age_group" class="Btn" value="Update Age Group">

                <?php }
            } 
            ?>

            <?php
            // UPDATE Age Group
            if(isset($_POST['update_age_group'])){
                $update_age_from = $_POST['age_from'];
                $update_age_to = $_POST['age_to'];
                $query = "UPDATE age_group SET age_from = '{$update_age_from}',age_to = '{$update_age_to}' WHERE age_group_id = {$ageGroupId}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    echo die("Update Query Failed" . mysqli_error($connection));
                }
                echo ("<script>location.href='ageGroup.php'</script>");
            }
            ?>
        </form>
    </div>
</div>