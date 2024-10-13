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


  # READALL : Méthode pour récupérer tous les users 
  public function readAll(int $pagination, int $start = 0, string $orderBy = 'joba_jobContractType', string $order = 'DESC'): array
  {
    // Vérifier que les valeurs pour ORDER BY sont valides
    $validOrderBys = ['joba_jobAdvertId', 'joba_jobEmail', 'joba_jobLabel', 'joba_jobContractType', 'joba_jobDescription', 'joba_jobAdvantages', 'joba_jobTown'];
    $validOrders = ['ASC', 'DESC'];

    if (!in_array($orderBy, $validOrderBys) || !in_array($order, $validOrders)) {
      throw new InvalidArgumentException('Invalid order parameters');
    }


    /*  echo 'Je rentre dans la fonction readAll de AdvertModel '; */
    $query = 'SELECT
       j.joba_jobAdvertId,
       j.joba_jobEmail,
       j.joba_jobLabel, 
       j.joba_jobContractType,
       j.joba_jobDescription, 
       j.joba_jobAdvantages, 
       j.joba_jobTown,
      GROUP_CONCAT(DISTINCT t.skill_skillLabel ORDER BY t.skill_skillLabel) AS skills,
      GROUP_CONCAT(DISTINCT s.netw_networkLabel ORDER BY s.netw_networkLabel) AS networks
      FROM jobadvert j
      LEFT JOIN want w  ON w.joba_jobAdvertId =  j.joba_jobAdvertId
      LEFT JOIN techskills t on t.skill_skillId = w.skill_skillId
      LEFT JOIN needs n ON n.joba_jobAdvertId =  j.joba_jobAdvertId
      LEFT JOIN socialnetwork s on s.netw_networkId = n.netw_networkId   
      GROUP BY  j.joba_jobAdvertId
      ORDER BY ' . $orderBy . ' ' . $order . '
      LIMIT :start, :pagination
     
      ';

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

  # READONE : Méthode pour récupérer un user via Id
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
      t.skill_skillLabel,
      GROUP_CONCAT(DISTINCT t.skill_skillLabel ORDER BY t.skill_skillLabel) AS skills,
     GROUP_CONCAT(DISTINCT s.netw_networkLabel ORDER BY s.netw_networkLabel) AS networks
     FROM jobadvert j
     LEFT JOIN want w  ON w.joba_jobAdvertId =  j.joba_jobAdvertId
     LEFT JOIN techskills t on t.skill_skillId = w.skill_skillId
     LEFT JOIN needs n ON n.joba_jobAdvertId =  j.joba_jobAdvertId
     LEFT JOIN socialnetwork s on s.netw_networkId = n.netw_networkId 
     WHERE j.joba_jobAdvertId = :id  
     GROUP BY  j.joba_jobAdvertId
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
            echo '<br>4</br><hr>';
            return $res;
          }
        }
      }
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }



  # UPDATE d'un USER
  public function update($id, $request)
  {
    // echo '<br>AdvertModel, je suis rentré ds update</br><hr>';
    dump($_POST, '$_post dans Advertmodel - update');
    // echo 'AdvertModel - Update GET Id : ' . $_GET['id'];
    try {
      $query = "UPDATE jobadvert
     SET   
     joba_jobLabel = :joblabel,
     joba_jobEmail = :jobemail,
     joba_jobContractType = :jobcontracttype,
     joba_jobDescription = :jobdescription,
     joba_jobAdvantages = :jobadvantages,
     joba_jobStatus = :jobstatus,
     joba_jobTown = :jobtown,
    user_userId = :userid
     WHERE joba_jobAdvertId = :id";


      if (($this->_req = $this->getDb()->prepare($query)) !== false) {

        // echo '<br>AvertModel - update, je suis rentré ds prepare</br><hr>';



        if (($this->_req = $this->getDb()->prepare($query)) !== false) {
          if ((

            $this->_req->bindValue(':joblabel', $request['joblabel'])
            &&
            $this->_req->bindValue(':jobemail', $request['jobemail'])
            &&
            $this->_req->bindValue(':jobcontracttype', $request['jobcontracttype'])
            &&
            $this->_req->bindValue(':jobdescription', $request['jobdescription'])
            &&
            $this->_req->bindValue(':jobadvantages', $request['jobadvantages'])
            &&
            $this->_req->bindValue(':jobtown', $request['jobtown'])
            &&
            $this->_req->bindValue(':userid', $request['userid'])
            &&
            $this->_req->bindValue(':jobstatus', $request['jobstatus'])
            &&
            $this->_req->bindValue(':id', $id)

          ))
            if ($this->_req->execute()) {
              echo '<br>AdvertModel, je suis rentré ds execute</br><hr>';
              // Compte le nombre de lignes affectées par la requête, renvoi le nombre de lignes modfiées, si 0 -> pb, peut servir pour un renvoi de message
              echo '<br>AdvertModel, je suis avant le rowCount</br><hr>';
              $res = $this->_req->rowCount();
              echo '<br>AdvertModel, je suis après le rowCount</br><hr>' . $res;
              dump($res, 'AdvertModel, Update $res');
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
}
