<?php
    if(isset($_GET["hospitalOpen"])){
        $hospital_id = $_GET["hospitalOpen"];
        $query = "UPDATE hospitals SET hospital_status = 'open' WHERE hospital_id = {$hospital_id}";
        $OpenHospital = mysqli_query($connection,$query);
        confirm($OpenHospital);
        // echo ("<script>alert('Vaccination Centre Deleted Successfully');</script>");
        echo ("<script>location.href='hospital.php'</script>");
    }

    if(isset($_GET["hospitalClose"])){
        $hospital_id = $_GET["hospitalClose"];
        $query = "UPDATE hospitals SET hospital_status = 'close' WHERE hospital_id = {$hospital_id}";
        $CloseHospital = mysqli_query($connection,$query);
        confirm($CloseHospital);
        // echo ("<script>alert('Vaccination Centre Deleted Successfully');</script>");
        echo ("<script>location.href='hospital.php'</script>");
    }
?>

<div class="mainContainer">
    <div class="vcContainer">
        <div class="vcHead">
            <h1 class="page-header">Hospitals</h1>
            <a href="hospital.php?source=add_hospital" class="Btn"><span>&#43;</span> Add Hospital</a>
        </div>
        <hr>
        
        <div class="vcBody">
            <?php
                $query = "SELECT * FROM hospitals";
                $view_all_hospital = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($view_all_hospital)){
                    $hospital_id = $row["hospital_id"];
                    $hospital_name = $row["hospital_name"];
                    $hospital_username = $row["hospital_username"];
                    $hospital_address = $row["hospital_address"];
                    $hospital_pincode = $row["hospital_pincode"];
                    $hospital_status = $row["hospital_status"];
                    $hospital_contact_no = $row["contact_no"];
                    echo "<div class='card'>";
                        echo "<div class='first-child'>";
                            if($hospital_status == 'close'){
                                echo "<div class='vcName close'>$hospital_name</div>";
                            }else {
                                echo "<div class='vcName open'>$hospital_name</div>";
                            }
                            echo "<div class='vcUsername'><b>username:</b> $hospital_username</div>";
                            echo "<div class='vcAddress'><b>address:</b> $hospital_address</div>";
                        echo "</div>";
                        echo "<div class='second-child'>";
                            echo "<div class='vcPincode'><b>pincode:</b> $hospital_pincode</div>";
                            echo "<div class='labContactNo'><b>Contact No:</b> $hospital_contact_no</div>";
                            echo "<div class='btnGrp'>";
                                if($hospital_status == 'close')
                                    echo "<div><a class='dlt open' onClick=\"javascript: return confirm('Are You Sure?');\" href='hospital.php?hospitalOpen={$hospital_id}'>OPEN</a></div>";
                                else
                                    echo "<div><a class='dlt close' onClick=\"javascript: return confirm('Are You Sure?');\" href='hospital.php?hospitalClose={$hospital_id}'>CLOSE</a></div>";
                                echo "<div><a class='edit' href='hospital.php?source=edit_hospital&hospital_id={$hospital_id}'>EDIT</a></div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
            
        </div>
    </div>
</div>