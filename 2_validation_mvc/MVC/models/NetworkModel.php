<?php

class NetworkModel extends CoreModel
{

  private $_req;


  public function __destruct()
  {
    if (!empty($this->_req)) {
      $this->_req->closeCursor();
    }
  }


# READAll
public function readAll(): array
{
  $query = 'SELECT * FROM socialnetwork';

  try {
    if (($this->_req = $this->getDb()->query($query)) !== false) {
      $networksAll = $this->_req->fetchAll(PDO::FETCH_ASSOC); // Utilisez FETCH_ASSOC pour un tableau associatif
      
      return $networksAll;
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

# READONE
   public function readOne($id)
   {
 
     try
     {
 
       if(($this->_req = $this->getDb()->prepare('SELECT *
        FROM socialnetwork
        WHERE netw_networkId = :id')) !== false)
       {
         if(($this->_req->bindValue(':id', $id, PDO::PARAM_INT)))
         {
           if($this->_req->execute())
           {
 
             $datas = $this->_req->fetch(PDO::FETCH_ASSOC);
 
             return $datas;
 
           }
         }
       }
 
     } catch(PDOException $e)
     {
       die($e->getMessage());
     }
 
   }



}
