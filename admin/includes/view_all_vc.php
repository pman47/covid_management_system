
<?php
    if(isset($_GET["vcDelete"])){
        $vc_id = $_GET["vcDelete"];
        $query = "DELETE FROM vaccination_centres WHERE vc_id = '{$vc_id}'";
        $deleteVc = mysqli_query($connection,$query);
        confirm($deleteVc);
        echo ("<script>alert('Vaccination Centre Deleted Successfully');</script>");
        echo ("<script>location.href='vc.php'</script>");
    }
?>

<div class="mainContainer">
    <div class="vcContainer">
        <div class="vcHead">
            <h1 class="page-header">Vaccination Centres</h1>
            <a href="vc.php?source=add_vc" class="Btn"><span>&#43;</span> Add Vaccination Centre</a>
        </div>
        <hr>
        
        <div class="vcBody">
            <?php
                $query = "SELECT * FROM vaccination_centres";
                $view_all_vc = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($view_all_vc)){
                    $vc_id = $row["vc_id"];
                    $vc_name = $row["vc_name"];
                    $vc_username = $row["vc_username"];
                    $vc_address = $row["vc_address"];
                    $vc_cost_type = $row["vc_cost_type"];
                    $vc_age_group = $row["vc_age_group"];
                    $vc_pincode = $row["vc_pincode"];
                    echo "<div class='card'>";
                        echo "<div class='first-child'>";
                            echo "<div class='vcName'>$vc_name</div>";
                            echo "<div class='vcUsername'>username: $vc_username</div>";
                            echo "<div class='vcAddress'>address: $vc_address</div>";
                        echo "</div>";
                        echo "<div class='second-child'>";
                            echo "<div class='vcPincode'>pincode: $vc_pincode</div>";
                            $query = "SELECT * FROM age_group WHERE age_group_id = '{$vc_age_group}'";
                            $view_age_group = mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($view_age_group)){
                                $age_group_from = $row["age_from"];
                                $age_group_to = $row["age_to"];
                            }
                            echo "<div class='vcAgegroup'>age group: $age_group_from - $age_group_to</div>";
                            echo "<div class='vcCostType'>cost type: $vc_cost_type</div>";
                            echo "<div class='btnGrp'>";
                                echo "<div><a class='dlt' onClick=\"javascript: return confirm('Are You Sure?');\" href='vc.php?vcDelete={$vc_id}'>DELETE</a></div>";
                                echo "<div><a class='edit' href='vc.php?source=edit_vc&vc_id={$vc_id}'>EDIT</a></div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
            
        </div>
    </div>
</div>