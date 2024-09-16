<?php

  require_once 'data/data.php';
  require_once 'functions/_helpers/tools.php';
  require_once 'functions/functions.php';
  include 'inc/head.php';
  include 'inc/navbar.php';

  if(isset($_GET['id']) && !empty($_GET['id'])){
    $userId = $_GET['id'];
  } else {
    // permet de rediriger vers un autre page 
    header('Location: usersList.php');
  }
 

  foreach($users as $user){

    if($user['id'] == $userId){
      $userDisplay = $user;
      break;
    }

  }

?>

<h1 class="display-4 text-center my-5 pt-5" >Profil utilisateur</h1>

<div class="container w-50">
    <div class="card">
      <h5 class="card-header" ><?= $userDisplay['firstname'] ?> <?= $userDisplay['lastname'] ?></h5>
      <div class="card-body">
        <h5 class="card-tilte"><?= $userDisplay['job'] ?></h5>
        <p class="card-text"><?= $userDisplay['email'] ?></p>
      </div>
    </div>
</div>

<?php include 'inc/foot.php'; ?>