<?php

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

  public function readAll()
  {
    try
    {

      if(($this->_req = $this->getDb()->query('SELECT use_id, use_login, use_role, rol_libelle, rol_pouvoir FROM user JOIN role ON use_role = rol_id')) !== false )
      {
        
        $datas = $this->_req->fetchAll(PDO::FETCH_ASSOC);

        # on parcours le tableau associatif recu du jeu de donnees de la BDD pour transformer chaque user en objet de la classe User
        foreach($datas as $user){
          # au moment de l'instanciation de User on enregister les données dans chaque propriete de l'objet User (constructeur qui lance les setter via hydrate())
          $users[] = new User($user);
        }

        return $users;

      }

      return false;

    } catch(PDOException $e)
    {
      die($e->getMessage());
    }
  }

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
            // $user = new User($datas);
            // return $user;
            return new User($datas);

          }
        }
      }


    } catch(PDOException $e)
    {
      die($e->getMessage());
    }

  }



}