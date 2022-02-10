<?php include "db.php"; ?>
<?php
  $state_id = $_POST["state_id"];

  $query = "SELECT * FROM district WHERE state_id = '$state_id'";

  $viewDistrict = mysqli_query($connection,$query);

  while($row = mysqli_fetch_assoc($viewDistrict)){
    $district_id = $row['district_id'];
    $district_name = $row['district_name'];

    echo "<option value='{$district_id}'>{$district_name}</option>";
  }

?>