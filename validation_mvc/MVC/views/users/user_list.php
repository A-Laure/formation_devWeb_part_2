<?php

$title = "Liste des Users";
$currentPage = "userList";

/*  REMETTRE PAGINATION  */

?>

<h1 class="text-align-center title">Liste des Users</h1>

<div class="n-container text-end pt-5">

   
</div>

<section class="n-container n-d-grid supplierList">

  <!-- CARD USER -->

  <?php if (!empty($userList)) : ?>
  <?php foreach ($userList as $user) : ?>

    <div class=" supplierCard n-col-3">
      <h2><?= $user->getfirstName()?></h2>
      <h2><?= $user->getLastName()?></h2>
      <p><?= $user->getEmail()?></p>
      <p class="fw-bold mt-5">Statut: </p>
      <p><?= $user->getRoleLabel()?></p> 

      <a href="index.php?ctrl=User&action=edit&id=<?=$user->getiduser()?>" class="n-btn m-t-2">Modifier</a>
    </div>

  <?php endforeach ?>

  <?php else : ?>
    <p>No users found.</p>
  <?php endif; ?>
</section>





<?php

?>