<?php

  $title = 'Liste des utilisateurs';
  $currentPage = 'users';

  require_once 'data/data.php';
  require_once 'functions/_helpers/tools.php';
  require_once 'functions/functions.php';
  include 'inc/head.php';
  include 'inc/navbar.php';

?>


<h1 class="display-4 text-center my-5 pt-5" > Liste des utilisateurs</h1>

<div class="container w-75">

  <div class="card p-4 border-0 shadow-sm">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Métier</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user) : ?>
        <tr>
          <th scope="row"><?= $user['id'] ?></th>
          <td><?= $user['lastname'] ?></td>
          <td><?= $user['firstname'] ?></td>
          <td><?= $user['job'] ?></td>
          <td>
            <a href="userPage.php?id=<?= $user['id'] ?>" class="me-3" ><i class="bi bi-eye-fill"></i></a>
            <a href="userEdit.php?id=<?= $user['id'] ?>" class="me-3" ><i class="bi bi-pencil-square"></i></a>
            <a href="userDelete.php?id=<?= $user['id'] ?>"><i class="bi bi-trash3-fill text-danger"></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


  </div>

</div>



<?php include 'inc/foot.php'; ?>