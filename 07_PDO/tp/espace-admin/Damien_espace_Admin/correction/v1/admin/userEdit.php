<?php

session_start();
$title = 'Edit user';
$currentPage = 'userEdit';
require 'config/config.php';
require 'functions/helpers.php';
require 'inc/head.php';
require 'inc/navbar.php';



if(!isset($_GET['id']) || empty($_GET['id'])){
  header('Location: userList.php?_err=404');
  exit;
}


if(!$_GET['id'] == $_SESSION[APP_TAG]['connected']['use_id']){
  redirectNotAllowed($_SESSION[APP_TAG]['connected']['autorisations'], 3);
}





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

try{

  # Connexion a la base 
  $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if(($request = $pdo->prepare(' SELECT use_id, use_login, use_role, rol_libelle
  FROM user 
  JOIN role ON use_role = rol_id
  WHERE use_id = :idUrl'
  )) !== false ){

      if($request->bindValue('idUrl', $_GET['id'])){

        # on execute la requête
        if($request->execute()){
          # On récupère et stocke le jeu de résultats au format tableau associatif
          $user = $request->fetch(PDO::FETCH_ASSOC);

          # on termine le traitement de la requete
          $request->closeCursor();
        }

      }
     
  } 
} catch(PDOException $e){

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());

}


# Modifier UN UTILISATEUR EN BASE  

if(!empty($_POST['login']) && !empty($_POST['role'])){

  try{

    # Connexion a la base 
    $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

    if(hasPower($pdo, getRole($pdo, $_GET['id']), $_SESSION[APP_TAG]['connected']['rol_pouvoir'])){

      if(hasPower($pdo, (int) $_POST['role'], $_SESSION[APP_TAG]['connected']['rol_pouvoir'])){

        $query = 'UPDATE user SET use_login = :form_login,' . (!empty($_POST['pwd']) ? 'use_mdp = :form_pwd,' : '' ) . 'use_role = :form_role WHERE use_id = :idUrl';
    
        # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
        if(($request = $pdo->prepare($query)) !== false ){
      
            if(($request->bindValue('form_login', $_POST['login'])) && ($request->bindValue('form_role', $_POST['role'])) &&  ($request->bindValue('idUrl', $_GET['id']))){

              if(!empty($_POST['pwd'])){
                $request->bindValue('form_pwd', $_POST['pwd']);
              }
              # on execute la requête
              if($request->execute()){
                header('Location: userList.php?success=edit');
                exit;
              }else{
                header('Location: userList.php?_err=edit');
                exit;
              }
      
            }
          }
      }
    }else{
      header('Location: userList.php?_err=403');
      exit;
    }
  
  }catch(PDOException $e){
  
    die($e->getMessage());
  
  }
}



?>



<h1 class="display-1 text-center my-5">Ajouter un l'utilisateur</h1>
<div class="container w-50">
  <div class="card p-4 border-0 shadow-sm">

    <form action="" method="post" >

      <div class="mb-3">
          <label for="inputLogin" class="form-label">Login</label>
          <input type="text" name="login" class="form-control" id="inputLogin" value="<?= $user['use_login'] ?>">
      </div>
      <div class="mb-3">
          <label for="inputPwd" class="form-label">Mot de passe</label>
          <input type="password" name="pwd" class="form-control" id="inputPwd" placeholder="Si aucun changement, laisser vide">
      </div>

      <div class="mb-3">

        <label for="roleSelect" class="form-label">Role</label>
        <select name="role" id="roleSelect" class="form-select">
          <?php foreach($roles as $role) : ?>
            <?php if($role['rol_pouvoir'] >= $_SESSION[APP_TAG]['connected']['rol_pouvoir']): ?>

              <option <?= $user['use_role'] === $role['rol_id'] ? 'selected' : '' ?> value="<?= $role['rol_id'] ?>" ><?= $role['rol_libelle'] ?></option>
            <?php endif; ?>
          <?php endforeach;?>
        </select>

      </div>

      <button type="submit" class="btn btn-primary">Mettre à jour</button>

    </form>

  </div>

</div>