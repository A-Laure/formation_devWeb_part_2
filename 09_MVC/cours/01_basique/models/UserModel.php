<!--  --><?php

class UserModel extends CoreModel
{

  private $_req;


  public function __destruct()
  {
    if(!empty($this->_req))
    {
      $this->_req->closeCursor();
    }
  }


  # Méthode pour récupérer tous les users
  public function readAll()
  {
    try
    {

      if(($this->_req = $this->getDb()->query('SELECT use_id, use_login, use_role, rol_libelle, rol_pouvoir FROM user JOIN role ON use_role = rol_id')) !== false )
      {
        
        $datas = $this->_req->fetchAll(PDO::FETCH_ASSOC);

        return $datas;
      }

      return false;

    } catch(PDOException $e)
    {
      die($e->getMessage());
    }
  }




  # Méthode pour récupérer un user
  public function readOne($id)
  {

    try
    {

      if(($this->_req = $this->getDb()->prepare('SELECT use_id, use_login, use_role, rol_libelle FROM user JOIN role ON use_role = rol_id WHERE use_id = :id')) !== false)
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


  
  # Méthode pour créer un user (le $request = le $_POST)
  public function create($request)
  {

    try
    {
      $query = "INSERT INTO user (use_login, use_mdp, use_role) VALUES (:login, :mdp, 3)";

      if(($this->_req = $this->getDb()->prepare($query)) !== false) 
      {
        if(( $this->_req->bindValue(':login', $request['login']) && $this->_req->bindValue(':mdp', $request['pwd'])))
        {
          if($this->_req->execute())
          {
            $res = $this->getDb()->lastInsertId();
            return $res;
          }
        }
      }
    }
    catch(PDOException $e)
    {
      die($e->getMessage());
    }
  }

  # Méthode pour metter a jour un user
  public function update($id, $request)
  {

    try
    {
      $query = "UPDATE user SET use_login = :login WHERE use_id = :id";

      if(($this->_req = $this->getDb()->prepare($query)) !== false) 
      {
        if(( $this->_req->bindValue(':login', $request['login']) && $this->_req->bindValue(':id', $id)))
        {
          if($this->_req->execute())
          {
            $res = $this->_req->rowCount();
            return $res;
          }
        }
      }
    }
    catch(PDOException $e)
    {
      die($e->getMessage());
    }
  }

   # Méthode pour supprimer un user
   public function delete($id)
   {
 
     try
     {
      $query = "DELETE FROM user WHERE use_id = :id";
 
       if(($this->_req = $this->getDb()->prepare($query)) !== false)
       {
         if(($this->_req->bindValue(':id', $id, PDO::PARAM_INT)))
         {
           if($this->_req->execute())
           {
 
            $res = $this->_req->rowCount();
            return $res;
 
           }
         }
       }
 
 
     } catch(PDOException $e)
     {
       die($e->getMessage());
     }
 
   }


  
}