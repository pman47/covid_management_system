<nav class="navbar navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand mb-0 h1 fs-4" href="./"><?php echo $global_hospital_name;?></a>

    <div class="d-flex">
      <ul class="navbar-nav mx-3">
        <li class="nav-item">
          <a class="nav-link fs-5" href="./wardDetails.php">Ward Details</a>
        </li>
      </ul>
      <ul class="navbar-nav mx-3">
        <li class="nav-item">
          <a class="nav-link fs-5" href="./bedRequests.php">Bed Requests</a>
        </ul>
      </li>
    </div>

    <form class="d-flex">
      <a href="./includes/logout.php" class="btn btn-outline-danger mb-0 fs-5 rounded-pill px-4" type="submit">Logout</a>
    </form>
  </div>
</nav>