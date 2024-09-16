<?php 
session_start();
require 'config/config.php';
require 'functions/helpers.php';

if(!isset($_GET['id']) || empty($_GET['id'])){
  header('Location: userList.php?_err=404');
  exit;
}


if(!$_GET['id'] == $_SESSION[APP_TAG]['connected']['use_id']){
  redirectNotAllowed($_SESSION[APP_TAG]['connected']['autorisations'], 5);
}


# RECUPERER TOUS LES ROLES POUR LES AFFICHER DANS LE DROPDOWN DU LE FORMULAIRE 
try{

  # Connexion a la base 
  $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

  if(hasPower($pdo, getRole($pdo, $_GET['id']), $_SESSION[APP_TAG]['connected']['rol_pouvoir'])){

    if(hasPower($pdo, (int) $_POST['role'], $_SESSION[APP_TAG]['connected']['rol_pouvoir'])){

      # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
      if(($request = $pdo->prepare('DELETE FROM user WHERE use_id = :idUrl')) !== false ){

        if($request->bindValue('idUrl', $_GET['id'])){

          # on execute la requête
          if($request->execute()){
            # on termine le traitement de la requete
            $request->closeCursor();

            header('Location: userList.php?success=delete');
            exit;
          }else{

            header('Location: userList.php?_err=delete');
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
