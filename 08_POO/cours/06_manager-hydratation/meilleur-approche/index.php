<?php 
  $title = 'Users List';
  $currentPage = 'userList';
  require 'config/config.php';
  require 'functions/autoloader.php';
  require 'functions/_helpers/tools.php';
  // require 'class/CoreModel.php';
  // require 'class/UserModel.php';
  // require 'class/User.php';


  require 'inc/head.php';
  require 'inc/navbar.php';


  $userModel = new UserModel();



  if(!empty($_GET['id']))
  {
    if(ctype_digit($_GET['id']))
    {

      $user = $userModel->readOne($_GET['id']);

?>


  <h1 class="display-1 text-center my-5">utilisateur</h1>
  <div class="container w-50">
  <a href="index.php" class="btn btn-dark mb-3">retour</a>
    <div class="card p-4 border-0 shadow-sm">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <th role="row"><?= $user->getId()?></th>
              <td ><?= $user->getLogin() ?></td>
              <td ><?= $user->getLibelle() ?></td>
              <td>
                <a href="?id=<?= $user->getId()?>" class="me-3"><i class="bi bi-eye-fill"></i></a>
                <a href="userEdit.php?id=<?= $user->getId()?>" class="me-3"><i class="bi bi-pencil-square"></i></a>
                <a href="userDelete.php?id=<?= $user->getId()?>" class="me-3"><i class="bi bi-trash-fill text-danger"></i></a>
              </td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>

<?php

      }
    }
    else 
    {
      $users = $userModel->readAll();
    

?>
<h1 class="display-1 text-center my-5">Liste des utilisateurs</h1>
<div class="container w-50">
  
  <a href="userCreate.php" class="btn btn-primary mb-3">Ajouter un utilisateur</a>
  <div class="card p-4 border-0 shadow-sm">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Login</th>
          <th scope="col">Role</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user) : ?>
          <tr>
            <th role="row"><?= $user->getId()?></th>
            <td ><?= $user->getLogin() ?></td>
            <td ><?= $user->getLibelle() ?></td>
            <td>
              <a href="?id=<?= $user->getId()?>" class="me-3"><i class="bi bi-eye-fill"></i></a>
              <a href="userEdit.php?id=<?= $user->getId()?>" class="me-3"><i class="bi bi-pencil-square"></i></a>
              <a href="userDelete.php?id=<?= $user->getId()?>" class="me-3"><i class="bi bi-trash-fill text-danger"></i></a>
            </td>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>

<?php 

}

?>


<?php require 'inc/foot.php' ?>