<?php
session_start();

$title = "Liste des Users";
$currentPage = "userList";


// dump($_SESSION[APP_TAG]['connected'], 'userConnected');
/*  REMETTRE PAGINATION  */

?>

<h1 class="text-align-center title">Liste des Etudiants</h1>

<div class="d-flex flex-row">
  <a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">
    <i class="fa-solid fa-home"></i>
    <p class="align-items-center"> Menu</p>
  </a>

  <section class="n-container n-d-grid supplierList">

    <!-- CARD USER -->

    <?php if (!empty($userList)) : ?>
      <?php foreach ($userList as $user) : ?>
        <?php if ($user->getUserStatus() === 'Etudiant') : ?>
          <div class=" supplierCard n-col-3">
            <h2><?= $user->getUserFirstName() ?></h2>
            <h2><?= $user->getUserLastName() ?></h2>
            <p><?= $user->getUserEmail() ?></p>
            <p class="fw-bold mt-5">Statut: </p>
            <p><?= $user->getUserStatus() ?></p>

            <!-- SKILLS -->
            <p class="">Compétences : </p>
            <ul class="card-text">
              <?php if (!empty($user->getSkills())): ?>
                <?php foreach ($user->getSkills() as $skill): ?>
                  <li><?= htmlspecialchars($skill) ?></li>
                <?php endforeach; ?>
              <?php else: ?>
                <li>Aucune compétence listée</li>
              <?php endif; ?>
            </ul>
            <hr>

            <!-- NETWORKS -->
            <p class="">Réseaux Sociaux : </p>
            <ul class="card-text">
              <?php if (!empty($user->getNetworks())): ?>
                <?php foreach ($user->getNetworks() as $network): ?>
                  <li><?= htmlspecialchars($network) ?></li>
                <?php endforeach; ?>
              <?php else: ?>
                <li>Aucun réseau social listé</li>
              <?php endif; ?>
            </ul>
            <hr>


            <a href="index.php?ctrl=User&action=edit&id=<?= $user->getUserId() ?>" class="n-btn m-t-2">Modifier</a>
            <a href="index.php?ctrl=User&action=delete&id=<?= $user->getUserId() ?>" class="n-btn m-t-2 bg-danger">Supprimer</a>

          </div>
        <?php endif; ?>

      <?php endforeach ?>

    <?php else : ?>
      <p>No users found.</p>
    <?php endif; ?>
  </section>

  <?php

  ?>