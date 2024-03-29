<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-1 fs-6" href="index.php">Paul Timothy Leadership</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-70 rounded-0 border-0" type="text" placeholder="Search">
  <button type="submit" class="btn btn-outline-secondary rounded-0 border-0 w-10"><i class="fas fa-search"></i></button>
  <span class="mr-2 d-none d-lg-inline w-20">
    <a href="profile.php" class="text-decoration-none text-white"><?php
      $id = $_SESSION['users']['users_id'];
      $query = "SELECT * FROM admin_registration WHERE id = '$id'" ;
      $query_run = mysqli_query($connection, $query); 
      if($query_run){
          while($row = mysqli_fetch_array($query_run)){
            // display logged in user's
            echo $row['firstname']." ". $row['surname'];
        }
      }
    ?></a> 
  </span>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3 text-warning" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <i class="fas fa-sign-out-alt"></i> Sign Out
      </a>
    </div>
  </div>
</header>


<!-- Sign out Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Confirm sign out</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Do you want to sign out from the admin page?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="logout.php" method="POST">
          <button type="submit" name="logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Sign Out</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register-admin.php">
              <span data-feather="file" class="align-text-bottom"></span>
              Administrator Panel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="events.php">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Events
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="stories.php">
              <span data-feather="users" class="align-text-bottom"></span>
              Stories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="news.php">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              News
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="subscriptions.php">
              <span data-feather="layers" class="align-text-bottom"></span>
              Subsrcriptions
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button>
        </div>
      </div>
