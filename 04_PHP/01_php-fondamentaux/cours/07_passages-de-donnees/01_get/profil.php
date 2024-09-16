<?php

  include 'inc/head.php';
  // include 'inc/navbar.php';

  $users = [

    [
      'id' => 1,
      'prenom' => 'Jean-Pierre',
      'metier'=> 'apprenti papa',
      'hobby' => 'include & require'
    ],

    [
      'id' => 2,
      'prenom' => 'Ken',
      'metier'=> 'Dev',
      'hobby' => 'convertir l\'alphabet en chiffre et vice et versa'
    ],

    [
      'id' => 3,
      'prenom' => 'Régine',
      'metier'=> 'apprenti dev',
      'hobby' => 'happy hour'
    ],


  ];
  

  print_r($_GET);


?>

<div class="row row-cols-1 row-cols-md-3 g-4 mt-5">

  <?php foreach($users as $user) :
    
    if($_GET['id'] == $user['id']) :
    
    ?>
    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title"><?= $user['prenom'] ?></h5>
          <p class="card-text"><?= $user['metier'] ?></p>
          
        </div>
        <div class="card-footer">
          <small class="text-body-secondary"><?= $user['hobby'] ?></small>
        </div>
      </div>
    </div>    
  <?php endif;?>
  <?php endforeach;?>
</div>