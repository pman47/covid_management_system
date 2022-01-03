<!-- Header -->
<?php include('./includes/header.php')?>
<!-- Navigation -->
<?php include('./includes/navigation.php')?>
<!-- DB Connection -->
<?php include('./includes/db.php') ?>

<?php
    $loginStatus = " ";

    if(isset($_POST['adminLogin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM admin WHERE username = '{$username}'";
        $admin_login = mysqli_query($connection,$query);
        confirm($admin_login);
        while($row = mysqli_fetch_array($admin_login)){
            $db_username = $row['username'];
            $db_password = $row['password'];
        }    
        if($username === $db_username && $password === $db_password){
            session_start();
            $_SESSION['user_role'] = "admin";
            header("Location: ./admin/");
        }else{
            echo '<script>
            alert("Wrong username or password");
            window.location.href="login.php?user_role=admin";
            </script>';

            // header("Location: login.php?user_role=admin");
        }
    }

    if(isset($_POST['userLogin'])){ 
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
            session_start();
            $_SESSION['user_role'] = "user";
            $loginStatus = true;
            // $_SESSION['username'] = $db_username;
            // header("Location: ./");
        }else{
            echo '<script>
            alert("Wrong mobile number or password");
            window.location.href="login.php?user_role=user";
            </script>';
        }

    }

?>

<?php $user_role = $_GET['user_role'];?>

<form action="" method="post" style="margin:190px auto;">
    
    <?php if($_GET["user_role"] == 'admin'){
        echo "<h1>Admin Login</h1>";
    } else {
        echo "<h1>Login</h1>";
    } ?>

    <?php if($_GET["user_role"] == 'admin'){ ?>
    <label for="mobileNo">Username</label>
    <input type="text" name="username" required>
    <?php } ?>

    <?php if($_GET["user_role"] == 'user'){ ?>
    <label for="mobileNo">Mobile No</label>
    <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" required>
    <?php } ?>
    
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    
    <?php
        if(!$loginStatus){
            echo "<span class='message' style='color:red; margin-left:150px;'>Invalid <b>Password</b></span>";
        }else{
            echo "<span></span>";
        }
    ?>

    <button type="submit" name="<?php
    if($_GET["user_role"] == 'admin') echo 'adminLogin';
    else echo 'userLogin';
    ?>" id="submit">Login</button>

</form>

<!-- Footer -->
<?php include('./includes/footer.php')?>