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

    if(isset($_POST['lablogin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM laboratories WHERE lab_username = '{$username}'";
        $lab_login = mysqli_query($connection,$query);
        confirm($lab_login);
        while($row = mysqli_fetch_array($lab_login)){
            $db_username = $row['lab_username'];
            $db_password = $row['lab_password'];
        }    
        if($username === $db_username && $password === $db_password){
            session_start();
            $_SESSION['user_role'] = "lab";
            header("Location: ./laboratory/");
        }else{
            echo '<script>
            alert("Wrong username or password");
            window.location.href="login.php?user_role=lab";
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

<section class="vh-100" style="background-color: #508bfc;">

<div class="container py-5 vh-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="border-radius: 1rem;">
          <div class="card-body p-5">

            <form action="" method="post">
                
                <?php if($_GET["user_role"] == 'admin'){
                    echo "<h1>Admin Login</h1>";
                } else {
                    echo "<h1>Login</h1>";
                } ?>

                <?php if($_GET["user_role"] == 'admin' || $_GET["user_role"] == 'lab'){ ?>
                <label class="form-label fs-4" for="mobileNo">Username</label>
                <input class="form-control mb-3 fs-4" type="text" name="username" required>
                <?php } ?>
                
                <?php if($_GET["user_role"] == 'user'){ ?>
                    <label class="form-label fs-4" for="mobileNo">Mobile No</label>
                    <input class="form-control mb-3 fs-4" type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" required>
                    <?php } ?>
                
                <label class="form-label fs-4" for="password">Password</label>
                <input class="form-control mb-3 fs-4" type="password" name="password" id="password" required>
                
                <?php
                if(!$loginStatus){
                    echo "<span class='message' style='color:red; margin-left:150px;'>Invalid <b>Password</b></span>";
                }else{
                    echo "<span></span>";
                }
                ?>

            <button type="submit" name="<?php
                if($_GET["user_role"] == 'admin') echo 'adminLogin';
                else if($_GET["user_role"] == 'lab') echo 'lablogin';
                else echo 'userLogin';
                ?>" id="submit" class="btn btn-primary btn-lg btn-block w-100">Login</button>

            </form>
            </div>
        </div>
        </div>
    </div>
</div>
<section>


<!-- Footer -->
<?php include('./includes/footer.php')?>