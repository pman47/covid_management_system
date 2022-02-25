<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./laboratory.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <script src="../bootstrap/js/bootstrap.js"></script>

  <script src="../jquery.min.js"></script>

  <link rel="stylesheet" href="../src/select2/select2.min.css">
  <script src="../src/select2/select2.min.js"></script>

  <title>Laboratory Admin</title>
</head>
<body>
<?php
  session_start();
  if($_SESSION['user_role']!='lab'){
    echo "<script>
            alert('Unauthorized Access');
            window.location.href='../';
          </script>";
  }
  $global_lab_id = $_SESSION['lab_id'];
?>