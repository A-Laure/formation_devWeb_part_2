<?php


  class MessageModel extends CoreModel
  {
    
    
    private $_req;


    public function __destruct()
    {
      if(!empty($this->_req))
      {
        $this->_req->closeCursor();
      }
    }



    public function readAll(int $idConv, int $pagination, int $start = 0, string $orderBy = 'm_date', string $order = 'DESC') : array
    {

      $order = strtoupper($order);
      # Au cas ou quelqu'un modifierait la value dans le HTML
      if($order != 'ASC' && $order != 'DESC' )
      {
        $order = 'DESC';
      }

      $orderBy = strtolower($orderBy);
      # Au cas ou quelqu'un modifierait la value dans le HTML
      if($orderBy != 'id' && $orderBy != 'm_date' && $orderBy != 'author')
      {
        $orderBy = 'm_date';
      }


      # REQUETE qui obtient les 20 derniers messages de la conversation choisie car on a transmit lors de l'appel de la méthode $idConv = valeur $_GET['conv']
      $sql = "SELECT m_id AS id, DATE_FORMAT(m_date, '%d/%m/%Y') AS date, DATE_FORMAT(m_date, '%T') AS hour, CONCAT( u_nom,' ',u_prenom) AS author, m_contenu AS message
              FROM message 
              LEFT JOIN user ON m_auteur_fk = u_id
              WHERE m_conversation_fk = :idConv 
              ORDER BY $orderBy $order LIMIT :start, :pagination
              ";

      try{
        if(($this->_req = $this->getDb()->prepare($sql)) !== false)
        {
          if($this->_req->bindValue(':idConv', $idConv, PDO::PARAM_INT) 
          && $this->_req->bindValue(':start', $start, PDO::PARAM_INT)
          && $this->_req->bindValue(':pagination', $pagination, PDO::PARAM_INT)
          )
          {
            if($this->_req->execute())
            {
              $datas = $this->_req->fetchAll();
              return $datas;
            }
          }
        }
        return false;
      } 
      catch(PDOException $e)
      {
        die($e->getMessage());
      }             

    }


    # On peut faire une methode a part pour recuperer le nombre de message de la conversion 
    public function countNbMessages($idConv)
    {

      $sql = 'SELECT COUNT(m_id) AS nbMsg FROM message WHERE m_conversation_fk = :idConv';

      try{
        if(($this->_req = $this->getDb()->prepare($sql)) !== false)
        {
          if($this->_req->bindValue(':idConv', $idConv, PDO::PARAM_INT))
          {
            if($this->_req->execute())
            {
              $datas = $this->_req->fetch();
              return $datas;
            }
          }
        }
        return false;
      } 
      catch(PDOException $e)
      {
        die($e->getMessage());
      }

    }



  }