<?php


  class ConversationModel extends CoreModel
  {
    
    
    private $_req;


    public function __destruct()
    {
      if(!empty($this->_req))
      {
        $this->_req->closeCursor();
      }
    }



    public function readAll() : array
    {

      $sql = 'SELECT c_id AS id, DATE_FORMAT(c_date, "%d/%m/%Y") AS date, DATE_FORMAT(c_date, "%T") AS hour, c_termine AS status, COUNT(m_id) AS nbMsg
              FROM conversation
              LEFT JOIN message ON c_id = m_conversation_fk
              GROUP BY c_id';

      try{
        if(($this->_req = $this->getDb()->query($sql)) !== false)
        {
          $datas = $this->_req->fetchAll();
          return $datas;
        }
        return false;
      } 
      catch(PDOException $e)
      {
        die($e->getMessage());
      }             

    }



  }