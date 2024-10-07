<?php 


class AutorizationModel extends CoreModel
{
  
  
  private $_req;


  public function __destruct()
  {
    if(!empty($this->_req))
    {
      $this->_req->closeCursor();
    }
  }

// prepare quand donné dynamique saisie par un user
// query quand non tributaire d'une saisie

  public function readAll() : array
  {

    $sql = 'SELECT*
            FROM autorization';

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



