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



    public function readAll(int $idConv) : array
    {

      # REQUETE qui obtient les 20 derniers messages de la conversation choisie car on a transmit lors de l'appel de la méthode $idConv = valeur $_GET['conv']
      $sql = 'SELECT m_id AS id, DATE_FORMAT(m_date, "%d/%m/%Y") AS date, DATE_FORMAT(m_date, "%T") AS hour, CONCAT( u_nom," ",u_prenom) AS author, m_contenu AS message
              FROM message 
              LEFT JOIN user ON m_auteur_fk = u_id
              WHERE m_conversation_fk = :idConv 
              ORDER BY m_date DESC LIMIT 20
              ';

      try{
        if(($this->_req = $this->getDb()->prepare($sql)) !== false)
        {
          if($this->_req->bindValue(':idConv', $idConv, PDO::PARAM_INT))
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



  }