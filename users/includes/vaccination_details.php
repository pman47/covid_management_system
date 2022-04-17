<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h3>Vaccination Details</h3>
        <?php
            $query = "SELECT * FROM vaccination_requests WHERE user_id = '{$global_user_id}' AND vaccination_status = 'accepted'";
            $temp = mysqli_query($connection,$query);
            $temp1 = mysqli_num_rows($temp);
            if($temp1==0){
                echo "<span class='badge fs-6 p-3 px-5 rounded-pill bg-danger'>Not Vaccinated</span>";
            }else if($temp1==1){
                echo "<span class='badge fs-6 p-3 px-5 rounded-pill bg-warning text-dark'>Partially Vaccinated</span>";
            }else if($temp1==2){
                echo "<span class='badge fs-6 p-3 px-5 rounded-pill bg-success'>Fully Vaccinated</span>";
            }
        ?>
    </div>
    <div class="card mt-2 px-3 py-1 shadow">
        <div class="card-body row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <?php
                            $query = "SELECT * FROM vaccination_requests INNER JOIN vaccination_centres ON vaccination_requests.vc_id = vaccination_centres.vc_id INNER JOIN vaccine_type ON vaccine_type.vaccine_id = vaccination_requests.vaccine_type WHERE dose_no=1 AND user_id = '{$global_user_id}'";
                            $getDose1Details = mysqli_query($connection,$query);
                            $total = mysqli_num_rows($getDose1Details);
                            if($total==0){ ?>
                                <div class="col d-flex">
                                    <h3 class='card-title text-success'>Dose 1</h3>
                                </div>
                                <hr>
                                <div class="col col d-flex justify-content-center align-items-center py-4">
                                    <h3>No Record Found.</h3>
                                </div>
                            <?php }else{

                                while($row = mysqli_fetch_assoc($getDose1Details)){
                                    $dose1_vc_name = $row['vc_name'];
                                    $dose1_vc_address = $row['vc_address'];
                                    $dose1_vaccination_date = $row['vaccination_date'];
                                    $dose1_vaccination_status = $row['vaccination_status'];
                                    $dose1_vaccine_name = $row['vaccine_name'];
                                }
                                ?>
                                <div class="col d-flex">
                                    <h3 class='card-title text-success'>Dose 1</h3>
                                    <?php if($dose1_vaccination_status=="accepted") {?>
                                        <h3 class='card-title text-success'> - Completed</h3>
                                    <?php }else{ ?>
                                        <h3 class='card-title text-danger'> - Pending</h3>
                                    <?php } ?>
                                </div>
                                <div class="col">
                                    <div class="col d-flex justify-content-between">
                                        <h4 class="card-title text-secondary">Date : <?php echo $dose1_vaccination_date;?></h4>
                                        <h4 class="card-title text-secondary">Vaccine : <?php echo $dose1_vaccine_name;?></h4>
                                    </div>
                                    <hr class="mt-0">
                                    <h4 class="card-title text-success"><?php echo $dose1_vc_name;?></h4>
                                    <h5 class="card-title text-secondary"><?php echo $dose1_vc_address;?></h5>
                                </div>

                        <?php } ?>

                    </div>

                    <div class="col">
                        <?php
                            $query = "SELECT * FROM vaccination_requests INNER JOIN vaccination_centres ON vaccination_requests.vc_id = vaccination_centres.vc_id INNER JOIN vaccine_type ON vaccine_type.vaccine_id = vaccination_requests.vaccine_type WHERE dose_no=2 AND user_id = '{$global_user_id}'";
                            $getDose2Details = mysqli_query($connection,$query);
                            $total2 = mysqli_num_rows($getDose2Details);
                            if($total2==0){ ?>
                                <div class="col d-flex">
                                    <h3 class='card-title text-success'>Dose 2</h3>
                                </div>
                                <hr>
                                <div class="col d-flex justify-content-center align-items-center py-4">
                                    <h3>No Record Found.</h3>
                                </div>
                            <?php }else{
                                while($row = mysqli_fetch_assoc($getDose2Details)){
                                    $dose2_vc_name = $row['vc_name'];
                                    $dose2_vc_address = $row['vc_address'];
                                    $dose2_vaccination_date = $row['vaccination_date'];
                                    $dose2_vaccination_status = $row['vaccination_status'];
                                    $dose2_vaccine_name = $row['vaccine_name'];
                                }
                                ?>
                                <div class="col d-flex">
                                    <h3 class='card-title text-success'>Dose 2</h3>
                                    <?php if($dose2_vaccination_status=="accepted") {?>
                                        <h3 class='card-title text-success'> - Completed</h3>
                                    <?php }else{ ?>
                                        <h3 class='card-title text-danger'> - Pending</h3>
                                    <?php } ?>
                                </div>
                                <div class="col">
                                    <div class="col d-flex justify-content-between">
                                        <h4 class="card-title text-secondary">Date : <?php echo $dose2_vaccination_date;?></h4>
                                        <h4 class="card-title text-secondary">Vaccine : <?php echo $dose2_vaccine_name;?></h4>
                                    </div>
                                    <hr class="mt-0">
                                    <h4 class="card-title text-success"><?php echo $dose2_vc_name;?></h4>
                                    <h5 class="card-title text-secondary"><?php echo $dose2_vc_address;?></h5>
                                </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>