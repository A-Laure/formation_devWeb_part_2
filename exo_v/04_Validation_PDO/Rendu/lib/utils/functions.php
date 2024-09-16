<?php 

function isNotConnected(){

  if(!isset($_SESSION['cem']['connected'])){
    header('Location: ../login.php');
    exit;
  }

}


function userExist(array $users, array $searchedUser) : bool {

  $email = strtolower($searchedUser['email']);
  $pwd = $searchedUser['pwd'];

  foreach($users as $user){

    if($email === $user['user_email'] && $pwd === $user['user_pwd']){

      unset($user['user_pwd']);
      $_SESSION['cem']['connected'] = $user;
      return true;
    }

  }

  $_SESSION['cem']['error'] = 'Mauvais identifiant / mot de passe';
  return false;

}

function selectAll (array $data) : array {
  try {
    # Connexion a la base 
    $pdo = dbConnect();
  
    $query = 'SELECT *  FROM data';
  
  
    # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
    if (($request3 = $pdo->prepare($query)) !== false) {
  
      # on execute la requête
      if ($request3->execute()) {
        # On récupère et stocke le jeu de résultats au format tableau associatif
        $taverneName = $request3->fetchAll(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // var_dump($taverneName);
        // echo '</pre>';
  
  
        # on termine le traitement de la requete
        $request2->closeCursor();
      }
    }
  } catch (PDOException $e) {
  
    # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
    die($e->getMessage());
  }
  

}