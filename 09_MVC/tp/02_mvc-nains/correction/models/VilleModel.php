<?php


  class VilleModel extends CoreModel
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

      $sql = 'SELECT v_id, v_nom FROM ville ORDER BY v_nom';

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