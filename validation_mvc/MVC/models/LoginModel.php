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
    echo '<br>Je suis rentré dans LoginModel - LoginProcessing</br><hr> ';

    // MESSAGE ERREUR DANS URL SI UN 1 OU LES 2 CHAMPS VIDES
    if (empty($_POST['email']) || empty($_POST['pwd'])) {
      $field = 'Email et Pwd';
      if (!empty($_POST['email'])) {
        $field = 'pwd';
      }
      if (!empty($_POST['pwd'])) {
        $field = 'email';
      }
      header('Location: index.php?ctrl=Home&action=index&_err=Champ(s) vide(s)=' . $field);
      exit;
    }


    try {
      echo '<br>Je suis rentré dans le try de LoginModel - LoginProcessing</br><hr> ';
      # POUR RECUPERER les infos du  USER
      $query = 'SELECT
    u.user_userId,
    u.user_userStatus,
    u.user_userEnvrnt,
    u.user_userEmail,
    u.user_userPwd,
    u.user_userFirstname,
    u.user_userlastname,
    u.user_userTextaera,
    u.user_userSpeciality,
    u.user_userAdr1,
    u.user_userAdr2,
    u.user_userTown,
    u.user_userCp,
    GROUP_CONCAT(DISTINCT d.netw_networkLink) AS links,
    GROUP_CONCAT(DISTINCT t.skill_skillLabel) AS skills,
    GROUP_CONCAT(DISTINCT j.joba_jobLabel, j.joba_jobAdvertId) AS adverts,
    GROUP_CONCAT(DISTINCT s.netw_networkLabel) AS networks
        FROM user u 
      LEFT JOIN has h ON h.user_userId = u.user_userId
      LEFT JOIN techskills t on t.skill_skillId = h.skill_skillId
      LEFT JOIN apply a ON a.user_userId = u.user_userId
      LEFT JOIN jobadvert j ON a.joba_jobAdvertId = j.joba_jobAdvertId
      LEFT JOIN display d ON d.user_userId = u.user_userId      
      LEFT JOIN socialnetwork s on s.netw_networkId = d.netw_networkId
      WHERE u.user_userEmail = :email
      GROUP BY u.user_userId
      ';



      echo '<br>J ai lu la $query de LoginModel - LoginProcessing</br><hr> ';


      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        $email = sanitizeData($_POST['email']);
        $pwd = trim($_POST['pwd']);

        echo '<br>$email = ' . $email .  '</br> ';
        echo '<br>$pwd = ' . $pwd .  '</br><hr> ';

        if ($this->_req->bindValue(':email', $email)) {
          if ($this->_req->execute()) {

            echo 'Requête exécutée avec succès';


            // Fetch des données utilisateur
            $userConnected = $this->_req->fetch(PDO::FETCH_ASSOC);


            // Vérification du résultat du fetch
            if (!$userConnected) {

              if (!$userConnected) {
                  header("Location: index.php?ctrl=Home&action=index&_err=Password ou Email non valide");
                exit;
            
            } else {
          
                dump($userConnected, 'userConnected suite Fetch');
            
                // Vérification du statut de l'utilisateur
                if ($userConnected['user_userStatus'] === 'Etudiant') {
                    header("Location: index.php?ctrl=Home&action=index&_err=Accès non autorisé pour les utilisateurs en statut étudiant");
                    exit;
                }
              }
/* 
              echo '<br>Aucun utilisateur trouvé avec cet email.</br><hr>';
              header("Location: index.php?ctrl=Home&action=index&_err=Password ou Email non valide");
              exit; */

            } else {

              echo '<br>Utilisateur trouvé :</br>';
              dump($userConnected, 'userConnected suite Fetch');

              // Vérification du mot de passe
              if (password_verify($pwd, $userConnected['user_userPwd'])) {
                echo '<br>Mot de passe correct</br><hr>';
                // Conversion des compétences et réseaux en tableaux
               
                $userConnected['skills'] = !empty($userConnected['skills']) ? explode(',', $userConnected['skills']) : [];
                $userConnected['links'] = !empty($userConnected['links']) ? explode(',', $userConnected['links']) : [];
                $userConnected['networks'] = !empty($userConnected['networks']) ? explode(',', $userConnected['networks']) : [];
                $userConnected['adverts'] = !empty($userConnected['adverts']) ? explode(',', $userConnected['adverts']) : [];

                // Suppression du mot de passe avant stockage en session
                unset($userConnected['user_UserPwd']);
                $_SESSION[APP_TAG]['connected'] = $userConnected;
                dump($_SESSION[APP_TAG]['connected'], 'Création session Connected');
                return  $_SESSION[APP_TAG]['connected'];

              } else {                   
                
                header("Location: index.php?ctrl=Home&action=index&_err=Password ou Email non valide");
                var_dump($userConnected['user_Userpwd']);  // Affichage du hash du mot de passe stocké
                var_dump($pwd);   // Affichage du mot de passe fourni
                exit;
              }
            }
          } else {
            header("Location: index.php?ctrl=Home&action=index&_err=Echec execution de la requête");
            exit;
                  }
        } else {
          header("Location: index.php?ctrl=Home&action=index&_err=Echec bind de l email");
          return false;
        }
      }
    } catch (PDOException $e) {
      echo 'Erreur SQL : ' . $e->getMessage();
      return false;
    }
  }
}
