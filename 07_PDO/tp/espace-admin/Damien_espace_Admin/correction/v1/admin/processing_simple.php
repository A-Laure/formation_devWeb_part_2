<?php
session_start();
require 'config/config.php';


# On définir le dsn (DATA SOURCE NAME)
// $dsn = 'mysql:host=localhost;dbname=administration;charset=utf8mb4';
$dsn = DB_ENGINE .':host='. DB_HOST .';dbname='. DB_NAME .';charset='. DB_CHARSET ;

try{

  # Connexion a la base 
  $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if(($request = $pdo->prepare('SELECT * FROM user WHERE use_login = :form_login AND use_mdp = :form_pwd')) !== false ){
    
    # ASSOCIATION MARQUEUR => VALEUR | on associe les marqueurs présent dans la requête SQL(:form_login, :form_pwd) aux valeurs saisies dans le formulaire
    if(($request->bindValue('form_login', $_POST['login'])) AND ($request->bindValue('form_pwd', $_POST['pwd'])) ){

      # on execute la requête
      if($request->execute()){

        # On récupère et stocke le jeu de résultats au format tableau associatif
        if( ($user = $request->fetch(PDO::FETCH_ASSOC)) !== false){

          # on stocke en session les infos récupérées
          unset($user['use_mdp']);
          $_SESSION[APP_TAG]['connected'] = $user;

          # on termine le traitement de la requete
          $request->closeCursor();

        }else{

          # Si pas de correspondance, on termine le traitement de la requete et redirige vers login.php  
          $request->closeCursor();
          header('Location: ../login.php?err=connect');
          exit;
        }

      }else{
        echo 'Un problème est survenu lors de l\'exécution de la requête';
      }

    }else{
      echo 'Un problème est survenu lors de la préparation des valeurs';
    }
  } else {
    echo 'Un problème est survenu lors de la préparation de la requête';
  }
# dans le cas d'un échec, on récupère l'exception(erreur)
} catch(PDOException $e){

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());

}

# Si tout se passe bien on redirige vers dashboard.php
header('Location: dashboard.php');