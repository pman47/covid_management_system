<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php');?>

<?php
if(isset($_POST['sendRequest'])){
    $stock_count_id = $_GET['stock_count_id'];
    $vc_id = $_GET['vc_id'];
    $date = $_GET['date'];
    $vaccine_id = $_GET['vaccine_id'];
    $timeSlotId = $_POST['timeSlots'];
    $current_dose_no = 1;
    $dose1_date;

    $query = "SELECT * FROM vaccination_requests WHERE dose_no='1' AND user_id='{$global_user_id}' AND vaccination_status='pending'";
    $getResult = mysqli_query($connection,$query);
    $count = mysqli_num_rows($getResult);
    if($count == 1){
        echo '<script>
                alert("First Complete Process of Dose 1");
                window.location.href="./";
                </script>';
    }else{

        $query = "SELECT * FROM vaccination_requests WHERE dose_no='1' AND user_id='{$global_user_id}' AND vaccination_status='completed'";
        $getResult = mysqli_query($connection,$query);
        $count = mysqli_num_rows($getResult);
        if($count == 1){
            $current_dose_no = 2;

            $row = mysqli_fetch_assoc($getResult);
            $dose1_date = $row['vaccination_date'];
            $todaysDate = Date("Y-m-d");
            $date1 = new DateTime($todaysDate);
            $date2 = new DateTime($dose1_date);
            $interval = $date1->diff($date2);
            if($interval->days < 84){
                echo '<script>
                    alert("Can not take dose 2 within 84 days");
                    window.location.href="./";
                    </script>';
            }else{
                $query = "SELECT * FROM vaccination_requests WHERE dose_no='2' AND user_id='{$global_user_id}' AND vaccination_status='pending'";
                $getResult = mysqli_query($connection,$query);
                $count = mysqli_num_rows($getResult);
                if($count == 1){
                    echo '<script>
                            alert("First Complete Process of Dose 2");
                            window.location.href="./";
                            </script>';
                }else{

                    $query = "SELECT * FROM vaccination_requests WHERE dose_no='2' AND user_id='{$global_user_id}' AND vaccination_status='completed'";
                    $getResult = mysqli_query($connection,$query);
                    if(mysqli_num_rows($getResult)>=1){
                        echo '<script>
                        alert("You Have Taken Both The Doses Successfully");
                        window.location.href="./";
                        </script>';
                    }else{
                        $query = "INSERT INTO `vaccination_requests`(`vaccination_date`, `dose_no`, `vaccination_status`, `user_id`, `member_id`, `vc_id`, `vaccine_type`, `time_slot`) VALUES ('{$date}','{$current_dose_no}','pending','{$global_user_id}','0','{$vc_id}','{$vaccine_id}','{$timeSlotId}')";
        
                        $insertRow = mysqli_query($connection,$query);
                        if(!$insertRow){
                            die("QUERY FAILED " . mysqli_error($connection));
                        }else{
                            echo '<script>
                            alert("Successfull Registration of Vaccination");
                            window.location.href="./";
                            </script>';
                        }
                    }
                }
            }
        }else{
            $query = "INSERT INTO `vaccination_requests`(`vaccination_date`, `dose_no`, `vaccination_status`, `user_id`, `member_id`, `vc_id`, `vaccine_type`, `time_slot`) VALUES ('{$date}','{$current_dose_no}','pending','{$global_user_id}','0','{$vc_id}','{$vaccine_id}','{$timeSlotId}')";

            $insertRow = mysqli_query($connection,$query);
            if(!$insertRow){
                die("QUERY FAILED " . mysqli_error($connection));
            }else{
                echo '<script>
                alert("Successfull Registration of Vaccination");
                window.location.href="./";
                </script>';
            }
        }

    }

}

