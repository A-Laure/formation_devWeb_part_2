<?php

class FirmModel extends CoreModel
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

    try {

      // Étape 1 : Vérifier si l'email' existe déjà
      $checkQuery = "SELECT COUNT(*) FROM user WHERE user_email = :email";
      $checkStmt = $this->getDb()->prepare($checkQuery);
      $checkStmt->bindValue('email', $request['email']);
      $checkStmt->execute();

      if ($checkStmt->fetchColumn() > 0) {
        // Si l'email' existe déjà, renvoyer un message ou `false`
        echo 'mail déjà existant, insertion annulée';
        return false;
      }

      // Étape 2 : Si le label n'existe pas, insérer la nouvelle TVA
      // id auto_increment dc pas besoin de l'indiquer, fait automatiquement
      // date mettre dans phpMyDamin type : timestamp et valeur par défut current_timestamp()

      // !Manque un morceau pour récup du rôle que l'on verra ds exo


      $query = "INSERT INTO user (user_firstName, user_lastName, user_email, user_pwd, role_Id) VALUES (:firstName, :lastName,:email, :pwd, :roleId)";

      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if ((

          $this->_req->bindValue(':firstName', $request['firstName'])
          &&
          $this->_req->bindValue(':lastName', $request['lastName'])
          &&
          $this->_req->bindValue(':email', $request['email'])
          &&
          $this->_req->bindValue(':pwd', $request['pwd'])

          &&
          $this->_req->bindValue(':roleSelect', $request['roleSelect'])
        )) {
          if ($this->_req->execute()) {
            // lastInsertId : Retourne l'identifiant de la dernière ligne insérée, on peut du coup l'utiliser pour afficher un message, 'le user intel a bien été créé' ou autre utilisation
            $res = $this->getDb()->lastInsertId();
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
      die($e->getMessage());
    }
  }
}
