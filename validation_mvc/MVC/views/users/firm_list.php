<?php

$title = "Liste des Users";
$currentPage = "userList";

/*  REMETTRE PAGINATION  */

?>

<h1 class="text-align-center title">Liste des Entreprises</h1>

<div class="n-container text-end pt-5">

   
</div>

<section class="n-container n-d-grid supplierList">

  <!-- CARD USER -->

  <?php if (!empty($userList)) : ?>
  <?php foreach ($userList as $user) : ?>

    <div class=" supplierCard n-col-3">
      <h2><?= $user->getUserFirstName()?></h2>
      <h2><?= $user->getUserLastName()?></h2>
      <p><?= $user->getUserEmail()?></p>
      <p class="fw-bold mt-5">Statut: </p>
      <p><?= $user->getUserStatus()?></p> 

      <a href="index.php?ctrl=User&action=edit&id=<?=$user->getUserId()?>" class="n-btn m-t-2">Modifier</a>
    </div>

  <?php endforeach ?>

  <?php else : ?>
    <p>No users found.</p>
  <?php endif; ?>
</section>





<?php

?>