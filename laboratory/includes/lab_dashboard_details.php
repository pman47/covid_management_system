
<div class="container">
    <div class="row">

        <div class="col-7">
            <div class="card p-3">
                <h5 class="mb-0">Testing Requests</h5>
                <hr>
            </div>
        </div>
        <div class="col">
            <div class="card p-3">
                <h5 class="mb-0">Laboratory Testings</h5>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Testing Name</th>
                        <th scope="col">Testing Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT labs_testings.price, testing_types.tt_name FROM labs_testings INNER JOIN testing_types ON labs_testings.tt_id=testing_types.tt_id LIMIT 5";
                            $allLabTesting = mysqli_query($connection,$query);
                            if(mysqli_num_rows($allLabTesting)==0){
                                echo "</tbody></table> <div class='w-100 d-flex align-items-center justify-content-center' style='height:100px;'><div>No Record Found.</div></div>";
                                // echo "<tr><td colspan='4' class='text-center'>No Record Found.</td></tr>";
                            }else{
                                while($row=mysqli_fetch_array($allLabTesting)){
                                    $price = $row['price'];
                                    $tt_name = $row['tt_name'];
                                    echo "
                                        <tr>
                                        <th scope='row'>$tt_name</th>
                                        <td>$price</td>
                                        </tr>
                                    ";
                                }
                                echo "</tbody> </table>";
                                echo "<div class='d-flex justify-content-end'>
                                    <a href='lab_to_testing.php' class='card-link text-secondary'>View more ...</a>
                                </div>";
                            }
                        ?>

            </div>
        </div>
    </div>
</div>