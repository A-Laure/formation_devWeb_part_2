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

<div class="justify-content-center mt-5">
      <a href="?logOut" method="get" type="button" class="n-btn">
        <i class="fa-solid fa-power-off"></i>
        <p class="align-items-center"> Log Out</p>
      </a>
    </div>

  <div class="list-group fs-2 text">



    <h1 class='mt-5 mb-5 '>Accueil</h1>
    <h2 class='mt-5 mb-5 '>Bonjour <?= $_SESSION[APP_TAG]['connected']['user_userFirstname'] . "  " . $_SESSION[APP_TAG]['connected']['user_userlastname'] ?></h2>


    <a href="
  <?= ($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant'
    ||
    $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Admin') ?
    'index.php?ctrl=User&action=indexEtudiantProfile&id=' . $_SESSION[APP_TAG]['connected']['user_userId'] :
    'index.php?ctrl=User&action=indexEntrepriseProfile&id=' . $_SESSION[APP_TAG]['connected']['user_userId'];
  ?>" class="list-group-item list-group-item-action text-primary">Mon Profil</a>


    <a href="index.php?ctrl=Advert&action=index" class="list-group-item list-group-item-action text-primary">Liste des Annonces</a>

    <?php if (
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant'
      ||
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Administrateur'
    ) : ?> 
      <a href="index.php?ctrl=User&action=indexEtudiantList" class="list-group-item list-group-item-action text-primary">Liste des étudiants</a>
     
    <?php endif ?>




    <?php if ($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Administrateur') : ?> 
      <a href="#" class="list-group-item list-group-item-action text-primary">Liste des entreprises</a>     
    <?php endif ?>

  </div>



</section>

<?php




?>