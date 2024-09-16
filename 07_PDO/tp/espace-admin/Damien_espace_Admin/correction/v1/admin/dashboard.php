<?php 
session_start();
$title = 'Dashboard';
$currentPage = 'dashboard';
require_once 'config/config.php';
require_once 'functions/helpers.php';
require 'inc/head.php';
require 'inc/navbar.php';




?>

<div class="container">
  <h1 class="my-5">Bienvenue <?= $_SESSION[APP_TAG]['connected']['use_login'] ?></h1>
</div>

<?php

  $hash = password_hash('toto', PASSWORD_BCRYPT);
  echo $hash;
  var_dump(password_verify('toto', $hash));

  debug($_SESSION[APP_TAG]['connected']);

  require 'inc/foot.php';

?>
