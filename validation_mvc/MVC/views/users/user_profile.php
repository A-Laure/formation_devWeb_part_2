<?php
session_start();

$currentPage = 'yourProfile';
$title = "Votre Profil";

dump($_SESSION[APP_TAG]['connected'], 'dans user_profile, session CONNECTED');
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

      <div class="card-header fz30-fwb"><?= $user->getUserFirstName() . "  " . $user->getUserLastName() ?></div>
      <div class="card-header fz20-fwb "><?= $user->getUserStatus() ?></div>
      <div class="card-header fz20-fwb text-capitalize "><?= $user->getUserSpeciality()  ?></div>

      <div class="card-body">

        <p class="card-text"><?= $user->getUserEmail() ?></p>
        <p class="card-text">Secteur : <?= $user->getUserEnvrnt() ?></p>
        <hr>
        <p class="">Adresse : </p>

        <p class="card-text"><?= $user->getUserAdr1() ?></p>
        <p class="card-text"><?= $user->getUserAdr2() ?></p>
        <p class="card-text"><?= $user->getUserCp() . '  ' . $user->getUserTown() ?></p>
        <hr>

        
          <p class="">Compétences : </p>
          <ul class="card-text">
            <?php if (!empty($user->getSkills())): ?>
              <?php foreach ($user->getSkills() as $skill): ?>
                <li><?= htmlspecialchars($skill) ?></li>
              <?php endforeach; ?>
            <?php else: ?>
              <li>****</li>
            <?php endif; ?>
          </ul>
       
        <hr>

    
          <p class="">Réseaux Sociaux : </p>
          <ul class="card-text">
            <?php if (!empty($user->getLinks())): ?>
              <?php foreach ($user->getLinks() as $link): ?>
                <li><?= htmlspecialchars($link) ?></li>
              <?php endforeach; ?>
            <?php else: ?>
              <li>****</li>
            <?php endif; ?>
          </ul>
       
        <hr>

        <p class="">Description : </p>

        <p class="card-text"><?= $user->getUserTextaera() ?></p>
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

            <?php if (!empty($user->getAdverts())): ?>
              <?php foreach ($user->getAdverts() as $advert): ?>

               
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