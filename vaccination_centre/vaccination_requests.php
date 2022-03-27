<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
    if(isset($_GET['accept'])){
        $vaccination_id = $_GET['accept'];
        $query = "UPDATE vaccination_requests SET vaccination_status='accepted' WHERE vaccination_id = $vaccination_id";
        $accepted = mysqli_query($connection,$query);
        if(!$accepted){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            alert("Request Accepted");
            window.location.href="vaccination_Requests.php";
            </script>';
        }
    }
?>

<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h5>Vaccination Requests:</h5>
    </div>

    <!-- Testing table -->
    <div class="card px-5 py-3 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">User Name</th>
                <th scope="col">Dose No</th>
                <th scope="col">Vaccine Name</th>
                <th scope="col">Time Slot</th>
                <th scope="col">Vaccination Status</th>
                <th scope="col">Commands</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $query = "SELECT * FROM testing_requests INNER JOIN testing_list ON testing_list.testing_id = testing_requests.testing_id INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_requests.lab_id = $global_lab_id";
                    $query = "SELECT * FROM vaccination_requests INNER JOIN users ON users.user_id = vaccination_requests.user_id INNER JOIN vaccine_type ON vaccine_type.vaccine_id = vaccination_requests.vaccine_type INNER JOIN time_slot ON time_slot.time_slot_id = vaccination_requests.time_slot WHERE vc_id = '{$global_vc_id}'";
                    $getVaccinationRequests = mysqli_query($connection,$query);
                    if(mysqli_num_rows($getVaccinationRequests)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Requests Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row=mysqli_fetch_array($getVaccinationRequests)){
                            $date = $row['vaccination_date'];
                            $user_name = $row['user_name'];
                            $dose_no = $row['dose_no'];
                            $vaccine_name = $row['vaccine_name'];
                            $time_from = $row['time_from'];
                            $time_to = $row['time_to'];
                            $vaccination_status = $row['vaccination_status'];
                            $vaccination_id  = $row['vaccination_id'];

                            if($vaccination_status=='accepted'){
                                echo "<tr class='table-success'>";
                            }else if($vaccination_status=='rejected'){
                                echo "<tr class='table-danger'>";
                            }else{
                                echo "<tr>";
                            }
                            echo "
                                <th scope='row'>$index</th>
                                <td>$date</td>
                                <th scope='row'><a href='viewRequest.php?vaccination_id=$vaccination_id' class='link-dark' style='text-decoration:none;'>$user_name</a></th>
                                <td>$dose_no</td>
                                <td>$vaccine_name</td>
                                <td>$time_from - $time_to</td>
                                <td>$vaccination_status</td>
                                ";
                                
                                if($vaccination_status=="pending"){
                                    echo "<td><a href='vaccination_Requests.php?accept=$vaccination_id' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Accept</a></td>
                                    </tr>
                                    ";
                                }else{
                                    echo "<td>--</td>";
                                }
                            $index++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>