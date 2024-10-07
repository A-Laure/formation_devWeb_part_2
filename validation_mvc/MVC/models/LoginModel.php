<?php
session_start();

class LoginModel extends CoreModel
{

  private $_req;

  # Invoquée quand l'objet est détruit ou que un script se termine, elle libère des ressources
  public function __destruct()
  {
    if (!empty($this->_req)) {
      $this->_req->closeCursor();
    }
  }


  # LOGINPROCESSING
  public function loginProcessing()
  {
   /*  echo '<br>Je suis rentré dans LoginModel - LoginProcessing</br><hr> '; */

    // MESSAGE ERREUR DANS URL SI UN 1 OU LES 2 CHAMPS VIDES
    if (empty($_POST['email']) || empty($_POST['pwd'])) {
      $field = 'all';
      if (!empty($_POST['email'])) {
        $field = 'pwd';
      }
      if (!empty($_POST['pwd'])) {
        $field = 'email';
      }
      header('Location: /MVC/views/log_in/login.php?_err=empty&field=' . $field);
      exit;
    }

    try {
      /* echo '<br>Je suis rentré dans le try de LoginModel - LoginProcessing</br><hr> '; */
      # POUR RECUPERER les infos du  USER
      $query = 'SELECT u.user_Id  AS user_idUser, u.user_email, u.user_firstName, u.user_pwd, u.user_lastName, r.role_label AS role_roleLabel, u.role_Id AS role_roleId,
      GROUP_CONCAT(a.auto_Id) AS autorisations
      FROM user u
      JOIN role r ON u.role_Id = r.role_Id
      JOIN compose c ON r.role_Id = c.role_Id
      JOIN  autorization a ON c.auto_Id = a.auto_Id
      WHERE u.user_email = :email
      GROUP BY u.user_Id, u.user_email, u.user_firstName, u.user_pwd, u.user_lastName, r.role_label, u.role_Id';

    

    /* echo '<br>J ai lu la $query de LoginModel - LoginProcessing</br><hr> '; */


      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        $email = sanitizeData($_POST['email']);
        $pwd = trim($_POST['pwd']);

        /* echo '<br>$email = ' . $email .  '</br> ';
        echo '<br>$pwd = ' . $pwd .  '</br><hr> '; */

        if ($this->_req->bindValue(':email', $email)) {
          if ($this->_req->execute()) {

              /* echo 'Requête exécutée avec succès'; */
          
          
          // Fetch des données utilisateur
          $userConnected = $this->_req->fetch(PDO::FETCH_ASSOC);
                        
          // Vérification du résultat du fetch
          if ($userConnected === false) {
              /* echo '<br>Aucun utilisateur trouvé avec cet email.</br><hr>'; */
              return false;
          } else {
              /* echo '<br>Utilisateur trouvé :</br>'; */
             /*  dump($userConnected, 'userConnected suite Fetch');  */

              // Vérification du mot de passe
              if (password_verify($pwd, $userConnected['user_pwd'])) {
                  /*echo '<br>Mot de passe correct</br><hr>'; */

                  // Suppression du mot de passe avant stockage en session
                  unset($userConnected['user_pwd']);                  
                  $_SESSION[APP_TAG]['connected'] = $userConnected;
                 /*  dump( $_SESSION[APP_TAG]['connected'], 'Création session Connected'); */
                  return  $_SESSION[APP_TAG]['connected'];

              } else {
                  /* echo '<br>Mot de passe incorrect</br>';
                  var_dump($userConnected['user_pwd']);  // Affichage du hash du mot de passe stocké
                  var_dump($pwd); */  // Affichage du mot de passe fourni
                  return false;
              }
          }
      } else {
         /*  echo '<br>Échec de l\'exécution de la requête</br><hr>'; */
          return false;
      }
  } else {
     /*  echo '<br>Échec lors du bind de l\'email</br><hr>'; */
      return false;
  }
}
} catch (PDOException $e) {
/* echo 'Erreur SQL : ' . $e->getMessage(); */  // Pour déboguer
return false;
}
}
}
