<?php
session_start();

$currentPage = 'menu';
$title = "Menu";



?>


<section class="container">

  <?php
  if (isset($_GET['logOut'])) {
    unset($_SESSION[APP_TAG]['connected']);
    session_destroy();
    header('Location: index.php?ctrl=Login&action=index');
    exit;
  }
  ?>

  <div class="justify-content-center mt-5 mb-5">
    <a href="?logOut" method="get" type="button" class="n-btn">
      <i class="fa-solid fa-power-off"></i>
      <p class="align-items-center"> Log Out</p>
    </a>
  </div>

  <!-- BANNER MESSAGE ALERTE -->
  <?php
  if (!empty($_GET['_err'])) {
    $error = htmlspecialchars($_GET['_err']);
    echo "<div class='bg-warning fs-4 text'>{$error}</div>";
  }
  ?>

  <div class="list-group fs-2 text">



    <h1 class='mt-5 mb-5 '>Bienvenue à <?= $_SESSION[APP_TAG]['connected']['user_userFirstname']?> sur la Plateforme de JobDating</h1>
<!--     <h2 class='mt-5 mb-5 '>Bonjour <?= $_SESSION[APP_TAG]['connected']['user_userFirstname'] . "  " . $_SESSION[APP_TAG]['connected']['user_userlastname'] ?></h2> -->


    <!-- BOUTON PROFIL -->
    <?php
    if (
      isset($_SESSION[APP_TAG]['connected']['user_userStatus']) 
    ):
      // Assign the correct href based on the user status
      $href = $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant'
        ? 'index.php?ctrl=User&action=indexEtudiantProfile&id=' . $_SESSION[APP_TAG]['connected']['user_userId']
        : 'index.php?ctrl=User&action=indexEntrepriseProfile&id=' . $_SESSION[APP_TAG]['connected']['user_userId'];

      $href = ($_SESSION[APP_TAG]['connected']['user_userStatus']  === 'Etudiant' || $_SESSION[APP_TAG]['connected']['user_userStatus']  === 'Administrateur')
        ? 'index.php?ctrl=User&action=indexEtudiantProfile&id=' . $_SESSION[APP_TAG]['connected']['user_userId']
        : 'index.php?ctrl=User&action=indexEntrepriseProfile&id=' . $_SESSION[APP_TAG]['connected']['user_userId'];
    ?>

      <div class="justify-content-center mt-5 mb-5" >
        <a href="<?= htmlspecialchars($href) ?>" method="get" type="button" class="n-btn">
        <i class="fa-regular fa-user"></i>
          <p class="align-items-center">Mon Profil</p>
        </a>
      </div>
    <?php endif; ?>


    <!-- BOUTON LISTE DES ANNONCES -->
    
    
      <div class="justify-content-center mt-5 mb-5">
        <a href="<?= htmlspecialchars('index.php?ctrl=Advert&action=index') ?>" method="get" type="button" class="n-btn">
        <i class="fa-regular fa-address-card"></i>
          <p class="align-items-center">Liste des Annonces</p>
        </a>
      </div>
   
 <!-- BOUTON LISTE DES ETUDIANTS -->

    <?php if (
   
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Administrateur'
    ) : ?>

      <div class="justify-content-center mt-5 mb-5">
        <a href="<?= htmlspecialchars('index.php?ctrl=User&action=indexEtudiantList') ?>" method="get" type="button" class="n-btn">
        <i class="fa-regular fa-address-card"></i>
          <p class="align-items-center">Liste des Etudiants</p>
        </a>
      </div>

    <?php endif ?>


 <!-- BOUTON LISTE DES ENTREPRISES -->

 <?php if (
      
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Administrateur'
    ) : ?>

      <div class="justify-content-center mt-5 mb-5">
        <a href="<?= htmlspecialchars('index.php?ctrl=Firm&action=index') ?>" method="get" type="button" class="n-btn">
        <i class="fa-regular fa-address-card"></i>
          <p class="align-items-center">Liste des Entreprises</p>
        </a>
      </div>

    <?php endif ?>




</section>

<?php




?>