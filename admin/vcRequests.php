<!-- HEADER -->
<?php include('./includes/header.php'); ?>
<!-- HEADER -->

<?php include('./includes/db.php');?>

<!-- NAVIGATION -->
<?php include('./includes/navigation.php'); ?>
<!-- NAVIGATION -->

<?php
    if(isset($_GET['update'])){
        $vc_id = $_GET['update'];
        $query = "UPDATE vaccination_centres SET vc_accepting_status = 'accepted' WHERE vc_id = '{$vc_id}'";
        $updateQuery = mysqli_query($connection,$query);
        if(!$updateQuery){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            window.location.href="vcRequests.php";
            </script>';
        }
    }

    if(isset($_GET['reject'])){
        $vc_id = $_GET['reject'];
        $query = "DELETE FROM vc_age_group WHERE vc_id = $vc_id";
        $deleteAgeGroups = mysqli_query($connection,$query);
        $query = "DELETE FROM vaccination_centres WHERE vc_id = $vc_id";
        $deleteVc = mysqli_query($connection,$query);

        if(!$deleteVc){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            window.location.href="vcRequests.php";
            </script>';
        }
    }
?>

<div class="container">
<?php
    $query = "SELECT * FROM vaccination_centres WHERE vc_accepting_status	= 'pending'";
    $getAllDetails = mysqli_query($connection,$query);
    if(mysqli_num_rows($getAllDetails)==0){
        ?>
        <div class="card mt-4 shadow d-flex align-items-center justify-content-md-center" style="min-height:200px;">
            <h4>No Vaccination Centre Requests Found</h4>
        </div>
        <?php
    }else{
        while($row = mysqli_fetch_assoc($getAllDetails)){
            $vc_name = $row['vc_name'];
            $vc_id = $row['vc_id'];
            $vc_username = $row['vc_username'];
            $vc_address = $row['vc_address'];
            $vc_pincode = $row['vc_pincode'];
            ?>

            <div class="card mt-2 px-3 py-1 shadow">
                    <div class="card-body row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-8">
                                    <?php echo "<a href='viewVcRequest.php?vcid=$vc_id' class='link-secondary fs-3 aTagHead'>$vc_name</a>"; ?>
                                </div>

                                <div class="col-md-4 d-flex justify-content-end">
                                    <a onClick="javascript: return confirm('Are You Sure?');" href="vcRequests.php?update=<?php echo $vc_id; ?>" class="btn btn-outline-primary rounded-pill px-4 mx-3">Accept</a>
                                    <a onClick="javascript: return confirm('Are You Sure?');" href="vcRequests.php?reject=<?php echo $vc_id; ?>" class="btn btn-outline-danger rounded-pill px-4">Reject</a>
                                </div>
                            </div>
                            <h5 class="card-text"><?php echo $vc_address; ?></h5>
                            
                            <h6 class="card-text">Pincode:
                                <b><?php echo $vc_pincode; ?></b>
                            </h6>

                        </div>
                    </div>
                </div>

            <?php
        }
    }
?>
</div>