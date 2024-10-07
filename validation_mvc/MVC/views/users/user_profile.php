<?php
session_start();

$currentPage = 'connectedProfile';
$title = "Votre Profil";

// require '../data/data_user.php';
require_once '../../../lib_vendor/utils_functions/db.php';
require '../../../admin/config/config.php'; 
require_once '../../../lib_vendor/helpers_debug/helpers.php';
require_once '../../../lib_vendor/utils_functions/functions.php';
include '../../../inc/navBarBootstrap.php';
include '../../../inc/header.php';
?>

<h1 class="text-align-center title">Votre Profil </h1>

<section class="n-container">

  <div class="formCreate m-t-15">

    <div class="card text-bg-light mb-3" style="max-width: 40rem">

      <div class="card-header fz30-fwb"><?= $_SESSION[APP_TAG]['connected']['user_firstName'] . "  " . $_SESSION[APP_TAG]['connected']['user_lastName']  ?></div>

        <div class="card-body">
          <h5 class="card-title fz20-fwb"><?= 'statut  ' . ($_SESSION[APP_TAG]['connected']['role_label']) ?></h5>
          <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['user_email'] ?></p>
          <div class="d-flex justify-content-center gap-3"  >
            <button type="button" class="n-btn">Modifier</button>
            <button type="button" class="btn-delete">Supprimer</button>
          </div>
        </div>

    </div>

  </div>
</section>


<?php include '../../../inc/footer.php'; ?>