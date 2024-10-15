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
              header('Location: index.php?ctrl=Home&action=index&_err=email existe déjà');
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
          $stmt->bindValue(':status', htmlspecialchars($request['status']));
          $stmt->bindValue(':envrnt', htmlspecialchars($request['envrnt']));
          $stmt->bindValue(':email', htmlspecialchars($request['email']));
          $stmt->bindValue(':pwd', password_hash(htmlspecialchars($request['pwd']), PASSWORD_BCRYPT));  // Hachage du mot de passe
          $stmt->bindValue(':firstName', htmlspecialchars($request['firstName']));
          $stmt->bindValue(':lastName', htmlspecialchars($request['lastName']));
          $stmt->bindValue(':textaera', htmlspecialchars($request['textaera']));
          $stmt->bindValue(':speciality', htmlspecialchars($request['speciality']));
          $stmt->bindValue(':userAdr1', htmlspecialchars($request['userAdr1']));
          $stmt->bindValue(':userAdr2', htmlspecialchars($request['userAdr2']));
          $stmt->bindValue(':userTown', htmlspecialchars($request['userTown']));
          $stmt->bindValue(':userCp', htmlspecialchars($request['userCp']));
  
          if ($stmt->execute()) {
              $userId = $this->getDb()->lastInsertId();
              echo $userId;
  
              // Étape 3 : Insertion dans la table `skills` (si des compétences sont fournies)
             // pas la peine de mettre les [] ds $request['skills'], php sait l'interpréter
              if (!empty($request['skills'])) {
                  $skillQuery = "INSERT INTO has (user_userId, skill_skillId) VALUES (:userId, :skill)";
                  $skillStmt = $this->getDb()->prepare($skillQuery);
                  foreach ($request['skills'] as $skill) {
                      $skillStmt->bindValue(':userId', $userId);
                      $skillStmt->bindValue(':skill', $skill);
                      $skillStmt->execute();
                  }
              }
  
              // Étape 4 : Insertion dans la table `networks` (si des réseaux sont fournis)
              // pas la peine de mettre les [] ds $request['networks'], php sait l'interpréter
              if (!empty($request['networks'])) {
                  $networkQuery = "INSERT INTO display (user_userId, netw_networkId, netw_networkLink) VALUES (:userId, :networkId, :networkLink)";
                  $networkStmt = $this->getDb()->prepare($networkQuery);
                  foreach ($request['networks'] as $network) {                
                    $networkId = $network['networkId']; 
                    $networkLink = $network['networkLink']; 
            
                    // Liez les valeurs
                    $networkStmt->bindValue(':userId', $userId);
                    $networkStmt->bindValue(':networkId', $networkId);
                    $networkStmt->bindValue(':networkLink', $networkLink);
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
      // Requête pour mettre à jour les informations utilisateur
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

      // Préparation et exécution de la requête pour l'utilisateur
      if ($this->_req = $this->getDb()->prepare($query)) {
          // Liaison des valeurs
          $this->_req->bindValue(':status', $request['status']);
          $this->_req->bindValue(':envrnt', $request['envrnt']);
          $this->_req->bindValue(':email', $request['email']);
          $this->_req->bindValue(':pwd', $request['pwd']);  
          $this->_req->bindValue(':firstname', $request['firstname']);
          $this->_req->bindValue(':lastname', $request['lastname']);
          $this->_req->bindValue(':textaera', $request['textaera']);
          $this->_req->bindValue(':speciality', $request['speciality']);
          $this->_req->bindValue(':adr1', $request['adr1']);
          $this->_req->bindValue(':adr2', $request['adr2']);
          $this->_req->bindValue(':town', $request['town']);
          $this->_req->bindValue(':cp', $request['cp']);
          $this->_req->bindValue(':id', $id, PDO::PARAM_INT);

          if ($this->_req->execute()) {
              echo '<br>UserModel, utilisateur mis à jour</br><hr>';

              // Suppression des compétences actuelles de l'utilisateur
              $queryDeleteSkills = "DELETE FROM has WHERE user_userId = :id";
              $stmtDeleteSkills = $this->getDb()->prepare($queryDeleteSkills);
              $stmtDeleteSkills->bindValue(':id', $id, PDO::PARAM_INT);
              $stmtDeleteSkills->execute();

              // Insertion des nouvelles compétences
              if (!empty($request['skills'])) {
                  $queryInsertSkills = "INSERT INTO has (user_userId, skill_skillId) VALUES (:userId, :skillId)";
                  $stmtInsertSkills = $this->getDb()->prepare($queryInsertSkills);

                  foreach ($request['skills'] as $skillId) {
                      $stmtInsertSkills->bindValue(':userId', $id, PDO::PARAM_INT);
                      $stmtInsertSkills->bindValue(':skillId', $skillId, PDO::PARAM_INT);
                      $stmtInsertSkills->execute();
                      $stmtInsertSkills->closeCursor(); // Réinitialisation
                  }
              }

              // Suppression des réseaux sociaux actuels de l'utilisateur
              $queryDeleteNetworks = "DELETE FROM display WHERE user_userId = :id";
              $stmtDeleteNetworks = $this->getDb()->prepare($queryDeleteNetworks);
              $stmtDeleteNetworks->bindValue(':id', $id, PDO::PARAM_INT);
              $stmtDeleteNetworks->execute();

              // Insertion des nouveaux réseaux sociaux
              if (!empty($request['links'])) {
                  $queryInsertNetworks = "INSERT INTO display (user_userId, netw_networkId, netw_networkLink) VALUES (:userId, :networkId, :networkLink)";
                  $stmtInsertNetworks = $this->getDb()->prepare($queryInsertNetworks);

                  foreach ($request['links'] as $network) {
                      // Assure l'association correcte des paramètres de chaque réseau
                      $stmtInsertNetworks->bindValue(':userId', $id, PDO::PARAM_INT);
                      $stmtInsertNetworks->bindValue(':networkId', $network['id'], PDO::PARAM_INT); // ID du réseau
                      $stmtInsertNetworks->bindValue(':networkLink', $network['link'], PDO::PARAM_STR); // Lien du réseau
                      $stmtInsertNetworks->execute();
                      $stmtInsertNetworks->closeCursor(); // Réinitialisation
                  }
              }

              echo '<br>UserModel, compétences et réseaux mis à jour</br><hr>';
              return true;
          }
      }
  } catch (PDOException $e) {
      die('Erreur SQL : ' . $e->getMessage());
  }
  return false;
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
