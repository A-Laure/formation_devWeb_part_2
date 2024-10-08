<?php

class UserModel extends CoreModel
{


  private $_req;

  # Invoquée quand l'objet est détruit ou que un script se termine, elle libère des ressources
  public function __destruct()
  {
    if (!empty($this->_req)) {
      $this->_req->closeCursor();
    }
  }


  # READALL : Méthode pour récupérer tous les users 
  public function readAll()
  {
    /*  echo 'Je rentre dans la fonction readAll de UserModel '; */
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
      GROUP_CONCAT(DISTINCT t.skill_skillLabel ORDER BY t.skill_skillLabel) AS skills,
      GROUP_CONCAT(DISTINCT s.netw_networkLabel ORDER BY s.netw_networkLabel) AS networks
      FROM user u 
      LEFT JOIN has h ON h.user_userId = u.user_userId
      LEFT JOIN techskills t on t.skill_skillId = h.skill_skillId
      LEFT JOIN display d ON d.user_userId = u.user_userId
      LEFT JOIN socialnetwork s on s.netw_networkId = d.netw_networkId
      GROUP BY u.user_userId
      ';

    try {
      if (($this->_req = $this->getDb()->prepare($query)) !== false) {

        if ($this->_req->execute()) {
          $datas = $this->_req->fetchAll(PDO::FETCH_ASSOC);
          /* dump($datas,'UserModel Fetchall User ReadAll -> $datas return'); */
          return $datas;
        }
      }

      return false;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  # READONE : Méthode pour récupérer un user via Id
  public function readOne($id)
  {
    try {

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
      GROUP_CONCAT(DISTINCT t.skill_skillLabel ORDER BY t.skill_skillLabel) AS skills,
      GROUP_CONCAT(DISTINCT s.netw_networkLabel ORDER BY s.netw_networkLabel) AS networks
      FROM user u 
      LEFT JOIN has h ON h.user_userId = u.user_userId
      LEFT JOIN techskills t on t.skill_skillId = h.skill_skillId
      LEFT JOIN display d ON d.user_userId = u.user_userId
      LEFT JOIN socialnetwork s on s.netw_networkId = d.netw_networkId
    WHERE user_IuserId = :id';

      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if (($this->_req->bindValue(':id', $id, PDO::PARAM_INT))) {
          if ($this->_req->execute()) {
            $datas = $this->_req->fetch(PDO::FETCH_ASSOC);
            return $datas;
          }
        }
      }
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }


  # CREATE, le $request = le $_POST
  public function create($request)
 
  {
    echo '<br>Je rentre dans create de UseModel</br><hr>';
    dump($_POST, 'post create User dans userModel create');
    
      try {
          // Étape 1 : Vérifier si l'email existe déjà
          $checkQuery = "SELECT COUNT(*) FROM user WHERE user_userEmail = :email";
          $checkStmt = $this->getDb()->prepare($checkQuery);
          $checkStmt->bindValue(':email', $request['email']);
          $checkStmt->execute();
  
          if ($checkStmt->fetchColumn() > 0) {
              // Si l'email existe déjà, renvoyer un message ou `false`
              echo 'Email déjà existant, insertion annulée';
              return false;
          }
  
          // Étape 2 : Insertion dans la table `user`
          $query = "INSERT INTO `user`(
              `user_userStatus`, 
              `user_userEnvrnt`, 
              `user_userEmail`, 
              `user_userPwd`, 
              `user_userFirstName`, 
              `user_userLastName`, 
              `user_userTextaera`,         
              `user_userSpeciality`, 
              `user_userAdr1`, 
              `user_userAdr2`, 
              `user_userTown`,
              `user_userCp`
          ) VALUES (
              :status, 
              :envrnt, 
              :email,          
              :pwd, 
              :firstName,
              :lastName, 
              :textaera, 
              :speciality,    
              :userAdr1, 
              :userAdr2, 
              :userTown, 
              :userCp
          )";
  
  // rajouter htmlspecialchars($request['firstName']);
          $stmt = $this->getDb()->prepare($query);
          $stmt->bindValue(':status', $request['status']);
          $stmt->bindValue(':envrnt', $request['envrnt']);
          $stmt->bindValue(':email', $request['email']);
          $stmt->bindValue(':pwd', password_hash($request['pwd'], PASSWORD_BCRYPT));  // Hachage du mot de passe
          $stmt->bindValue(':firstName', $request['firstName']);
          $stmt->bindValue(':lastName', $request['lastName']);
          $stmt->bindValue(':textaera', $request['textaera']);
          $stmt->bindValue(':speciality', $request['speciality']);
          $stmt->bindValue(':userAdr1', $request['userAdr1']);
          $stmt->bindValue(':userAdr2', $request['userAdr2']);
          $stmt->bindValue(':userTown', $request['userTown']);
          $stmt->bindValue(':userCp', $request['userCp']);
  
          if ($stmt->execute()) {
              $userId = $this->getDb()->lastInsertId();
  
              // Étape 3 : Insertion dans la table `skills` (si des compétences sont fournies)
             /* This code block is checking if the `` array contains any data for the key
             'skills'. If the 'skills' key is not empty, it means that the user has provided some
             skills information. */
              if (!empty($request['skills'])) {
                  $skillQuery = "INSERT INTO techskills (user_userId, skill_skillLabel) VALUES (:userId, :skill)";
                  $skillStmt = $this->getDb()->prepare($skillQuery);
                  foreach ($request['skills'] as $skill) {
                      $skillStmt->bindValue(':userId', $userId);
                      $skillStmt->bindValue(':skill', $skill);
                      $skillStmt->execute();
                  }
              }
  
              // Étape 4 : Insertion dans la table `networks` (si des réseaux sont fournis)
              if (!empty($request['networks'])) {
                  $networkQuery = "INSERT INTO network (user_userId, netw_networkLabel) VALUES (:userId, :network)";
                  $networkStmt = $this->getDb()->prepare($networkQuery);
                  foreach ($request['networks'] as $network) {
                      $networkStmt->bindValue(':userId', $userId);
                      $networkStmt->bindValue(':network', $network);
                      $networkStmt->execute();
                  }
              }
  
              return $userId; // Retourne l'ID de l'utilisateur nouvellement inséré
          }
      } catch (PDOException $e) {
          die($e->getMessage());
      }
  }

 # UPDATE d'un USER
 public function update($id, $request)
 {
   echo '<br>UserModel, je suis rentré ds update</br><h
r>';
   dump($_POST, '$_post dans usermodel - update');
   echo 'UserModel - Update GET Id : ' . $_GET['id'];
   try {
     $query = "UPDATE user
    SET
    user_firstName = :firstName,
    user_lastName = :lastName,
    user_email = :email, 
    user_pwd = :pwd, 
    role_id = :roleId
   WHERE user_Id = :id";


     if (($this->_req = $this->getDb()->prepare($query)) !== false) {

       echo '<br>UserModel, je suis rentré ds prepare</br><hr>';



       if ((
         $this->_req->bindValue(':firstName', $request['firstName'])
         &&
         $this->_req->bindValue(':lastName', $request['lastName'])
         &&
         $this->_req->bindValue(':email', $request['email'])
         &&
         $this->_req->bindValue(':pwd', $request['pwd'])
         /* &&
       $this->_req->bindValue(':lastMove', $request['lastMove']) */
         &&
         $this->_req->bindValue(':roleId', $request['roleId'])
         &&
         $this->_req->bindValue(':id', $id)
       )) {
         if ($this->_req->execute()) {
           echo '<br>UserModel, je suis rentré ds execute</br><hr>';
           // Compte le nombre de lignes affectées par la requête, renvoi le nombre de lignes modfiées, si 0 -> pb, peut servir pour un renvoi de message
           echo '<br>UserModel, je suis avant le rowCount</br><hr>';
           $res = $this->_req->rowCount();
           echo '<br>UserModel, je suis après le rowCount</br><hr>' . $res;
           dump($res, 'UserModel, Update $res');
           return $res;
         }
       }
     }
   } catch (PDOException $e) {
     die($e->getMessage());
   }
 }




  
  # DELETE
  public function delete($id)
  {
    try {
      $query = "DELETE FROM user WHERE user_Id = :id";

      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if (($this->_req->bindValue(':id', $id, PDO::PARAM_INT))) {
          if ($this->_req->execute()) {

            $res = $this->_req->rowCount();
            return $res;
          }
        }
      }
    } catch (PDOException $e) {
      echo 'Erreur SQL : ' . $e->getMessage(); 
return false;
    }
  }
}
