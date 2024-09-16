<?php

  // require '../db/data.php';
  require '../lib/utils/functions.php';

  isNotConnected();

  if(isset($_GET['logout'])){
    unset($_SESSION['cem']['connected']);
    session_destroy();
    header('Location: ../login.php');
    exit;
  }

?>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">

  <div class="container-fluid mx-5">

    <a class="navbar-brand fw-bold" href="#">Espace_Admin</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link <?= $currentPage === 'dashboard' ? 'active' : '' ?>" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>


  
       <!-- <?php if($_SESSION['cem']['connected']['user']['role_id'] == 1 || $_SESSION['cem']['connected']['user']['role_id'] == 2) : ?>  -->

          <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'users' ? 'active' : '' ?>" href="usersList.php">Liste utilisateurs</a>
          </li>

        <!-- <?php endif;?> -->

      </ul>

      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle  <?= $currentPage === 'profile' ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= $_SESSION['cem']['connected']['user']['user_name'] ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="profil.php">Mon profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="?logout">Se déconnecter</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>