<?php
    if(isset($_GET["labOpen"])){
        $lab_id = $_GET["labOpen"];
        $query = "UPDATE laboratories SET lab_status = 'open' WHERE lab_id = {$lab_id}";
        $OpenLab = mysqli_query($connection,$query);
        confirm($OpenLab);
        // echo ("<script>alert('Vaccination Centre Deleted Successfully');</script>");
        echo ("<script>location.href='laboratory.php'</script>");
    }

    if(isset($_GET["labClose"])){
        $lab_id = $_GET["labClose"];
        $query = "UPDATE laboratories SET lab_status = 'close' WHERE lab_id = {$lab_id}";
        $CloseLab = mysqli_query($connection,$query);
        confirm($CloseLab);
        // echo ("<script>alert('Vaccination Centre Deleted Successfully');</script>");
        echo ("<script>location.href='laboratory.php'</script>");
    }
?>

<div class="mainContainer">
    <div class="vcContainer">
        <div class="vcHead">
            <h1 class="page-header">Laboratories</h1>
            <a href="laboratory.php?source=add_lab" class="Btn"><span>&#43;</span> Add Laboratory</a>
        </div>
        <hr>
        
        <div class="vcBody">
            <?php
                $query = "SELECT * FROM laboratories";
                $view_all_lab = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($view_all_lab)){
                    $lab_id = $row["lab_id"];
                    $lab_name = $row["lab_name"];
                    $lab_username = $row["lab_username"];
                    $lab_address = $row["lab_address"];
                    $lab_pincode = $row["lab_pincode"];
                    $lab_status = $row["lab_status"];
                    $lab_contact_no = $row["contact_no"];
                    echo "<div class='card'>";
                        echo "<div class='first-child'>";
                            if($lab_status == 'close'){
                                echo "<div class='vcName close'>$lab_name</div>";
                            }
                            else {
                                echo "<div class='vcName open'>$lab_name</div>";
                            }
                            echo "<div class='vcUsername'><b>username:</b> $lab_username</div>";
                            echo "<div class='vcAddress'><b>address:</b> $lab_address</div>";
                        echo "</div>";
                        echo "<div class='second-child'>";
                            echo "<div class='vcPincode'><b>pincode:</b> $lab_pincode</div>";
                            echo "<div class='labContactNo'><b>Contact No:</b> $lab_contact_no</div>";
                            echo "<div class='btnGrp'>";
                                if($lab_status == 'close')
                                    echo "<div><a class='dlt open' onClick=\"javascript: return confirm('Are You Sure?');\" href='laboratory.php?labOpen={$lab_id}'>OPEN</a></div>";
                                else
                                    echo "<div><a class='dlt close' onClick=\"javascript: return confirm('Are You Sure?');\" href='laboratory.php?labClose={$lab_id}'>CLOSE</a></div>";
                                echo "<div><a class='edit' href='laboratory.php?source=edit_lab&lab_id={$lab_id}'>EDIT</a></div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
            
        </div>
    </div>
</div>