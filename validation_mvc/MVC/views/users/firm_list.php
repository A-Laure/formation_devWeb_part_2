<?php
// dump($firmList, '$firmList, ReadAll Entreprise');

$title = "Liste des Entreprises";
$currentPage = "firmList";

?>

<h1 class="text-align-center title">Liste des Entreprises</h1>




<section class="container">
  <div class="d-flex flex-row">
    <a href="index.php?ctrl=Dashboard&action=menu" class="n-btn">
      <i class="fa-solid fa-home"></i>
      <p class="align-items-center">Menu</p>
    </a>
  </div>

  <!-- CARD-->
  <div class="n-container n-d-grid supplierList">
    <?php if (!empty($firmList)) : ?>
      <?php foreach ($firmList as $firm) : ?>
        <?php if ($firm->getUserStatus() === 'Entreprise') : ?>
          <div class="card text-bg-light mb-3 supplierCard n-col-6" style="max-width: 60rem">
          <div class="card-header fz30-fwb">
  <p><?= htmlspecialchars($firm->getUserStatus() ?? '') ?></p>
</div>

<div class="card-header fz30-fwb">
  <h2><?= htmlspecialchars($firm->getUserFirstName() ?? '') ?> <?= htmlspecialchars($firm->getUserLastName() ?? '') ?></h2>
</div>

<div class="card-header">
  <p><?= htmlspecialchars($firm->getUserEmail() ?? '') ?></p>
</div>

<div class="card-header fz20-fwb">
  <p class="fw-bold">Secteur : <?= htmlspecialchars($firm->getUserEnvrnt() ?? '') ?></p>           
</div>

<div class="card-header fz20-fwb">
  <p class="fw-bold">Description</p>
  <textarea name="textaera" id="textaera" class="form-control" rows="4" readonly><?= htmlspecialchars($firm->getUserTextaera() ?? '') ?></textarea>
</div>

<div class="card-header fz20">
  <p class="fw-bold">Adresse</p>
  <p><?= htmlspecialchars($firm->getUserAdr1() ?? '') ?></p>          
  <p><?= htmlspecialchars($firm->getUserAdr2() ?? '') ?></p>
  <p><?= htmlspecialchars($firm->getUserCP() ?? '') . ' ' . htmlspecialchars($firm->getUserTown() ?? '') ?></p>
</div>
            <div class="card-footer d-flex justify-content-between">
              <a href="index.php?ctrl=User&action=edit&id=<?= $firm->getUserId() ?>" class="n-btn">Modifier</a>
              <a href="index.php?ctrl=User&action=delete&id=<?= $firm->getUserId() ?>" class="n-btn bg-danger">Supprimer</a>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No users found.</p>
    <?php endif; ?>
  </div>
</section>