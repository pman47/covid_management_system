<?php include('./includes/header.php'); ?>
<?php include('./includes/db.php');?>
<?php include('./includes/navigation.php'); ?>

<?php
    if(isset($_POST['requestForTesting'])){
        $date = $_POST['date'];
        $lab_id = $_GET['labid'];
        $user_id = $_SESSION['user_id'];
        echo $date;
        echo $lab_id;
        echo $user_id;
        $query = "INSERT INTO `testing_requests`(`testing_date`, `user_id`, `lab_id`, `testing_status`) VALUES ('{$date}','{$user_id}','{$lab_id}','pending')";
        $registerBase = mysqli_query($connection,$query);
        confirm($registerBase);
        $testing_id = mysqli_insert_id($connection);
        $testingIds = $_POST['testingList'];

        foreach ($testingIds as $LT_id) {
            // $LT_id
            $query = "INSERT INTO `testing_list`(`testing_id`, `LT_id`) VALUES ('{$testing_id}','{$LT_id}')";
            $insertOneRow = mysqli_query($connection,$query);
        }
        if(!$insertOneRow){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            alert("Request Sended Successfully");
            window.location.href="./";
            </script>';
        }
    }
?>

<?php
    $lab_id = $_GET['labid'];
    $query = "SELECT * FROM laboratories INNER JOIN pincode ON laboratories.lab_pincode = pincode.pincode INNER JOIN district ON pincode.district_id = district.district_id WHERE laboratories.lab_id = '{$lab_id}'";
    $getDetails = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($getDetails);
    $lab_name = $row['lab_name'];
    $lab_username = $row['lab_username'];
    $lab_address = $row['lab_address'];
    $contact_no = $row['contact_no'];
    $lab_pincode = $row['lab_pincode'];
    $area_name = $row['area_name'];
    $district_name = $row['district_name'];
    $lab_accepting_status = $row['lab_accepting_status'];
    ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>Laboratory Details</h3>
        </div>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h3 class='card-title text-success'><?php echo $lab_name; ?><small class='text-muted h5'>- <?php echo $lab_username; ?></small></h3>
                        </div>
                        <div class="col">
                            <h5 class="card-text">+91 <?php echo $contact_no; ?></h5>
                        </div>
                    </div>
                    <h5 class="card-text"><?php echo $lab_address; ?></h5>
                    
                    <h6 class="card-text">Pincode:
                        <b><?php echo $lab_pincode; ?></b>
                        <?php echo "- ".$area_name.", ".$district_name;?>
                    </h6>

                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <form method="post" action="requestForTesting.php?labid=<?php echo $lab_id;?>">
            <div class="d-flex justify-content-between">
                <h3>Select Testings</h3>
                <div class="d-flex">
                    <input type="date" class="form-control" name="date" required>
                    <input type="submit" name="requestForTesting" onClick="javascript: return confirm('Are You Sure?');" value="Send Testing Request" class="btn btn-success rounded-pill px-4 mx-3"></label>
                </div>
            </div>
            <div class="card mt-2 px-3 py-1 shadow">
                <div class="card-body row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Testing Name</th>
                                <th scope="col">Testing Price</th>
                                <th scope="col">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM labs_testings WHERE lab_id = '{$lab_id}'";
                            $allTestings = mysqli_query($connection,$query);
                            $index = 1;
                            while($row = mysqli_fetch_assoc($allTestings)){
                                $testing_name = $row['testing_name'];
                                $testing_price = $row['testing_price'];
                                $testing_id = $row['LT_id'];
                                ?>
                                
                                <tr>
                                    <th scope="row"><?php echo $index;?></th>
                                    <td><?php echo $testing_name;?></td>
                                    <td><?php echo $testing_price;?></td>
                                    <td><?php echo "<input type='checkbox' name='testingList[]' value='$testing_id'/>"?></td>
                                </tr>
                                <?php
                                $index++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>