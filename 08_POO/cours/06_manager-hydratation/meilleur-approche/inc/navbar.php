<?php 

  // isNotConnected();

  # DECONNEXION 
  if(isset($_GET['logout'])){
    unset($_SESSION[APP_TAG]['connected']);
    header('Location: ../login.php');
    exit;
  }

?>

<nav class="navbar  navbar-expand-lg bg-white border-bottom shadow-sm" data-bs-theme="light">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $currentPage === 'dashboard' ? 'active' : '' ?>"  href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage === 'userList' ? 'active' : '' ?>"  href="userList.php">Users List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage === 'userCreate' ? 'active' : '' ?>"  href="userCreate.php">Add a user</a>
        </li>
        <li class="nav-item">
          <a class="nav-link "  href="?logout">Se déconnecter</a>
        </li>
      
    </div>
  </div>
</nav>
