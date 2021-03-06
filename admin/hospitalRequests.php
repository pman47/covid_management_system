<!-- HEADER -->
<?php include('./includes/header.php'); ?>
<!-- HEADER -->

<?php include('./includes/db.php');?>

<!-- NAVIGATION -->
<?php include('./includes/navigation.php'); ?>
<!-- NAVIGATION -->

<?php
    if(isset($_GET['update'])){
        $hospital_id = $_GET['update'];
        $query = "UPDATE hospitals SET hospital_accepting_status = 'accepted' WHERE hospital_id = '{$hospital_id}'";
        $updateQuery = mysqli_query($connection,$query);
        if(!$updateQuery){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            window.location.href="hospitalRequests.php";
            </script>';
        }
    }

    if(isset($_GET['reject'])){
        $hospital_id = $_GET['reject'];
        $query = "DELETE FROM ward_details WHERE hospital_id = $hospital_id";
        $deleteWardDetail = mysqli_query($connection,$query);
        $query = "DELETE FROM `doctor_details` WHERE hospital_id = $hospital_id";
        $deleteDectorDetail = mysqli_query($connection,$query);
        $query = "DELETE FROM `hospitals` WHERE hospital_id = $hospital_id";
        $deleteHospital = mysqli_query($connection,$query);

        if(!$deleteHospital){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            window.location.href="hospitalRequests.php";
            </script>';
        }
    }
?>

<div class="container">
<?php
    $query = "SELECT * FROM hospitals WHERE hospital_accepting_status = 'pending'";
    $getAllDetails = mysqli_query($connection,$query);
    if(mysqli_num_rows($getAllDetails)==0){
        ?>
        <div class="card mt-4 shadow d-flex align-items-center justify-content-md-center" style="min-height:200px;">
            <h4>No Hospital Requests Found</h4>
        </div>
        <?php
    }else{
        while($row = mysqli_fetch_assoc($getAllDetails)){
            $hospital_id = $row['hospital_id'];
            $hospital_name = $row['hospital_name'];
            $hospital_username = $row['hospital_username'];
            $hospital_address = $row['hospital_address'];
            $contact_no = $row['contact_no'];
            $hospital_pincode = $row['hospital_pincode'];
            ?>

            <div class="card mt-2 px-3 py-1 shadow">
                    <div class="card-body row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo "<a href='viewHospitalRequest.php?hospitalid=$hospital_id' class='link-secondary fs-3 aTagHead'>$hospital_name</a>"; ?>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="card-text">+91 <?php echo $contact_no; ?></h6>
                                </div>
                                <div class="col-md-3 d-flex justify-content-end">
                                    <a onClick="javascript: return confirm('Are You Sure?');" href="hospitalRequests.php?update=<?php echo $hospital_id; ?>" class="btn btn-outline-primary rounded-pill px-4 mx-3">Accept</a>
                                    <a onClick="javascript: return confirm('Are You Sure?');" href="hospitalRequests.php?reject=<?php echo $hospital_id; ?>" class="btn btn-outline-danger rounded-pill px-4">Reject</a>
                                </div>
                            </div>
                            <h5 class="card-text"><?php echo $hospital_address; ?></h5>
                            
                            <h6 class="card-text">Pincode:
                                <b><?php echo $hospital_pincode; ?></b>
                            </h6>

                        </div>
                    </div>
                </div>

            <?php
        }
    }
?>
</div>