if(isset($_GET['stock_count_id'])){
    $date = $_GET['date'];

    $stock_count_id = $_GET['stock_count_id'];
    $query = "SELECT * FROM vaccine_stock INNER JOIN vaccination_centres ON vaccination_centres.vc_id = vaccine_stock.vc_id INNER JOIN pincode ON vaccination_centres.vc_pincode = pincode.pincode INNER JOIN district ON pincode.district_id = district.district_id INNER JOIN vaccine_type ON vaccine_type.vaccine_id = vaccine_stock.vaccine_type WHERE stock_count_id = '{$stock_count_id}'";

    $getDetails = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($getDetails)){
        $vc_name = $row['vc_name'];
        $vc_address = $row['vc_address'];
        $vc_cost_type = $row['vc_cost_type'];
        $vc_pincode = $row['vc_pincode'];
        $area_name = $row['area_name'];
        $district_name = $row['district_name'];
        $vc_id = $row['vc_id'];
        $vaccine_name = $row['vaccine_name'];
        $available_vaccine_stock = $row['available_vaccine_stock'];
        $vaccine_price = $row['vaccine_price'];
        $vaccine_id = $row['vaccine_id'];
    }
}
?>

<div class="container">
    <div class="card mt-2 px-3 py-1 shadow">
        <div class="card-body row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        <?php echo "<h4 class='link-success fs-3 aTagHead'>$vc_name</h4>"; ?>
                    </div>
                    <div class="col">
                        <?php if($vc_cost_type=='free'){ ?>
                            <span class="badge rounded-pill fs-6 bg-primary">Free</span>
                        <?php }else{ ?>
                            <span class="badge rounded-pill fs-6 bg-warning text-dark">Paid</span>
                        <?php } ?>
                    </div>
                </div>
                <h5 class="card-text"><?php echo $vc_address; ?></h5>
                
                <h6 class="card-text">Pincode:
                    <b><?php echo $vc_pincode; ?></b>
                    <?php echo "- ".$area_name.", ".$district_name;?>
                </h6>

                <span class="card-text fs-6">Age Groups : </span>
                <?php
                    $query = "SELECT * FROM vc_age_group INNER JOIN age_group ON vc_age_group.age_group_id = age_group.age_group_id WHERE vc_id = '$vc_id'";
                    $getAgeGroups = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($getAgeGroups)){
                        $age_from = $row['age_from'];
                        $age_to = $row['age_to'];
                        echo "<span class='badge fs-6 bg-secondary mx-1'> " .$age_from . "-" . $age_to . "</span>";
                    }
                ?>
            </div>
            <div class="col-md-4">
                <h5><?php echo $vaccine_name ?></h5>
                <h5>Available Vaccines : <?php echo $available_vaccine_stock ?></h5>
                <?php if($vc_cost_type=='free'){ ?>
                    <h5>Price : None </h5>
                <?php }else{ ?>
                    <h5>Price : <?php echo $vaccine_price ?></h5>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<form action="requestForVaccine.php?stock_count_id=<?php echo $stock_count_id;?>&vc_id=<?php echo $vc_id;?>&vaccine_id=<?php echo $vaccine_id;?>&date=<?php echo $date; ?>" method="post">
<div class="container mt-5">
    <div class="col d-flex justify-content-between">
        <h3>Select Time Slot</h3>
        <input type="submit" name="sendRequest" onClick="javascript: return confirm('Are You Sure?');" class="btn btn-outline-success rounded-pill px-4" value="Register For vaccination"/>
    </div>
    <div class="card mt-2 px-3 py-1 shadow">
        <div class="card-body col">
            
            <?php
                $query = "SELECT * FROM time_slot";
                $getTimeSlots = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($getTimeSlots)){
                    $time_from = $row['time_from'];
                    $time_to = $row['time_to'];
                    $time_slot_id = $row['time_slot_id'];
                    ?>

                    <input type="radio" class="btn-check" name="timeSlots" value="<?php echo $time_slot_id;?>" id="<?php echo $time_slot_id;?>" autocomplete="off">
                    <label class="btn btn-outline-success" for="<?php echo $time_slot_id;?>"><?php echo $time_from . " - " . $time_to; ?></label>

                <?php } ?>
        </div>
    </div>
</div>
</form>