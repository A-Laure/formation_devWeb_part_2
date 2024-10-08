<?php
session_start();

$currentPage = 'menu';
$title = "Menu";



?>


<section class="container">



<div class="list-group fs-2 text">

<h1 class = 'mt-5 mb-5 '>Accueil</h1>
  

<a href="
  <?php 
  echo ($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant' 
        || 
        $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Admin') ?
        'index.php?ctrl=User&action=indexEtudiantProfile&id=' . $_SESSION[APP_TAG]['connected']['user_userId'] :
        'index.php?ctrl=User&action=indexEntrepriseProfile&id=' . $_SESSION[APP_TAG]['connected']['user_userId'];
  ?>" class="list-group-item list-group-item-action text-primary">Mon Profil</a>


  <a href="#" class="list-group-item list-group-item-action text-primary">Liste des Annonces</a>
  <a href="#" class="list-group-item list-group-item-action text-primary">Liste des étudiants</a>
  <a href="#" class="list-group-item list-group-item-action text-primary">Liste des entreprises</a>
  
</div>


</section>

<?php





?>

