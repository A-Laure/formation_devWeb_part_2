<?php

class AdvertModel extends CoreModel
{


  private $_req;

  # Invoquée quand l'objet est détruit ou que un script se termine, elle libère des ressources
  public function __destruct()
  {
    if (!empty($this->_req)) {
      $this->_req->closeCursor();
    }
  }

  // Méthode pour compter tous les enregistrements dans la table `jobadvert`
  public function countAll(): int
  {
    $query = 'SELECT COUNT(*) as total FROM jobadvert';

    try {
      $stmt = $this->getDb()->prepare($query);
      if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['total'];
      }
    } catch (PDOException $e) {
      die($e->getMessage());
    }
    return 0;
  }


  #  -------------- READALL 
  
  public function readAll(
    int $pagination, 
    int $start = 0, 
    string $orderBy = 'joba_jobContractType', 
    string $order = 'DESC', 
    string $skills = '', 
    string $loc = ''
     ): array


  {
    // Vérifier que les valeurs pour ORDER BY sont valides
    $validOrderBys = ['joba_jobAdvertId', 'joba_jobEmail', 'joba_jobLabel', 'joba_jobContractType', 'joba_jobDescription', 'joba_jobAdvantages', 'joba_jobTown'];
    $validOrders = ['ASC', 'DESC'];

    if (!in_array($orderBy, $validOrderBys) || !in_array($order, $validOrders)) {
      throw new InvalidArgumentException('Invalid order parameters');
    }
  
    $query = 'SELECT
       j.joba_jobAdvertId,
       j.joba_jobEmail,
       j.joba_jobLabel, 
       j.joba_jobContractType,
       j.joba_jobDescription, 
       j.joba_jobAdvantages, 
       j.joba_jobTown,
       j.user_userId,
       j.joba_jobStatus,
      GROUP_CONCAT(DISTINCT t.skill_skillLabel ORDER BY t.skill_skillLabel) AS skills,
      GROUP_CONCAT(DISTINCT s.netw_networkLabel ORDER BY s.netw_networkLabel) AS networks,
      GROUP_CONCAT(DISTINCT d.netw_networkLink ORDER BY d.netw_networkLink) AS links
      FROM jobadvert j
      LEFT JOIN want w  ON w.joba_jobAdvertId =  j.joba_jobAdvertId      
      LEFT JOIN techskills t on t.skill_skillId = w.skill_skillId
      LEFT JOIN needs n ON n.joba_jobAdvertId =  j.joba_jobAdvertId
      LEFT JOIN socialnetwork s on s.netw_networkId = n.netw_networkId 
      LEFT JOIN display d ON w.joba_jobAdvertId =  j.joba_jobAdvertId  
      WHERE 1=1 '; // Toujours vrai pour simplifier l'ajout de conditions
     
      

      // Ajouter des conditions de filtre si des valeurs sont présentes
    if (!empty($skills)) {
      $query .= ' AND LOWER(t.skill_skillLabel) LIKE LOWER(:skills)';
  }
  if (!empty($loc)) {
      $query .= ' AND LOWER(j.joba_jobTown) LIKE LOWER(:loc)';
  }

  // Ajout de la clause GROUP BY et ORDER BY
  $query .= ' GROUP BY j.joba_jobAdvertId
              ORDER BY ' . $orderBy . ' ' . $order . '
              LIMIT :start, :pagination';

    try {
      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if (
          $this->_req->bindValue(':start', $start, PDO::PARAM_INT)
          && $this->_req->bindValue(':pagination', $pagination, PDO::PARAM_INT)
        )

          if ($this->_req->execute()) {
            $datas = $this->_req->fetchAll(PDO::FETCH_ASSOC);
            /* dump($datas,'AdvertModel Fetchall User ReadAll -> $datas return'); */
            return $datas;
          }
      }

      return false;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  # READONE : Méthode pour récupérer une advert via Id
  public function readOne($id)
  {
    try {

      $query = 'SELECT
    j.joba_jobAdvertId,
    j.joba_jobLabel, 
    j.joba_jobEmail,
    j.joba_jobContractType,
    j.joba_jobDescription, 
    j.joba_jobAdvantages, 
    j.joba_jobTown, 
    j.user_userId,
    j.joba_jobStatus,
    GROUP_CONCAT(DISTINCT t.skill_skillLabel ORDER BY t.skill_skillLabel) AS skills,
    GROUP_CONCAT(DISTINCT d.netw_networkLink ORDER BY d.netw_networkLink) AS links
FROM jobadvert j
LEFT JOIN want w ON w.joba_jobAdvertId = j.joba_jobAdvertId
LEFT JOIN techskills t ON t.skill_skillId = w.skill_skillId
LEFT JOIN needs n ON n.joba_jobAdvertId = j.joba_jobAdvertId
LEFT JOIN display d ON j.user_userId = d.user_userId
WHERE j.joba_jobAdvertId = :id  
GROUP BY 
    j.joba_jobAdvertId,
    j.joba_jobLabel, 
    j.joba_jobEmail,
    j.joba_jobContractType,
    j.joba_jobDescription, 
    j.joba_jobAdvantages, 
    j.joba_jobTown,
    j.user_userId,
    j.joba_jobStatus
     ';

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
    echo '<br>1</br><hr>';
    try {
      echo '<br>2</br><hr>';

      $query = "INSERT INTO jobadvert (
        joba_jobLabel, 
        joba_jobEmail,
        joba_jobContractType, 
        joba_jobDescription, 
        joba_jobAdvantages, 
        joba_jobTown, 
        joba_jobStatus,
        user_userId
    ) VALUES (
        :jobLabel, :jobEmail, :jobContractType, :jobDescription, :jobAdvantages, :jobTown, :jobStatus, :userId
        )";


      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if ((

          $this->_req->bindValue(':jobLabel', $request['jobLabel'])
          &&
          $this->_req->bindValue(':jobContractType', $request['jobContractType'])
          &&
          $this->_req->bindValue(':jobEmail', $request['jobEmail'])
          &&
          $this->_req->bindValue(':jobDescription', $request['jobDescription'])
          &&
          $this->_req->bindValue(':jobAdvantages', $request['jobAdvantages'])
          &&
          $this->_req->bindValue(':jobTown', $request['jobTown'])
          &&
          $this->_req->bindValue(':jobStatus', $request['jobStatus'])
          &&
          $this->_req->bindValue(':userId', $request['userId'])
        )) {
          if ($this->_req->execute()) {
            echo '<br>3</br><hr>';
            // lastInsertId : Retourne l'identifiant de la dernière ligne insérée, on peut du coup l'utiliser pour afficher un message, 'le user intel a bien été créé' ou autre utilisation
            $res = $this->getDb()->lastInsertId();
           
            if (!empty($request['skills'])) {
              $skillQuery = "INSERT INTO techskills (user_userId, skill_skillLabel) VALUES (:userId, :skill)";
              $skillStmt = $this->getDb()->prepare($skillQuery);
              foreach ($request['skills'] as $skill) {
                 
                  $skillStmt->bindValue(':skill', $skill);
                  $skillStmt->execute();
              }
          }

          // Étape 4 : Insertion dans la table `networks` (si des réseaux sont fournis)
          if (!empty($request['networks'])) {
              $networkQuery = "INSERT INTO network (user_userId, netw_networkLabel) VALUES (:userId, :network)";
              $networkStmt = $this->getDb()->prepare($networkQuery);
              foreach ($request['networks'] as $network) {
                
                  $networkStmt->bindValue(':network', $network);
                  $networkStmt->execute();
              }
          }
            return $res;
          }
        }
      }
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }



  # UPDATE d'une Advert
  public function update($id, $request)
{
    try {
        // Requête de mise à jour
        $query = "UPDATE jobadvert SET   
                    joba_jobLabel = :joblabel,
                    joba_jobEmail = :jobemail,
                    joba_jobContractType = :jobcontracttype,
                    joba_jobDescription = :jobdescription,
                    joba_jobAdvantages = :jobadvantages,
                    joba_jobStatus = :jobstatus,
                    joba_jobTown = :jobtown,
                    user_userId = :userid
                  WHERE joba_jobAdvertId = :id";

        // Préparation de la requête
        $stmt = $this->getDb()->prepare($query);

        // Liaison des valeurs avec les paramètres
        $stmt->bindValue(':joblabel', $request['joblabel']);
        $stmt->bindValue(':jobemail', $request['jobemail']);
        $stmt->bindValue(':jobcontracttype', $request['jobcontracttype']);
        $stmt->bindValue(':jobdescription', $request['jobdescription']);
        $stmt->bindValue(':jobadvantages', $request['jobadvantages']);
        $stmt->bindValue(':jobstatus', $request['jobstatus']);
        $stmt->bindValue(':jobtown', $request['jobtown']);
        $stmt->bindValue(':userid', $request['userid']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        if ($stmt->execute()) {
            // Vérifie si des lignes ont été modifiées
            $res = $stmt->rowCount();
            echo "<br>Nombre de lignes affectées : {$res}</br><hr>";
            return $res;
        }

    } catch (PDOException $e) {
        die('Erreur SQL : ' . $e->getMessage());
    }
}




  # DELETE
  public function delete($id)
  {
    try {
      $query = "DELETE FROM jobadvert WHERE joba_jobAdvertId = :id";

      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if (($this->_req->bindValue(':id', $id, PDO::PARAM_INT))) {
          if ($this->_req->execute()) {

            $res = $this->_req->rowCount();
            return $res;
          }
        }
      }
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function readFilter(string $skills, string $loc) : array  
  {

    // Si les deux champs sont vides, redirection avec message d'erreur
if (empty($skills) && empty($loc)) {
header('Location: index.php?ctrl=Advert&action=index&_err=Veuillez remplir au moins un champ');
exit;
}

    $skills = strtolower($skills);
    $loc = strtolower($loc);

    $skillsTest = !empty($skills) ? " LOWER(skill_skillLabel) LIKE '%$skills%' OR " : '';


    $query = "SELECT * 
    FROM jobadvert 
    WHERE $skillsTest LOWER(joba_jobTown) = :loc";

try {
if (($this->_req = $this->getDb()->prepare($query)) !== false) {
    
    if (!empty($skills)) {
        $this->_req->bindValue(':skills', "%$skills%", PDO::PARAM_STR);
    }
    $this->_req->bindValue(':loc', "%$loc%", PDO::PARAM_STR);  // Recherche de localisation

    if ($this->_req->execute()) {
        $datas = $this->_req->fetchAll();
        return $datas;  // Retourner les données des annonces filtrées
    }
}
return [];
} catch (PDOException $e) {
die($e->getMessage());
    }

  }


}


  

