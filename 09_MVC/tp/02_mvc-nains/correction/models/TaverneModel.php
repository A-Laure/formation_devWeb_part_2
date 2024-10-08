<?php


  class TaverneModel extends CoreModel
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

      $sql = 'SELECT t_id, t_nom FROM taverne ORDER BY t_nom';

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