<!-- <div class="header">
<a href="./" class="logo">CMS</a>
<div class="menu">
    <a href="./">Home</a>
    <a href="#">Vaccination</a>
    <a href="#">Testing</a>
    <a href="#">Vacancy of Beds</a>
    <a href="login.php?user_role=user" id="loginBtn">Login</a>
    <a href="registration.php" id="loginBtn">Register</a>
</div>
</div> -->

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fs-2" href="./">CMS</a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vaccination
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item fs-5" href="searchForVaccine.php">Search for Vaccination</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Testing
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item fs-5" href="searchForTesting.php">Search for Testings</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vacancy Of Beds
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item fs-5" href="searchForHospital.php">Search for Vacancy of Beds</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION['user_name'];?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item fs-5" href="#">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item fs-5" href="./includes/logout.php">Logout</a>
              </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>