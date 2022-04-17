<!-- HEADER -->
<?php include('./includes/header.php'); ?>
<!-- HEADER -->

<?php include('./includes/db.php');?>

<!-- NAVIGATION -->
<?php include('./includes/navigation.php'); ?>
<!-- NAVIGATION -->

<?php
    // Pending Vc Requests
    $query = "SELECT * FROM vaccination_centres WHERE vc_accepting_status = 'pending'";
    $result = mysqli_query($connection,$query);
    $pending_vc = mysqli_num_rows($result);

    // Accepted Vc Requests
    $query = "SELECT * FROM vaccination_centres WHERE vc_accepting_status = 'accepted'";
    $result = mysqli_query($connection,$query);
    $accepted_vc = mysqli_num_rows($result);

    // Pending lab Requests
    $query = "SELECT * FROM `laboratories` WHERE lab_accepting_status = 'pending'";
    $result = mysqli_query($connection,$query);
    $pending_lab = mysqli_num_rows($result);

    // Accepted lab Requests
    $query = "SELECT * FROM `laboratories` WHERE lab_accepting_status = 'accepted'";
    $result = mysqli_query($connection,$query);
    $accepted_lab = mysqli_num_rows($result);

    // Pending hospital Requests
    $query = "SELECT * FROM hospitals WHERE hospital_accepting_status = 'pending'";
    $result = mysqli_query($connection,$query);
    $pending_hospital = mysqli_num_rows($result);

    // Accepted hospital Requests
    $query = "SELECT * FROM hospitals WHERE hospital_accepting_status = 'accepted'";
    $result = mysqli_query($connection,$query);
    $accepted_hospital = mysqli_num_rows($result);

    // Pincodes
    $query = "SELECT * FROM pincode";
    $result = mysqli_query($connection,$query);
    $pincodes = mysqli_num_rows($result);

    // Districts
    $query = "SELECT * FROM district";
    $result = mysqli_query($connection,$query);
    $districts = mysqli_num_rows($result);

    // States
    $query = "SELECT * FROM state";
    $result = mysqli_query($connection,$query);
    $states = mysqli_num_rows($result);

?>

<div class="container pt-5 bg-light d-flex align-items-center flex-column"> 
    <div class="d-flex">

        <div class="card mx-4" style="width: 20rem; border-radius : 10px;">
            <h3 class="card-header p-3">Vaccination Centre</h3>
            <div class="card-body p-0 m-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="./viewAllVc.php" class="w-auto text-decoration-none">
                            <div class="fs-4 text-dark">Accepted : </div><b class="fs-4 text-success"><?php echo $accepted_vc; ?></b>
                        </a> 
                    </li>
                    <li class="list-group-item">
                        <a href="./vcRequests.php" class="w-auto text-decoration-none">
                            <div class="fs-4 text-dark">Pending : </div><b class="fs-4 text-danger"><?php echo $pending_vc; ?></b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mx-4" style="width: 20rem; border-radius : 10px;">
            <h3 class="card-header p-3">Laboratories</h3>
            <div class="card-body p-0 m-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="./viewAllLaboratory.php" class="w-auto text-decoration-none">
                        <div class="fs-4 text-dark">Accepted : </div><b class="fs-4 text-success"><?php echo $accepted_lab; ?></b>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="./labRequests.php" class="w-auto text-decoration-none">
                        <div class="fs-4 text-dark">Pending : </div><b class="fs-4 text-danger"><?php echo $pending_lab; ?></b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mx-4" style="width: 20rem; border-radius : 10px;">
            <h3 class="card-header p-3">Hospitals</h3>
            <div class="card-body p-0 m-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="./viewAllHospital.php" class="w-auto text-decoration-none">
                        <div class="fs-4 text-dark">Accepted : </div><b class="fs-4 text-success"><?php echo $accepted_hospital; ?></b>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="./hospitalRequests.php" class="w-auto text-decoration-none">
                        <div class="fs-4 text-dark">Pending : </div><b class="fs-4 text-danger"><?php echo $pending_hospital; ?></b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="d-flex">
        <a href="./pincode.php" class="m-4 text-decoration-none">
            <div class="card" style="width: 20rem; border-radius : 10px;">
                <h3 class="card-header p-3 text-dark">Pincodes</h3>
                <div class="card-body p-0 m-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><div class="fs-4">Total Pincodes : </div><b class="fs-4 text-success"><?php echo $pincodes; ?></b></li>
                    </ul>
                </div>
            </div>
        </a>

        <a href="./district.php" class="m-4 text-decoration-none">
            <div class="card" style="width: 20rem; border-radius : 10px;">
                <h3 class="card-header p-3 text-dark">Districts</h3>
                <div class="card-body p-0 m-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><div class="fs-4">Total Districts : </div><b class="fs-4 text-success"><?php echo $districts; ?></b></li>
                    </ul>
                </div>
            </div>
        </a>

        <a href="./state.php" class="m-4 text-decoration-none">
            <div class="card" style="width: 20rem; border-radius : 10px;">
                <h3 class="card-header p-3 text-dark">States</h3>
                <div class="card-body p-0 m-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><div class="fs-4">Total States : </div><b class="fs-4 text-success"><?php echo $states; ?></b></li>
                    </ul>
                </div>
            </div>
        </a>

    </div>

    
</div>