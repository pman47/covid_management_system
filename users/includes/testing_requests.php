<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h3>Lab Testing Requests:</h3>
    </div>

    <!-- Testing table -->
    <div class="card px-5 fs-5 py-3 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Laboratory Name</th>
                <th scope="col">Testing Details</th>
                <th scope="col">Total Price</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $query = "SELECT * FROM testing_requests INNER JOIN testing_list ON testing_list.testing_id = testing_requests.testing_id INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_requests.lab_id = $global_lab_id";
                    $query = "SELECT * FROM testing_requests INNER JOIN laboratories ON laboratories.lab_id = testing_requests.lab_id WHERE user_id = $global_user_id";
                    $getTestingRequests = mysqli_query($connection,$query);
                    if(mysqli_num_rows($getTestingRequests)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Requests Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row=mysqli_fetch_array($getTestingRequests)){
                            $date = $row['testing_date'];
                            $testing_status = $row['testing_status'];
                            $lab_name = $row['lab_name'];
                            $testing_id = $row['testing_id'];
                            
                            if($testing_status=='accepted'){
                                echo "<tr class='table-success'>";
                            }else if($testing_status=='rejected'){
                                echo "<tr class='table-danger'>";
                            }else{
                                echo "<tr>";
                            }

                            echo "
                                <th scope='row'>$index</th>
                                <td>$date</td>
                                <td>$lab_name</td>
                                <td>
                            ";

                            $query = "SELECT * FROM testing_list INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_id = '{$testing_id}'";
                            $total_price = 0;
                            $getPrices = mysqli_query($connection,$query);
                            echo "<table class='table'>
                            <thead>
                                <tr>
                                <th scope='col'>Name</th>
                                <th scope='col'>Price</th>
                                </tr>
                            </thead>
                            <tbody>";
                            while($row = mysqli_fetch_array($getPrices)){ ?>
                                <tr>
                                    <th scope='row'><?php echo $row['testing_name'];?></th>
                                    <td><?php echo $row['testing_price'];?></td>
                                </tr>

                            <?php $total_price = $total_price + $row['testing_price'];}
                            echo "</tbody></table></td>
                                <td>$total_price</td>
                                <td>$testing_status</td>";
                            $index++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>