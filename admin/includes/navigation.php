<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid px-5">
    <a class="navbar-brand fs-2" href="./">ADMIN Panel</a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vaccination Centre
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item fs-5" href="#">View All VAccination Centres</a></li>
            <li><a class="dropdown-item fs-5" href="./vcRequests.php">Vaccination Centre Requests</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Laboratory
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item fs-5" href="./viewAllLaboratory.php">View All Laboratories</a></li>
            <li><a class="dropdown-item fs-5" href="./labRequests.php">Laboratory Requests</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hospital
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item fs-5" href="./viewAllHospital.php">View All Hospitals</a></li>
            <li><a class="dropdown-item fs-5" href="./hospitalRequests.php">Hospitals Requests</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <form class="d-flex">
      <a href="./includes/logout.php" class="btn btn-outline-danger mb-0 fs-4 rounded-pill px-4" type="submit">Logout</a>
    </form>
  </div>
</nav>