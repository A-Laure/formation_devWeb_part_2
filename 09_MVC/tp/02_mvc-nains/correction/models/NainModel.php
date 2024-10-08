<?php


  class NainModel extends CoreModel
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

      $sql = 'SELECT n_id, n_nom FROM nain ORDER BY n_nom';

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

    public function readOne($idUrl) : array
    {

      $sql = 'SELECT nain.*, g_debuttravail, g_fintravail, g_taverne_fk, taverne.t_nom AS taverneNom, t_villedepart_fk, t_villearrivee_fk, origine.v_nom AS v_natale, depart.v_nom AS v_depart, arrivee.v_nom AS v_arrivee
              FROM `nain` 
              LEFT JOIN ville AS origine ON n_ville_fk = v_id 
              LEFT JOIN groupe ON n_groupe_fk = g_id
              LEFT JOIN taverne ON g_taverne_fk = taverne.t_id
              LEFT JOIN tunnel ON g_tunnel_fk = tunnel.t_id 
              LEFT JOIN ville AS depart ON t_villedepart_fk = depart.v_id
              LEFT JOIN ville AS arrivee ON t_villearrivee_fk = arrivee.v_id
              WHERE n_id = :idUrl';

      try{
        if(($this->_req = $this->getDb()->prepare($sql)) !== false)
        {
          if($this->_req->bindValue(':idUrl', $idUrl, PDO::PARAM_INT))
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