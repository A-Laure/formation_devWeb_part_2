<?php 
session_start();
$title = 'User View';
$currentPage = 'userView';
require 'config/config.php';
require 'functions/helpers.php';
require 'inc/head.php';
require 'inc/navbar.php';


try{

  # Connexion a la base 
  $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if(($request = $pdo->prepare(' SELECT use_id, use_login, use_role, rol_libelle, rol_pouvoir
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

?>

<h1 class="display-1 text-center my-5">Profil de l'utilisateur</h1>
<div class="container">
  <div class="row gap-4">
    <div class="col">
      <div class="card">
        <h5 class="card-header">id : <?= $user['use_id']?></h5>
        <div class="card-body">
        <h5 class="card-title">Login : <?= $user['use_login']?></h5>
        <p class="card-text">Role : <?= $user['rol_libelle']?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require 'inc/foot.php' ?>