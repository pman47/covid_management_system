<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h3>Bed Requests:</h3>
    </div>

    <!-- Testing table -->
    <div class="card px-5 py-3 fs-4 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Hospital Name</th>
                <th scope="col">Ward Name</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM bed_requests INNER JOIN hospitals ON hospitals.hospital_id = bed_requests.hospital_id INNER JOIN ward_details ON ward_details.ward_id = bed_requests.ward_id WHERE user_id = $global_user_id";
                    $getBedRequests = mysqli_query($connection,$query);
                    if(mysqli_num_rows($getBedRequests)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Requests Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row=mysqli_fetch_array($getBedRequests)){
                            $date = $row['request_date'];
                            $hospital_id = $row['hospital_id'];
                            $hospital_name = $row['hospital_name'];
                            $ward_name  = $row['ward_name'];
                            $patient_status = $row['patient_status'];
                            $patient_id = $row['patient_id'];

                            if($patient_status=='accepted'){
                                echo "<tr class='table-success'>";
                            }else if($patient_status=='rejected'){
                                echo "<tr class='table-danger'>";
                            }else{
                                echo "<tr>";
                            }
                            echo "
                                <th scope='row'>$index</th>
                                <td>$date</td>
                                <td>$hospital_name</td>
                                <td>$ward_name</td>
                                <td>$patient_status</td>
                                ";
                            $index++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>