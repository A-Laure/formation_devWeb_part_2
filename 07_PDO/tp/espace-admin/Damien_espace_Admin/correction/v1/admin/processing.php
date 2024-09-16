<?php
session_start();
require 'config/config.php';


if(empty($_POST['login']) || empty($_POST['pwd']) ){

  $field = 'all';

  if(!empty($_POST['login'])){
    $field = 'pwd';
  }
  if(!empty($_POST['pwd'])){
    $field = 'login';
  }
  header('Location: ../login.php?_err=empty&field=' . $field);
  exit;
}


# On définir le dsn (DATA SOURCE NAME)
// $dsn = 'mysql:host=localhost;dbname=administration;charset=utf8mb4';
$dsn = DB_ENGINE .':host='. DB_HOST .';dbname='. DB_NAME .';charset='. DB_CHARSET ;

try{

  # Connexion a la base 
  $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if(($request = $pdo->prepare('SELECT use_id, use_login, use_mdp, use_role, rol_libelle, rol_pouvoir, GROUP_CONCAT(rra_autorisation) AS autorisations
  FROM user 
  JOIN role ON use_role = rol_id
  JOIN rel_role_autorisation ON rol_id = rra_role
  WHERE use_login = :form_login')) !== false ){


    $login = sanitizeData($_POST['login']);
    $pwd = trim($_POST['pwd']);

    # ASSOCIATION MARQUEUR => VALEUR | on associe les marqueurs présent dans la requête SQL(:form_login, :form_pwd) aux valeurs saisies dans le formulaire
    if($request->bindValue('form_login', $login) ){

      # on execute la requête
      if($request->execute()){

        # On récupère et stocke le jeu de résultats au format tableau associatif
        if(($user = $request->fetch(PDO::FETCH_ASSOC)) !== false){

          if(password_verify($pwd, $user['use_mdp'])){
            # On stocke le jeu de résultats des autorisations récupérées grace au GROUP_CONCAT au format tableau indexé
            $user['autorisations'] = explode(',', $user['autorisations']);

            # unset le mdp pour pas l'avoir
            unset($user['use_mdp']);

            # on stocke en session les infos récupérées
            $_SESSION[APP_TAG]['connected'] = $user;

            # on termine le traitement de la requete
            $request->closeCursor();

            # Si tout se passe bien on redirige vers dashboard.php
            header('Location: dashboard.php');  
          }

        }else{

          # Si pas de correspondance, on termine le traitement de la requete et redirige vers login.php  
          $request->closeCursor();
          header('Location: ../login.php?_err=connect');
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

