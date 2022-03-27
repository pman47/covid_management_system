
<?php
    if(isset($_POST['addVaccineStock'])){
        $date = $_POST['selectedDate'];
        $vaccine_id = $_POST['selectedVaccineId'];
        $total_stock = $_POST['enteredStock'];
        $vaccine_price = $_POST['enteredPrice'];

        $query="INSERT INTO `vaccine_stock`(`vc_id`, `vaccine_type`, `stock_date`, `total_vaccine_stock`, `available_vaccine_stock`";
        if($vc_cost_type=='paid')
            $query.=",`vaccine_price`";

        $query.=") VALUES ('{$global_vc_id}','{$vaccine_id}','{$date}','{$total_stock}','{$total_stock}'";
        
        if($vc_cost_type=='paid')
            $query.=",'{$vaccine_price}'";

        $query.=")";

        $insertStock = mysqli_query($connection,$query);
        if(!$insertStock){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo "<script>alert('Vaccine Stock Entered Successfully')</script>";
            echo "<script>location.href='./'</script>";
        }
    }
?>
<div class="container">
    <div class="col d-flex justify-content-between">
        <h3>Vaccine Stock Details</h3>
        <a class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add Vacccine Stock</a>
    </div>
    <div class="card mt-2 px-3 py-1 shadow">
        <div class="card-body row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Vaccine Name</th>
                        <th scope="col">Total Vaccine</th>
                        <th scope="col">Available Vaccine</th>
                        <th scope="col">Vaccine Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM vaccine_stock INNER JOIN vaccine_type ON vaccine_type.vaccine_id = vaccine_stock.vaccine_type WHERE vc_id = '{$global_vc_id}'";
                    $allVaccineStock = mysqli_query($connection,$query);
                    if(mysqli_num_rows($allVaccineStock)==0){
                        echo "</tbody></table> <div class='w-100 d-flex align-items-center justify-content-center' style='height:100px;'><div>No Record Found.</div></div>";
                    }else{
                        $index = 1;
                        while($row = mysqli_fetch_assoc($allVaccineStock)){
                            $stock_count_id = $row['stock_count_id'];
                            $vaccine_name = $row['vaccine_name'];
                            $stock_date = $row['stock_date'];
                            $total_vaccine_stock = $row['total_vaccine_stock'];
                            $available_vaccine_stock = $row['available_vaccine_stock'];
                            $vaccine_price = $row['vaccine_price'];
                            ?>
                            
                            <tr>
                                <th scope="row"><?php echo $index;?></th>
                                <td><?php echo $stock_date;?></td>
                                <td><?php echo $vaccine_name;?></td>
                                <td><?php echo $total_vaccine_stock;?></td>
                                <td><?php echo $available_vaccine_stock;?></td>
                                <?php
                                    if($vc_cost_type=='paid'){
                                ?>
                                    <td><?php echo $vaccine_price;?></td>
                                <?php }else{ ?>
                                    <td> -- </td>
                                <?php } ?>
                            </tr>
                        <?php
                        $index++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="" method="post">
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Add Vaccine Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="selectDate" class="form-label">Select Date</label>
                        <input type="date" class="form-control" id="selectDate" name="selectedDate">
                    </div>
                    <div class="mb-3">
                        <label for="selectVaccine" class="form-label">Select Vaccine</label>
                        <select class="form-select" name="selectedVaccineId">
                            <option selected>Select Vaccine</option>
                            <?php
                                $query = "SELECT * FROM vaccine_type";
                                $getVaccineType = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($getVaccineType)){
                                    $vaccine_id = $row['vaccine_id'];
                                    $vaccine_name = $row['vaccine_name'];
                                    echo "<option value='$vaccine_id'>$vaccine_name</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label" for="exampleCheck1">Enter Total Vaccine Stock</label>
                        <input type="number" class="form-control" id="enterStock" name="enteredStock">
                    </div>
                    <?php
                        if($vc_cost_type=='paid'){ ?>

                        <div class="mb-3">
                            <label class="form-check-label" for="exampleCheck1">Enter Price</label>
                            <input type="number" class="form-control" id="enterStock" name="enteredPrice">
                        </div>

                    <?php }
                    ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success rounded-pill px-4" name="addVaccineStock">Add</button>
                </div>
            </div>
        </div>
    </div>
</form>