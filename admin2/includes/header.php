<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="homepage.css">
  <title>CMS - Admin Panel</title>

  <script src="../jquery.min.js"></script>

  <link rel="stylesheet" href="../src/select2/select2.min.css">
  <script src="../src/select2/select2.min.js"></script>

</head>
<body>
<?php
  session_start();
  if($_SESSION['user_role'] != 'admin'){
    echo '<script>
      alert("Unauthorized Access");
      window.location.href="../";
    </scrip>';
  }
?>