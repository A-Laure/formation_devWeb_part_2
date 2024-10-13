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
    WHERE u.user_userId = :id';

      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if (($this->_req->bindValue(':id', $id, PDO::PARAM_INT))) {
          if ($this->_req->execute()) {
            $datas = $this->_req->fetch(PDO::FETCH_ASSOC);
            return $datas;
          }else {
            echo "Aucune donnée trouvée pour l'utilisateur avec l'ID $id.";
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
              // Si l'email existe déjà, renvoyer un message ou false`
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
 public function update($id, $request) {
  echo '<br>UserModel, je suis rentré dans update</br><hr>';
  dump($request, '$_POST dans UserModel - update');
  echo 'UserModel - Update ID : ' . htmlspecialchars($id);

  try {
      // Correction de la requête SQL
      $query = "UPDATE user SET
                  user_userStatus = :status,
                  user_userEnvrnt = :envrnt,
                  user_userEmail = :email,
                  user_userPwd = :pwd,
                  user_userFirstName = :firstname,
                  user_userLastName = :lastname,
                  user_userTextaera = :textaera,                  
                  user_userSpeciality = :speciality,
                  user_userAdr1 = :adr1,
                  user_userAdr2 = :adr2,
                  user_userTown = :town,
                  user_userCp = :cp,
                  user_userLastMove = NOW()
                WHERE user_userId = :id";

      // Préparation de la requête
      if ($this->_req = $this->getDb()->prepare($query)) {
          echo '<br>UserModel, je suis rentré dans prepare</br><hr>';

          // Liaison des valeurs avec `bindValue`
          if (
              $this->_req->bindValue(':status', $request['status']) &&
              $this->_req->bindValue(':envrnt', $request['envrnt']) &&
              $this->_req->bindValue(':email', $request['email']) &&
              $this->_req->bindValue(':pwd',($request['pwd'])) &&  
              $this->_req->bindValue(':firstname', $request['firstname']) &&
              $this->_req->bindValue(':lastname', $request['lastname']) &&
              $this->_req->bindValue(':textaera', $request['textaera']) &&
              $this->_req->bindValue(':speciality', $request['speciality']) &&
              $this->_req->bindValue(':adr1', $request['adr1']) &&
              $this->_req->bindValue(':adr2', $request['adr2']) &&
              $this->_req->bindValue(':town', $request['town']) &&
              $this->_req->bindValue(':cp', $request['cp']) &&
              $this->_req->bindValue(':id', $id, PDO::PARAM_INT)
          ) {
              // Exécution de la requête
              if ($this->_req->execute()) {
                  echo '<br>UserModel, je suis rentré dans execute</br><hr>';
                  $res = $this->_req->rowCount();
                  echo '<br>UserModel, nombre de lignes affectées : </br><hr>' . $res;
                  dump($res, 'UserModel, Update $res');
                  return $res;
              }
          }
      }
  } catch (PDOException $e) {
      die('Erreur SQL : ' . $e->getMessage());
  }
}





  
  # DELETE
  public function delete($id)
  {
    try {
      $query = "DELETE FROM user WHERE user_userId = :id";
      echo '0';
      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        echo '1';
        if (($this->_req->bindValue(':id', $id, PDO::PARAM_INT))) {
          echo '2';
          if ($this->_req->execute()) {
            echo '3';

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
