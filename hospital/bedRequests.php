<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
    if(isset($_GET['accept'])){
        $patient_id = $_GET['accept'];
        $query = "UPDATE bed_requests SET patient_status='accepted' WHERE patient_id = $patient_id";
        $accepted = mysqli_query($connection,$query);
        if(!$accepted){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            $query = "SELECT * FROM bed_requests INNER JOIN ward_details ON ward_details.ward_id = bed_requests.ward_id WHERE patient_id = $patient_id";
            $getWardId = mysqli_query($connection,$query);
            while($row = mysqli_fetch_array($getWardId)){
                $ward_id = $row['ward_id'];
                $available_beds = $row['Available_beds'];
            }

            $available_beds-=1;

            $query = "UPDATE ward_details SET Available_beds='{$available_beds}' WHERE ward_id = '{$ward_id}'";
            $updateBed = mysqli_query($connection,$query);
            if(!$updateBed){
                die("QUERY FAILED " . mysqli_error($connection));
            }else{
                echo '<script>
                alert("Request Accepted");
                window.location.href="bedRequests.php";
                </script>';
            }
        }
    }

    if(isset($_GET['reject'])){
        $patient_id = $_GET['reject'];
        $query = "UPDATE bed_requests SET patient_status='rejected' WHERE patient_id = $patient_id";
        $accepted = mysqli_query($connection,$query);
        if(!$accepted){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            alert("Request Rejected");
            window.location.href="bedRequests.php";
            </script>';
        }
    }
?>

<div class="container pt-4">
    <div class="d-flex justify-content-between mb-2">
        <h5>Lab Testing Requests:</h5>
    </div>

    <!-- Testing table -->
    <div class="card px-5 py-3 shadow">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">User Name</th>
                <th scope="col">Ward Name</th>
                <th scope="col" colspan="2">Commands</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM bed_requests INNER JOIN users ON users.user_id = bed_requests.user_id WHERE hospital_id = $global_hospital_id";
                    $getBedRequests = mysqli_query($connection,$query);
                    if(mysqli_num_rows($getBedRequests)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Requests Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row=mysqli_fetch_array($getBedRequests)){
                            $user_name = $row['user_name'];
                            $patient_id  = $row['patient_id'];
                            $date = $row['request_date'];
                            $patient_status = $row['patient_status'];
                            $query = "SELECT * FROM bed_requests INNER JOIN ward_details ON bed_requests.ward_id = ward_details.ward_id WHERE patient_id = '{$patient_id}'";
                            $getWard = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_array($getWard)){
                                $ward_name = $row['ward_name'];
                            }
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
                                <th scope='row'><a href='viewRequest.php?patient_id=$patient_id' class='link-dark' style='text-decoration:none;'>$user_name</a></th>
                                <td>$ward_name</td>";
                                if($patient_status=="pending"){
                                    echo "<td><a href='bedRequests.php?accept=$patient_id' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Accept</a></td>
                                    <td><a href='bedRequests.php?reject=$patient_id' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Reject</a></td>
                                    </tr>
                                    ";
                                }else{
                                    echo "<td>--</td>";
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