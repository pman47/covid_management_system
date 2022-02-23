
<?php
    $lab_id = $global_lab_id;
    $query = "SELECT * FROM laboratories WHERE lab_id = $lab_id";
    $get_lab_details = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($get_lab_details)){
        $lab_username = $row['lab_username'];
        $lab_name = $row['lab_name'];
        $lab_address = $row['lab_address'];
        $lab_contact_no = $row['contact_no'];
        $lab_pincode = $row['lab_pincode'];
        $lab_status = $row['lab_status'];
    }
?>

<div class="container">
    <div class="row">
        <?php echo $lab_username; ?>
    </div>
    <div class="row">
        <?php echo $lab_name; ?>
    </div>
    <div class="row">
        <?php echo $lab_address; ?>
    </div>
    <div class="row">
        <?php echo $lab_contact_no; ?>
    </div>
    <div class="row">
        <?php echo $lab_pincode; ?>
    </div>
    <div class="row">
        <?php echo $lab_status; ?>
    </div>
</div>