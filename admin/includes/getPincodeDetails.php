<?php include "db.php"; ?>
<?php
  $pin = $_GET["pin"];

  $query = "SELECT * FROM pincode WHERE pincode LIKE '%$pin%'";

  $viewPincode = mysqli_query($connection,$query);

  echo "<select>";
  while($row = mysqli_fetch_assoc($viewPincode)){
    $pincode = $row['pincode'];
    $area_name = $row['area_name'];

    echo "<option value='{$pincode}'> {$pincode}, {$area_name}</option>";
  }
  echo "</select>";

?>