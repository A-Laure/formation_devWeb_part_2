<?php
session_start(); 

// !PAS BESOIN DU HEADER
// require 'admin/config/config.php';
// include '../lib_vendor/helpers_debug/helpers.php';
// include_once '../lib_vendor/utils_functions/functions.php';



# Verif | si pas de $_SESSION on redirige vers login.php (au cas où kkun essaierait de taper directement ds l'url pour accéder à la partie admin) et avec un code erreur dans l'url pour nous aiguiller
// isNotConnected();

if (isset($_GET['logOut'])) {
  unset($_SESSION[APP_TAG]['connected']);
  session_destroy();
  header('Location: ../log_in/login.php');
  exit;
}

// POUR VERIF SI BIEN RECUPERE DANS LE GET

// $userId = intval($_SESSION['stock']['connected']['userId']);

?>

<nav class="navBar n-d-flex flex-column flex-shrink-0 p-3 text-white " style="width: 280px;">

  <!-- LOGO -->
  <div class=" logo m-b-5">
    <a href="MVC/views/dashboards/dashboard.php"><img src="img/logo.png" alt=""></a>
  </div>


  <!-- MENU -->

  <div class="m-b-nav-menuList p-3">
    <hr>
    <ul class="nav nav-pills flex-column mb-auto fz14-fwb">

      <li class="nav-item">
        <a href="../MVC/views/dashboards/dashboard.php" class=" <?= $currentPage === 't2bord' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="../MVC/views/dashboards/dashboard.php">
            </use>
          </svg>
          Accueil / Tableau de Bord
        </a>
      </li>

      <li class="nav-item"><a href="MVC/views/suppliers/supplier_list.php" class="<?= $currentPage === 'frns' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="MVC/views/suppliers/supplier_list.php"></use>
          </svg>
          Liste Des Fournisseurs
        </a>
      </li>

      <li class="nav-item"><a href="MVC/views/dashboard/toOrder.php" class="<?= $currentPage === 'toOrder' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="MVC/views/dashboard/toOrder.php"></use>
          </svg>
          A Commander
        </a>
      </li>

      <li class="nav-item"><a href="MVC/views/items/item_create.php" class="<?= $currentPage === 'itemCreate' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="MVC/views/items/item_create.php"></use>
          </svg>
          Création d'Articles
        </a>
      </li>

      <li class="nav-item"><a href="MVC/views/suppliers/supplier_create.php" class="<?= $currentPage === 'frnsCreate' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="MVC/views/suppliers/supplier_create.php"></use>
          </svg>
          Création Fournisseurs
        </a>
      </li>

      <li class="nav-item"><a href="MVC/views/users/user_create.php" class="<?= $currentPage === 'userCreate' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="MVC/users/user_create.php"></use>
          </svg>
          Création User
        </a>
      </li>

      <li class="nav-item"><a href="index.php?ctrl=User&action=index" class="<?= $currentPage === 'userList' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
           <!--  <use xlink:href="index.php?ctrl=User&action=index"></use> -->
          </svg>
          Liste Users
        </a>
      </li>

      <li class="nav-item"><a href="MVC/views/log_in/login.php" class="<?= $currentPage === 'connexion' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="MVC/views/log_in/login.php"></use>
          </svg>
          Connexion
        </a>
      </li>

      <li class="nav-item"><a href="MVC/views/stocks/mvt_stock.php" class="<?= $currentPage === '+/-stock' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="MVC/views/log_in/login.php"></use>
          </svg>
          Mouvement Stock
        </a>
      </li>

      <li class="nav-item"><a href="MVC/views/stocks/mvt_stock.php" class="<?= $currentPage === 'tvaCreate' ? 'n-active' : '' ?>">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="MVC/views/tva/tvaCreate"></use>
          </svg>
          Mouvement Stock
        </a>
      </li>

    </ul>

     <!-- LOGOUT A RETIRER -->

     <div class="justify-content-center">
      <a href="?logOut" method="get" class="fz12-fwb ">
        <i class="fa-solid fa-power-off"></i>
        <p class="align-items-center"> Log Out</p>
      </a>
    </div>
  </div>

  <!-- PIED DE NAV -->
  <hr>

  <section class="n-hover navBarFooter">

    <!-- MON NOM -->
    <p class="fz20-fwb userName pt-2"><?=$_SESSION[APP_TAG]['connected']->getFirstName()?></p>

    <!-- ACCES A MON PROFIL -->

    <div class="justify-content-center">
      <a href="MVC/views/users/user_profile.php" class="fz12-fwb">
        <i class="fa-solid fa-circle-user"></i>
        <p class="align-items-center"> Mon Profil</p>
      </a>
    </div>


    <!-- LOGOUT -->

    <div class="justify-content-center">
      <a href="?logOut" method="get" class="fz12-fwb ">
        <i class="fa-solid fa-power-off"></i>
        <p class="align-items-center"> Log Out</p>
      </a>
    </div>

  </section>
</nav>