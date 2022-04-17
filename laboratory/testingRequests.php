<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php'); ?>

<?php
    if(isset($_GET['accept'])){
        $testing_id = $_GET['accept'];
        $query = "UPDATE testing_requests SET testing_status='accepted' WHERE testing_id = $testing_id";
        $accepted = mysqli_query($connection,$query);
        if(!$accepted){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            alert("Request Accepted");
            window.location.href="testingRequests.php";
            </script>';
        }
    }

    if(isset($_GET['reject'])){
        $testing_id = $_GET['reject'];
        $query = "UPDATE testing_requests SET testing_status='rejected' WHERE testing_id = $testing_id";
        $accepted = mysqli_query($connection,$query);
        if(!$accepted){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            alert("Request Rejected");
            window.location.href="testingRequests.php";
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
                <th scope="col">Total Price</th>
                <th scope="col" colspan="2">Commands</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $query = "SELECT * FROM testing_requests INNER JOIN testing_list ON testing_list.testing_id = testing_requests.testing_id INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_requests.lab_id = $global_lab_id";
                    $query = "SELECT * FROM testing_requests INNER JOIN users ON users.user_id = testing_requests.user_id WHERE lab_id = $global_lab_id";
                    $getTestingRequests = mysqli_query($connection,$query);
                    if(mysqli_num_rows($getTestingRequests)==0){
                        echo "<tr><td colspan='4' class='text-center'>No Requests Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row=mysqli_fetch_array($getTestingRequests)){
                            $user_name = $row['user_name'];
                            $testing_id  = $row['testing_id'];
                            $date = $row['testing_date'];
                            $testing_status = $row['testing_status'];
                            $query = "SELECT * FROM testing_list INNER JOIN labs_testings ON labs_testings.LT_id = testing_list.LT_id WHERE testing_id = '{$testing_id}'";
                            $total_price = 0;
                            $getPrices = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_array($getPrices)){
                                $total_price = $total_price + $row['testing_price'];
                            }
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
                                <th scope='row'><a href='viewRequest.php?testing_id=$testing_id' class='link-dark' style='text-decoration:none;'>$user_name</a></th>
                                <td>$total_price</td>";
                                if($testing_status=="pending"){
                                    echo "<td><a href='testingRequests.php?accept=$testing_id' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Accept</a></td>
                                    <td><a href='testingRequests.php?reject=$testing_id' class='card-link text-secondary' onClick=\"javascript: return confirm('Are You Sure?');\">Reject</a></td>
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