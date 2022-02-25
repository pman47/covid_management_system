
<div class="container">
    <div class="row">

        <div class="col-7">
            <div class="card p-3">
                <h5 class="mb-0">Bed Requests</h5>
                <hr>
            </div>
        </div>
        <div class="col">
            <div class="card p-3">
                <h5 class="mb-0">Hospital Wards</h5>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Ward Name</th>
                        <th scope="col">Total Beds</th>
                        <th scope="col">Available Beds</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT bed_count.total_beds, bed_count.available_beds, wards.ward_name FROM bed_count INNER JOIN wards ON bed_count.ward_id=wards.ward_id LIMIT 5";
                            $allBedDetails = mysqli_query($connection,$query);
                            if(mysqli_num_rows($allBedDetails)==0){
                                echo "</tbody></table> <div class='w-100 d-flex align-items-center justify-content-center' style='height:100px;'><div>No Record Found.</div></div>";
                                // echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                            }else{
                                while($row=mysqli_fetch_array($allBedDetails)){
                                    $ward_name = $row['ward_name'];
                                    $total_beds = $row['total_beds'];
                                    $available_beds = $row['available_beds'];
                                    echo "
                                        <tr>
                                        <th scope='row'>$ward_name</th>
                                        <td>$total_beds</td>
                                        <td>$available_beds</td>
                                        </tr>
                                    ";
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