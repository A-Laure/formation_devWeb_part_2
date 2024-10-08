<?php


  class GroupeModel extends CoreModel
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

      $sql = 'SELECT g_id FROM groupe ORDER BY g_id';

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