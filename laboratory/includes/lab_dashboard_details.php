
<div class="container">
    <h3>Testing Details</h3>
    <div class="card mt-2 px-3 py-1 shadow">
        <div class="card-body row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Testing Name</th>
                        <th scope="col">Testing Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM labs_testings WHERE lab_id = '{$global_lab_id}'";
                    $allTestings = mysqli_query($connection,$query);
                    if(mysqli_num_rows($allTestings)==0){
                        echo "</tbody></table> <div class='w-100 d-flex align-items-center justify-content-center' style='height:100px;'><div>No Record Found.</div></div>";
                        // echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                    }else{
                        $index = 1;
                        while($row = mysqli_fetch_assoc($allTestings)){
                            $testing_name = $row['testing_name'];
                            $testing_price = $row['testing_price'];
                            ?>
                            
                            <tr>
                                <th scope="row"><?php echo $index;?></th>
                                <td><?php echo $testing_name;?></td>
                                <td><?php echo $testing_price;?></td>
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