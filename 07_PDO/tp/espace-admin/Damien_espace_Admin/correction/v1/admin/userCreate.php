<?php
session_start();
$title = 'Add user';
$currentPage = 'userCreate';
require 'config/config.php';
require 'functions/helpers.php';
require 'inc/head.php';
require 'inc/navbar.php';


redirectNotAllowed($_SESSION[APP_TAG]['connected']['autorisations'], 2);



# RECUPERER TOUS LES ROLES POUR LES AFFICHER DANS LE DROPDOWN DU LE FORMULAIRE 
try{

  # Connexion a la base 
  $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );


  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if(($request = $pdo->prepare('SELECT * FROM role WHERE rol_pouvoir >= :rol_pouvoir_user ORDER BY rol_pouvoir')) !== false ){

      if($request->bindValue('rol_pouvoir_user', $_SESSION[APP_TAG]['connected']['rol_pouvoir'])){

        # on execute la requête
        if($request->execute()){
          # On récupère et stocke le jeu de résultats au format tableau associatif
          $roles = $request->fetchAll(PDO::FETCH_ASSOC);

          # on termine le traitement de la requete
          $request->closeCursor();
        }

      }
    }

}catch(PDOException $e){

  die($e->getMessage());

}


# AJOUTER UN UTILISATEUR EN BASE  

if(!empty($_POST['login']) && !empty($_POST['pwd']) && !empty($_POST['role'])){

  try{

    # Connexion a la base 
    $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );
  
    if(hasPower($pdo, (int) $_POST['role'], $_SESSION[APP_TAG]['connected']['rol_pouvoir'])){
    # REQUETE PREPARE | On prepare la requete avant de l'éxécuter

    $hashedPassword = password_hash($_POST['pwd'], PASSWORD_DEFAULT, ['cost'=> 12]);

    if(($request = $pdo->prepare('INSERT INTO user (use_login, use_mdp, use_role) VALUES (:use_login, :use_mdp, :use_role)')) !== false ){
  
        if( ($request->bindValue('use_login', $_POST['login'])) && 
            ($request->bindValue('use_mdp', $hashedPassword)) && 
            ($request->bindValue('use_role', $_POST['role']))
        ){
  
          # on execute la requête
          if($request->execute()){
            $msg = '<div class="alert alert-success" role="alert" > Utilisateur ajouté avec succès !</div>'; 
          }else{
            $msg = '<div class="alert alert-danger" role="alert" > Erreur durant la création !</div>';
          }
  
        }
      }
    }
  }catch(PDOException $e){
  
    die($e->getMessage());
  
  }


}


?>



<h1 class="display-1 text-center my-5">Ajouter un l'utilisateur</h1>
<div class="container w-50">

  <?php 
    if(isset($msg)){
      echo $msg;
    }
  ?>

  <div class="card p-4 border-0 shadow-sm">

    <form action="" method="post" >

      <div class="mb-3">
          <label for="inputLogin" class="form-label">Login</label>
          <input type="text" name="login" class="form-control" id="inputLogin">
      </div>
      <div class="mb-3">
          <label for="inputPwd" class="form-label">Mot de passe</label>
          <input type="password" name="pwd" class="form-control" id="inputPwd">
      </div>

      <div class="mb-3">

        <label for="roleSelect" class="form-label">Role</label>
        <select name="role" id="roleSelect" class="form-select">
          <?php foreach($roles as $role) : ?>
            <option value="<?= $role['rol_id'] ?>" > <?= $role['rol_libelle'] ?> </option>
          <?php endforeach;?>
        </select>

      </div>

      <button type="submit" class="btn btn-primary">Ajouter</button>

    </form>

  </div>

</div>