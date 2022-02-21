<?php
    if(isset($_GET["vcOpen"])){
        $vc_id = $_GET["vcOpen"];
        $query = "UPDATE vaccination_centres SET vc_status = 'open' WHERE vc_id = {$vc_id}";
        $OpenVc = mysqli_query($connection,$query);
        confirm($OpenVc);
        // echo ("<script>alert('Vaccination Centre Deleted Successfully');</script>");
        echo ("<script>location.href='vc.php'</script>");
    }

    if(isset($_GET["vcClose"])){
        $vc_id = $_GET["vcClose"];
        $query = "UPDATE vaccination_centres SET vc_status = 'close' WHERE vc_id = {$vc_id}";
        $CloseVc = mysqli_query($connection,$query);
        confirm($CloseVc);
        // echo ("<script>alert('Vaccination Centre Deleted Successfully');</script>");
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
                    // $vc_age_group = $row["vc_age_group"];
                    $vc_pincode = $row["vc_pincode"];
                    $vc_status = $row["vc_status"];
                    echo "<div class='card'>";
                        echo "<div class='first-child'>";
                            if($vc_status == 'close'){
                                echo "<div class='vcName close'>$vc_name</div>";
                            }
                            else {
                                echo "<div class='vcName open'>$vc_name</div>";
                            }
                            echo "<div class='vcUsername'>username: $vc_username</div>";
                            echo "<div class='vcAddress'>address: $vc_address</div>";
                        echo "</div>";
                        echo "<div class='second-child'>";
                            echo "<div class='vcPincode'>pincode: $vc_pincode</div>";
                            echo "<div class='vcAgegroup'>age group:-- ";
                            $query = "SELECT * FROM vc_age_group WHERE vc_id = '{$vc_id}' ORDER BY age_group_id";
                            $view_age_group = mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($view_age_group)){
                                $age_group_id = $row["age_group_id"];

                                $query = "SELECT * FROM age_group WHERE age_group_id = '{$age_group_id}'";
                                $view_all_age_group = mysqli_query($connection,$query);
                                while($age_groups=mysqli_fetch_assoc($view_all_age_group)){
                                    $age_from = $age_groups["age_from"];
                                    $age_to = $age_groups["age_to"];
                                }
                                echo "<div>$age_from - $age_to</div>";

                            }
                            echo "</div>";
                            echo "<div class='vcCostType'>cost type: $vc_cost_type</div>";
                            echo "<div class='btnGrp'>";
                                if($vc_status == 'close')
                                    echo "<div><a class='dlt open' onClick=\"javascript: return confirm('Are You Sure?');\" href='vc.php?vcOpen={$vc_id}'>OPEN</a></div>";
                                else
                                    echo "<div><a class='dlt close' onClick=\"javascript: return confirm('Are You Sure?');\" href='vc.php?vcClose={$vc_id}'>CLOSE</a></div>";
                                echo "<div><a class='edit' href='vc.php?source=edit_vc&vc_id={$vc_id}'>EDIT</a></div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
            
        </div>
    </div>
</div>