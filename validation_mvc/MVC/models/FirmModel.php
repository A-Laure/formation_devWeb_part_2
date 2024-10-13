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
}
