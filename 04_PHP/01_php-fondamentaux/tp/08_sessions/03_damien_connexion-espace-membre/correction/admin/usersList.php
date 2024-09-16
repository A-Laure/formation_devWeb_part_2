<?php 

  session_start();

 $title = 'Users List';
 $currentPage = 'users';

 include '../inc/head.php';
 include '../inc/navbar.php';
 include '../lib/_helpers/tools.php';

?>

  <div class="container my-5">

    <h1 class="my-5" >Liste utilisateurs</h1>
    <div class="card p-4 border-0 shadow-sm">
      
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Role</th>
            <th scope="col">email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user) : ?>
          <tr>
            <th scope="row"><?= $user['id'] ?></th>
            <td><?= $user['lastname'] ?></td>
            <td><?= $user['firstname'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
              <a href="userPage.php?id=<?= $user['id'] ?>" class="me-3" ><i class="bi bi-eye-fill"></i></a>
              <a href="userEdit.php?id=<?= $user['id'] ?>" class="me-3" ><i class="bi bi-pencil-square"></i></a>
              <?php if($_SESSION['cem']['connected']['role'] === 'superadmin') : ?>
                <a href="userDelete.php?id=<?= $user['id'] ?>"><i class="bi bi-trash3-fill text-danger"></i></a>
              <?php endif;?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      

    </div>


    <?php debug($_SESSION['cem']['connected']) ?>

  </div>


<?php include '../inc/foot.php'; ?>