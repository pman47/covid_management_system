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

<div class="container mt-4">
    <div class="col d-flex justify-content-between align-items-center">
        <h3 class="page-header">Time Slots</h3>
        <form action="" method="post" class="d-flex align-items-center">
            <input class="form-control" type="time" name="from" required>
            <input class="form-control mx-2" type="time" name="to" required>
            <button name="addTimeSlot" class="btn btn-primary">Add</button>
        </form>
    </div>
    
    <div class="card mt-2 px-3 py-1 shadow">
    <div class="card-body row">
    <div class="tableBody">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="fs-5">FROM</th>
                        <th scope="col" class="fs-5">TO</th>
                        <th scope="col" colspan="2" class="fs-5">COMMANDS</th>
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
                        echo "<td class='fs-5'>{$time_from}</td>";
                        echo "<td class='fs-5'>{$time_to}</td>";
                        echo "<td class='fs-5'><a class='deleteBtn controlBtn' onClick=\"javascript: return confirm('Are You Sure?');\" href='timeSlot.php?timeSlotDelete={$time_slot_id}'>DELETE</a></td>";
                        echo "<td class='fs-5'><a class='editBtn controlBtn' href='timeSlot.php?timeSlotEdit={$time_slot_id}'>EDIT</a></td>";
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
            if(isset($_GET['timeSlotEdit'])){
                $timeSlotId = $_GET['timeSlotEdit'];
                $query = "SELECT * FROM time_slot WHERE time_slot_id = {$timeSlotId}";
                $edit_time_slot = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($edit_time_slot)){
                    $time_from = $row['time_from'];
                    $time_to = $row['time_to'];
                    ?>

                    <div class="row g-3 justify-content-end align-items-center mt-3 fs-5">
                        <div class="col-auto">
                            <label for="cat-title" class="form-label fs-5">Edit Time Slot</label>
                        </div>
                        <div class="col-auto">
                            <input class="fs-5 form-control" value="<?php if(isset($time_from)){echo $time_from;} ?>" type="time" name="time_from" required>
                        </div>
                        <div class="col-auto">
                            <input class="fs-5 form-control" value="<?php if(isset($time_to)){echo $time_to;} ?>" type="time" name="time_to" required>
                        </div>
                        <div class="col-auto">
                            <input type="submit" name="update_time_slot" class="btn fs-5 btn-primary" value="Update Time Slot">
                        </div>
                    </div>

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