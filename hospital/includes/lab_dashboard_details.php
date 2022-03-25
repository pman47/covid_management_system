<div class="container mb-4">
    <div class="row">
        <div class="col">
            <div class="card p-3 shadow">
                <h5 class="mb-0">Doctor Details</h5>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM doctor_details WHERE hospital_id = $global_hospital_id";
                            $doctor_details = mysqli_query($connection,$query);
                            if(mysqli_num_rows($doctor_details)==0){
                                echo "</tbody></table> <div class='w-100 d-flex align-items-center justify-content-center' style='height:100px;'><div>No Record Found.</div></div>";
                                // echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                            }else{
                                $index = 1;
                                while($row=mysqli_fetch_array($doctor_details)){
                                    $doctor_name = $row['doctor_name'];
                                    $doctor_description = $row['doctor_description'];
                                    echo "
                                        <tr>
                                        <th scope='row'>$index</th>
                                        <th scope='row'>$doctor_name</th>
                                        <td>$doctor_description</td>
                                        </tr>
                                    ";
                                    $index++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card p-3 shadow">
                <h5 class="mb-0">Hospital Wards</h5>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ward Name</th>
                        <th scope="col">Total Beds</th>
                        <th scope="col">Available Beds</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM ward_details WHERE hospital_id = $global_hospital_id LIMIT 5";
                            $allBedDetails = mysqli_query($connection,$query);
                            if(mysqli_num_rows($allBedDetails)==0){
                                echo "</tbody></table> <div class='w-100 d-flex align-items-center justify-content-center' style='height:100px;'><div>No Record Found.</div></div>";
                                // echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                            }else{
                                $index=1;
                                while($row=mysqli_fetch_array($allBedDetails)){
                                    $ward_name = $row['ward_name'];
                                    $total_beds = $row['Total_beds'];
                                    $available_beds = $row['Available_beds'];
                                    echo "
                                        <tr>
                                        <th scope='row'>$index</th>
                                        <th scope='row'>$ward_name</th>
                                        <td>$total_beds</td>
                                        <td>$available_beds</td>
                                        </tr>
                                    ";
                                    $index++;
                                }
                                echo "</tbody> </table>";
                                echo "<div class='d-flex justify-content-end'>
                                    <a href='wardDetails.php' class='card-link text-secondary'>View more ...</a>
                                </div>";
                            }
                        ?>

            </div>
        </div>
    </div>
</div>