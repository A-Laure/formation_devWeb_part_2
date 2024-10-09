<?php
session_start();

$currentPage = 'connectedProfile';
$title = "Votre Profil";

dump($_SESSION[APP_TAG]['connected']);
?>

<h1 class="text-align-center title">Votre Profil </h1>

<section class="n-container">

<a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">Menu</a>

  <div class="formCreate m-t-15">

    <div class="card text-bg-light mb-3" style="max-width: 60rem">

      <div class="card-header fz30-fwb"><?= $_SESSION[APP_TAG]['connected']['user_userFirstname'] . "  " . $_SESSION[APP_TAG]['connected']['user_userlastname']?></div>
      <div class="card-header fz20-fwb "><?= $_SESSION[APP_TAG]['connected']['user_userStatus'] ?></div>
      <div class="card-header fz20-fwb text-capitalize "><?= $_SESSION[APP_TAG]['connected']['user_userSpeciality']  ?></div>

      <div class="card-body">

        <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['user_userEmail'] ?></p>
        <p class="card-text">Secteur : <?= $_SESSION[APP_TAG]['connected']['user_userEnvrnt'] ?></p>
        <hr>
        <p class="">Adresse : </p>

        <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['user_userAdr1'] ?></p>
        <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['user_userAdr2'] ?></p>
        <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['user_userCp'] . '  ' . $_SESSION[APP_TAG]['connected']['user_userTown'] ?></p>
        <hr>

        <p class="">Compétences : </p>
        <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['skill_skillLabel'] ?></p>
        <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['netw_networkLabel'] ?></p>
        <hr>
        <p class="">Description : </p>

        <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['user_userTextaera'] ?></p>
        <hr>
        <div class="d-flex justify-content-center gap-3">
          <a href="index.php?ctrl=User&action=edit&id=<?= $_SESSION[APP_TAG]['connected']['user_userId'] ?>" type=" button" class="n-btn">Modifier</a>
          <a href="index.php?ctrl=User&action=delete&id=<?= $_SESSION[APP_TAG]['connected']['user_userId'] ?>" type=" button" class="btn-delete">Supprimer</a>         
        </div>
        <hr>
        <div>
        <p>Mettre les annonces et leur statut</p>
        </div>
      </div>

    </div>

  </div>
</section>