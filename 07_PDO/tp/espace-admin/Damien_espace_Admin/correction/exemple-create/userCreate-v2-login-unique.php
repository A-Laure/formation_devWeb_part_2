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
// Verifie que l'on reçoit bien un POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){

  // On nettoie/sanitize le POST
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

  $login = trim($_POST['login']);
  $pwd = trim($_POST['pwd']);
  $role = filter_var(trim($_POST['role']), FILTER_SANITIZE_NUMBER_INT);


  //Vérification email
  if(empty($email)){
    $email_err = 'Veuillez saisir un email';
  }else{

    $query = 'SELECT use_id FROM user WHERE use_login = :login';

    $pdo = dbConnect();

    if($stmt = $pdo->prepare($query)){

      $stmt->bindParam(':login', $email);
      
      if($stmt->execute()){

        if($stmt->rowCount() === 1){
          $email_err = 'Cet email est dèjà utilisé';
        }
      }

    }
    unset($stmt);
  }


  //Vérification password
  if(empty($pwd)){
    $pwd_err = 'Veuillez saisir un mot de passe';
  }elseif(strlen($pwd) < 8){
    $pwd_err = 'Le mot de passe doit être d\'au moins 8 caractères';
  }

  //Vérification confirm password
  if(empty($confirmPwd)){
    $confirmPwd_err = 'Veuillez confirmer votre mot de passe';
  }elseif($pwd !== $confirmPwd){
    $confirmPwd_err = 'Le mot de passe doit être le même';
  }

  //Vérification role
  if(empty($role)){
    $role_err = 'Veuillez saisir un role';
  }elseif(!ctype_digit($role)){
    $role_err = 'une erreur est survenue';
  }


  try{

    # Connexion a la base 
    $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );
  
    if(hasPower($pdo, (int) $_POST['role'], $_SESSION[APP_TAG]['connected']['rol_pouvoir'])){
    # REQUETE PREPARE | On prepare la requete avant de l'éxécuter

    $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

    if(($request = $pdo->prepare('INSERT INTO user (use_login, use_mdp, use_role) VALUES (:use_login, :use_mdp, :use_role)')) !== false ){
  
        if( ($request->bindValue('use_login', $login)) && 
            ($request->bindValue('use_mdp', $hashedPassword)) && 
            ($request->bindValue('use_role', $role))
        ){
  
          # on execute la requête
          if($request->execute()){
            $msg = '<div class="alert alert-success" role="alert" > Utilisateur ajouté avec succès !</div>'; 
            $request->closeCursor();
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