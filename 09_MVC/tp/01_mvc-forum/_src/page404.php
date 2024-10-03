<?php 

  require_once 'config/config.php';
  require_once 'lib/autoloader.php';
  require_once 'lib/_helpers/tools.php';

  $page = '404';


  require 'templates/head.php';


  ?>
  <div class="section">
    <a href="index.php" class="button is-dark my-5">Retour vers l'accueil</a>
    <p>Erreur 404 données introuvables</p>
  </div>
  
<?php require 'templates/foot.php'; ?>