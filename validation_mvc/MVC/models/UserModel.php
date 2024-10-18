<?php
session_start();

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
   # --------------- READONE ------------
   public function readOne($id)
   {
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
          GROUP_CONCAT(DISTINCT s.netw_networkLabel ORDER BY s.netw_networkLabel) AS networks,
          GROUP_CONCAT(DISTINCT d.netw_networkLink ORDER BY d.netw_networkLink) AS links,  
          GROUP_CONCAT(DISTINCT a.joba_jobLabel ORDER BY a.joba_jobLabel) AS adverts  
    FROM user u 
    LEFT JOIN has h ON h.user_userId = u.user_userId
    LEFT JOIN techskills t ON t.skill_skillId = h.skill_skillId
    LEFT JOIN display d ON d.user_userId = u.user_userId
    LEFT JOIN socialnetwork s ON s.netw_networkId = d.netw_networkId
    LEFT JOIN jobadvert a ON a.user_userId = u.user_userId 
        WHERE   u.user_userId = :id';
   
       try {
           if (($this->_req = $this->getDb()->prepare($query)) !== false) {
               // Bind the value for :id
               $this->_req->bindValue(':id', $id, PDO::PARAM_INT);
   
               if ($this->_req->execute()) {
                   $datas = $this->_req->fetch(PDO::FETCH_ASSOC);
                   return $datas;
               }
           }
           return false;
       } catch (PDOException $e) {
           die($e->getMessage());
       }
   }
   



  # ----------------    READONE 

  /* public function readOne($id)
  {
    try {

      $query = 'SELECT 
    u.user_userId,
    u.user_userStatus, 
    u.user_userEnvrnt,
    u.user_userEmail, 
    u.user_userPwd, 
    u.user_userFirstname, 
    u.user_userLastname, 
    u.user_userTextaera, 
    u.user_userSpeciality, 
    u.user_userAdr1, 
    u.user_userAdr2, 
    u.user_userTown, 
    u.user_userCp, 
    GROUP_CONCAT(DISTINCT d.netw_networkId ORDER BY d.netw_networkId) AS networkIds,  
    GROUP_CONCAT(DISTINCT d.netw_networkLink ORDER BY d.netw_networkId) AS links,
    GROUP_CONCAT(DISTINCT s.netw_networkLabel ORDER BY s.netw_networkLabel) AS networkLabels, -- Renommer pour éviter la confusion
    GROUP_CONCAT(DISTINCT s.netw_networkId ORDER BY s.netw_networkId) AS netw_networkIds,
    GROUP_CONCAT(DISTINCT t.skill_skillId ORDER BY t.skill_skillId) AS skillIds,
    GROUP_CONCAT(DISTINCT t.skill_skillLabel ORDER BY t.skill_skillLabel) AS skills   
FROM user u 
LEFT JOIN has h ON h.user_userId = u.user_userId
LEFT JOIN techskills t ON t.skill_skillId = h.skill_skillId
LEFT JOIN display d ON d.user_userId = u.user_userId
LEFT JOIN socialnetwork s ON s.netw_networkId = d.netw_networkId
WHERE u.user_userId = :id
GROUP BY 
    u.user_userId,
    u.user_userStatus, 
    u.user_userEnvrnt,
    u.user_userEmail, 
    u.user_userPwd, 
    u.user_userFirstname, 
    u.user_userLastname, 
    u.user_userTextaera, 
    u.user_userSpeciality, 
    u.user_userAdr1, 
    u.user_userAdr2, 
    u.user_userTown, 
    u.user_userCp';


      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if (($this->_req->bindValue(':id', $id, PDO::PARAM_INT))) {
          if ($this->_req->execute()) {
            $datas = $this->_req->fetch(PDO::FETCH_ASSOC);
            return $datas;
          } else {
            echo "Aucune donnée trouvée pour l'utilisateur avec l'ID $id.";
          }
        }
      }
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }
 */



  # -------------        CREATE, le $request = le $_POST


  public function create($request)
{
    
  // on stocke les données déjà remplies pour éviter une re-saisie
  /* $_SESSION['form_data'] = $_POST;  */


// Test des zones obligatoires si vides...

// On initialise un tableau d'erreurs
$errors = [];

// Vérification des champs obligatoires
if (empty($request['status'])) {
    $errors[] = "Le statut est obligatoire";
}

if (empty($request['spe'])) {
    $errors[] = "La spécialité est obligatoire";
}

if (empty($request['lastname'])) {
    $errors[] = "Le prénom est obligatoire";
}

if (empty($request['email'])) {
    $errors[] = "L'email est obligatoire";
}

if (empty($request['pwd'])) {
    $errors[] = "Le mot de passe est obligatoire";
}

// Si des erreurs sont présentes, on stocke les données et on redirige
/* if (!empty($errors)) {
    $_SESSION['form_data'] = $request; // Stocke les données pour affichage
    header('Location: index.php?ctrl=User&action=create&_err=' . urlencode(implode(", ", $errors)));
    exit;
} */

    try {
        // Étape 1 : Vérifier si l'email existe déjà
        $checkQuery = "SELECT COUNT(*) FROM user WHERE user_userEmail = :email";
        $checkStmt = $this->getDb()->prepare($checkQuery);
        $checkStmt->bindValue(':email', $request['email']);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() > 0) {
            // Si l'email existe déjà, renvoyer un message ou false
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
                `user_userAdr1`, 
                `user_userAdr2`, 
                `user_userTown`,
                `user_userCp`
            ) VALUES (
                :status, 
                :spe, 
                :email,          
                :pwd, 
                :firstname,
                :lastname, 
                :textaera,    
                :userAdr1, 
                :userAdr2, 
                :userTown, 
                :userCp
            )";

        // Préparation de la requête
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(':status', htmlspecialchars($request['status']));
        $stmt->bindValue(':spe', htmlspecialchars($request['spe']));
        $stmt->bindValue(':email', htmlspecialchars($request['email']));
        $stmt->bindValue(':pwd', password_hash(htmlspecialchars($request['pwd']), PASSWORD_BCRYPT));  // Hachage du mot de passe
        $stmt->bindValue(':firstname', htmlspecialchars($request['firstname']));
        $stmt->bindValue(':lastname', htmlspecialchars($request['lastname']));
        $stmt->bindValue(':textaera', htmlspecialchars($request['textaera']));
        $stmt->bindValue(':userAdr1', htmlspecialchars($request['userAdr1']));
        $stmt->bindValue(':userAdr2', htmlspecialchars($request['userAdr2']));
        $stmt->bindValue(':userTown', htmlspecialchars($request['userTown']));
        $stmt->bindValue(':userCp', htmlspecialchars($request['userCp']));

        if ($stmt->execute()) {
            $userId = $this->getDb()->lastInsertId();
            echo $userId;

            // Étape 3 : Insertion dans la table `skills` (si des compétences sont fournies)
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









  #   ----------  UPDATE d'un USER ----------

  public function update($id, $request)
  {
      echo '<br>UserModel, update initié</br><hr>';
      dump($request, '$_POST dans UserModel - update');
  
      try {
          // Validation de l'email
          if (empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
              header('Location: index.php?ctrl=User&action=edit&_err=Adresse email non valide');
              return false;
          }
  
          // Hachage du mot de passe si présent
          if (!empty($request['pwd'])) {
              $request['pwd'] = password_hash($request['pwd'], PASSWORD_DEFAULT);
          } else {
              unset($request['pwd']); // Ne pas lier si c'est vide
          }
  
          // Début de la transaction
          $this->getDb()->beginTransaction();
  
          // Mise à jour des informations utilisateur
          $query = "UPDATE user SET 
              user_userStatus = :status,
              user_userEnvrnt = :envrnt,
              user_userEmail = :email,
              user_userFirstName = :firstname,
              user_userLastName = :lastname,
              user_userTextaera = :textaera,
              user_userSpeciality = :speciality,
              user_userAdr1 = :adr1,
              user_userAdr2 = :adr2,
              user_userTown = :town,
              user_userCp = :cp,
              user_userLastMove = NOW()";
  
          // Ajouter le champ `user_userPwd` si le mot de passe est fourni
          if (isset($request['pwd'])) {
              $query .= ", user_userPwd = :pwd";
          }
  
          $query .= " WHERE user_userId = :id";
  
          $stmt = $this->getDb()->prepare($query);
          $stmt->bindValue(':status', $request['status']);
          $stmt->bindValue(':envrnt', $request['envrnt']);
          $stmt->bindValue(':email', $request['email']);
          if (isset($request['pwd'])) {
              $stmt->bindValue(':pwd', $request['pwd']);
          }
          $stmt->bindValue(':firstname', $request['firstname']);
          $stmt->bindValue(':lastname', $request['lastname']);
          $stmt->bindValue(':textaera', $request['textaera']);
          $stmt->bindValue(':speciality', $request['speciality']);
          $stmt->bindValue(':adr1', $request['adr1']);
          $stmt->bindValue(':adr2', $request['adr2']);
          $stmt->bindValue(':town', $request['town']);
          $stmt->bindValue(':cp', $request['cp']);
          $stmt->bindValue(':id', $id, PDO::PARAM_INT);
          
          if (!$stmt->execute()) {
              throw new Exception("Erreur lors de la mise à jour de l'utilisateur.");
          }

          /* ------------------- MAJ SKILLS ------------------- */
  
           /** Suppression des SKILLS actuelles */
        $queryDeleteSkills = "DELETE FROM has WHERE user_userId = :id";
        $stmtDeleteSkills = $this->getDb()->prepare($queryDeleteSkills);
        $stmtDeleteSkills->bindValue(':id', $id, PDO::PARAM_INT);

        if (!$stmtDeleteSkills->execute()) {
            throw new Exception("Erreur lors de la suppression des skills : " . implode(", ", $stmtDeleteSkills->errorInfo()));
        }

        /** Insertion des nouvelles SKILLS */
        if (!empty($request['skill_ids']) && is_array($request['skill_ids'])) {
            $queryInsertSkills = "INSERT INTO has (user_userId, skill_skillId) VALUES (:userId, :skillId)";
            $stmtInsertSkills = $this->getDb()->prepare($queryInsertSkills);

            foreach ($request['skill_ids'] as $skillId) {
                // Vérifie si le skillId est valide (non vide et un entier)
                if (!empty($skillId) && is_numeric($skillId)) {
                    $stmtInsertSkills->bindValue(':userId', $id, PDO::PARAM_INT);
                    $stmtInsertSkills->bindValue(':skillId', (int)$skillId, PDO::PARAM_INT); // Assurez-vous que skillId est un entier
                    
                    if (!$stmtInsertSkills->execute()) {
                        throw new Exception("Erreur lors de l'insertion des skills : " . implode(", ", $stmtInsertSkills->errorInfo()));
                    }
                } else {
                    throw new Exception("skillId non valide : " . htmlspecialchars($skillId));
                }
            }
        } else {
            echo "Aucune nouvelle compétence à ajouter.<br>";
        }


          /* ------------------- MAJ LINKS ------------------- */
  
          /** Suppression des LINKS actuels */
          $queryDeleteLinks = "DELETE FROM display WHERE user_userId = :id";
          $stmtDeleteLinks = $this->getDb()->prepare($queryDeleteLinks);
          $stmtDeleteLinks->bindValue(':id', $id, PDO::PARAM_INT);
  
          if (!$stmtDeleteLinks->execute()) {
              throw new Exception("Erreur lors de la suppression des links : " . implode(", ", $stmtDeleteLinks->errorInfo()));
          }
  
          /** Insertion des nouveaux LINKS */
          if (!empty($request['network_links']) && is_array($request['network_links'])) {
              $queryInsertLinks = "INSERT INTO display (user_userId, netw_networkId, netw_networkLink) VALUES (:userId, :networkId, :networkLink)";
              $stmtInsertLinks = $this->getDb()->prepare($queryInsertLinks);
  
              foreach ($request['network_links'] as $networkId => $networkLink) {
                  if (!empty($networkLink)) { // Vérifie que le lien n'est pas vide
                      $stmtInsertLinks->bindValue(':userId', $id, PDO::PARAM_INT);
                      $stmtInsertLinks->bindValue(':networkId', $networkId, PDO::PARAM_INT);
                      $stmtInsertLinks->bindValue(':networkLink', $networkLink, PDO::PARAM_STR);
  
                      if (!$stmtInsertLinks->execute()) {
                          throw new Exception("Erreur lors de l'insertion des links : " . implode(", ", $stmtInsertLinks->errorInfo()));
                      }
                  }
              }
          }
  
          // Commit des changements
          $this->getDb()->commit();
          echo 'Mise à jour des compétences et liens réussie.<br>';
  
          return true;
      } catch (Exception $e) {
          $this->getDb()->rollBack(); // Annule les changements en cas d'erreur
          die('Erreur SQL : ' . $e->getMessage());
      }
  }


/* 
private function updateUserSkills($userId, $skillIds)
{
    $queryDeleteSkills = "DELETE FROM has WHERE user_userId = :id";
    $stmtDeleteSkills = $this->getDb()->prepare($queryDeleteSkills);
    $stmtDeleteSkills->bindValue(':id', $userId, PDO::PARAM_INT);
    $stmtDeleteSkills->execute();

    if (!empty($skillIds) && is_array($skillIds)) {
        $queryInsertSkills = "INSERT INTO has (user_userId, skill_skillId) VALUES (:userId, :skillId)";
        $stmtInsertSkills = $this->getDb()->prepare($queryInsertSkills);
        foreach ($skillIds as $skillId) {
            $stmtInsertSkills->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmtInsertSkills->bindValue(':skillId', (int)$skillId, PDO::PARAM_INT);
            $stmtInsertSkills->execute();
        }
    }
}

private function updateUserLinks($userId, $links)
{
    $queryDeleteLinks = "DELETE FROM display WHERE user_userId = :id";
    $stmtDeleteLinks = $this->getDb()->prepare($queryDeleteLinks);
    $stmtDeleteLinks->bindValue(':id', $userId, PDO::PARAM_INT);
    $stmtDeleteLinks->execute();

    if (!empty($links) && is_array($links)) {
        $queryInsertLinks = "INSERT INTO display (user_userId, netw_networkId, netw_networkLink) VALUES (:userId, :networkId, :networkLink)";
        $stmtInsertLinks = $this->getDb()->prepare($queryInsertLinks);

        foreach ($links as $link) {
            if (!empty($link['id']) && !empty($link['url'])) {
                $stmtInsertLinks->bindValue(':userId', $userId, PDO::PARAM_INT);
                $stmtInsertLinks->bindValue(':networkId', (int)$link['id'], PDO::PARAM_INT);
                $stmtInsertLinks->bindValue(':networkLink', $link['url'], PDO::PARAM_STR);
                $stmtInsertLinks->execute();
            }
        }
    }
}
 */












  #   ----------  DELETE d'un USER ----------
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
