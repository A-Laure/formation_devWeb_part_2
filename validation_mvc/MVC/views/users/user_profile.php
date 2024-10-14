<?php
session_start();

$currentPage = 'yourProfile';
$title = "Votre Profil";

// dump($_SESSION[APP_TAG]['connected'], 'dans user_profile, session CONNECTED');
?>

<h1 class="container text-align-center title">Votre Profil </h1>



<!-- SECTION AVEC USERCONNECTED -->
<section class="container">

  <div class="justify-content-center mt-5 mb-5">
    <a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">
      <i class="fa-solid fa-home"></i>
      <p class="align-items-center"> Menu</p>
    </a>
  </div>

  <div class="formCreate m-t-5">

    <div class="card text-bg-light mb-3" style="max-width: 60rem">

      <div class="card-header fz30-fwb"><?= $_SESSION[APP_TAG]['connected']['user_userFirstname'] . "  " . $_SESSION[APP_TAG]['connected']['user_userlastname'] ?></div>
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

        <?php if ($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant') : ?>
          <p class="">Compétences : </p>
          <ul class="card-text">
            <?php if (!empty($_SESSION[APP_TAG]['connected']['skills'])): ?>
              <?php foreach ($_SESSION[APP_TAG]['connected']['skills'] as $skill): ?>
                <li><?= htmlspecialchars($skill) ?></li>
              <?php endforeach; ?>
            <?php else: ?>
              <li>****</li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>
        <hr>

        <?php if ($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant') : ?>
          <p class="">Réseaux Sociaux : </p>
          <ul class="card-text">
            <?php if (!empty($_SESSION[APP_TAG]['connected']['networks'])): ?>
              <?php foreach ($_SESSION[APP_TAG]['connected']['networks'] as $network): ?>
                <li><?= htmlspecialchars($network) ?></li>
              <?php endforeach; ?>
            <?php else: ?>
              <li>****</li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>
        <hr>

        <p class="">Description : </p>

        <p class="card-text"><?= $_SESSION[APP_TAG]['connected']['user_userTextaera'] ?></p>
        <hr>

        <!-- BUTTON EDIT / DELETE -->

        <div class="d-flex justify-content-center gap-3">
          <a href="index.php?ctrl=User&action=edit&id=<?= $_SESSION[APP_TAG]['connected']['user_userId'] ?>" type=" button" class="n-btn">Modifier</a>
          <a href="index.php?ctrl=User&action=delete&id=<?= $_SESSION[APP_TAG]['connected']['user_userId'] ?>" type=" button" class="btn-delete">Supprimer</a>
        </div>
        <hr>

        <!-- ANNONCE DU USER -->

        <div>
          <p class="">Annonce(s) liée(s) : </p>

          <ul class="card-text">

            <?php if (!empty($_SESSION[APP_TAG]['connected']['adverts'])): ?>
              <?php foreach ($_SESSION[APP_TAG]['connected']['adverts'] as $advert): ?>

                <li><?= htmlspecialchars($advert) ?></li>

              <?php endforeach; ?>
            <?php else: ?>
              <li>****</li>
            <?php endif; ?>
          </ul>


        </div>
      </div>

    </div>

  </div>
</section>