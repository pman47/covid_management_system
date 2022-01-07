<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php

    if(isset($_GET["timeSlotDelete"])){
        $time_slot_id = $_GET["timeSlotDelete"];
        $query = "DELETE FROM time_slot WHERE time_slot_id = '{$time_slot_id}'";
        $deleteTimeSlot = mysqli_query($connection,$query);
        echo ("<script>location.href='timeSlot.php'</script>");
    }

    if(isset($_POST["addTimeSlot"])){
        $time_from = $_POST["from"];
        $time_to = $_POST["to"];
            
        $query = "INSERT INTO time_slot(time_from,time_to) VALUES ('{$time_from}','{$time_to}')";
        $addTimeSlot = mysqli_query($connection,$query);
        
        if(!$addTimeSlot){
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
        <h1 class="page-header">Time Slots</h1>
        <hr>
        <div class="tableControls">
            <!-- <input type="text" placeholder="Search"> -->
            <form action="" method="post">
                <input type="time" name="from" placeholder="From" required>
                <input type="time" name="to" placeholder="To" required>
                <button name="addTimeSlot" class="Btn"><span>&#43;</span> Add</button>
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
                    $query = "SELECT * FROM time_slot";
                    $viewAllTimeSlot = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($viewAllTimeSlot)){
                        $time_slot_id = $row['time_slot_id'];
                        $time_from = $row['time_from'];
                        $time_to = $row['time_to'];
                        echo "<tr>";
                        echo "<td>{$time_from}</td>";
                        echo "<td>{$time_to}</td>";
                        echo "<td><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='timeSlot.php?timeSlotDelete={$time_slot_id}'>DELETE</a></td>";
                        echo "<td><a class='editBtn controlBtn' href='timeSlot.php?timeSlotEdit={$time_slot_id}'>EDIT</a></td>";
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
            if(isset($_GET['timeSlotEdit'])){
                $timeSlotId = $_GET['timeSlotEdit'];
                $query = "SELECT * FROM time_slot WHERE time_slot_id = {$timeSlotId}";
                $edit_time_slot = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_time_slot)){
                    $time_from = $row['time_from'];
                    $time_to = $row['time_to'];
                    ?>

                    <div>
                        <label for="cat-title">Edit Time Slot</label>
                        <input value="<?php if(isset($time_from)){echo $time_from;} ?>" type="time" name="time_from" required>
                        <input value="<?php if(isset($time_to)){echo $time_to;} ?>" type="time" name="time_to" required>
                    </div>
                    <input type="submit" name="update_time_slot" class="Btn" value="Update Time Slot">

                <?php }
            } 
            ?>

            <?php
            // UPDATE Age Group
            if(isset($_POST['update_time_slot'])){
                $update_time_from = $_POST['time_from'];
                $update_time_to = $_POST['time_to'];
                $query = "UPDATE time_slot SET time_from = '{$update_time_from}',time_to = '{$update_time_to}' WHERE time_slot_id = {$timeSlotId}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    echo die("Update Query Failed" . mysqli_error($connection));
                }
                echo ("<script>location.href='timeSlot.php'</script>");
            }
            ?>
        </form>
    </div>
</div>