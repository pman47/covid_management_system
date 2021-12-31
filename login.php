<!-- Header -->
<?php include('./includes/header.php')?>
<!-- Navigation -->
<?php include('./includes/navigation.php')?>
<!-- DB Connection -->
<?php include('./includes/db.php') ?>

<?php
    $loginStatus = " ";
    if(isset($_POST['login'])){
        $mobileNo = $_POST['mobileNo'];
        $password = $_POST['password'];
        
        $query = "SELECT * FROM users WHERE mobile_no = '{$mobileNo}'";
        $login = mysqli_query($connection,$query);
        confirm($login);

        while($row = mysqli_fetch_array($login)){
            $db_mobileNo = $row['mobile_no'];
            $db_password = $row['password'];
        }

        
        if($mobileNo === $db_mobileNo && $password === $db_password){
            echo '<script>alert("Login SuccessFull");</script>';
            $loginStatus = true;
            // $_SESSION['username'] = $db_username;
            // header("Location: ./");
        }else{
            $loginStatus = false;
        }

    }

?>

<form action="" method="post">
    
    <h1>Login Form</h1>

    <label for="mobileNo">Mobile No</label>
    <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <?php
        if(!$loginStatus){
            echo "<span class='message' style='color:red; margin-left:150px;'>Invalid <b>Mobile Number</b> or <b>Password</b></span>";
        }else{
            echo "<span></span>";
        }
    ?>

    <button type="submit" name="login" id="submit">Login</button>
</form>

<!-- Footer -->
<?php include('./includes/footer.php')?>