<?php


  class DashboardModel extends CoreModel
  {
    
    
    private $_req;


    public function __destruct()
    {
      if(!empty($this->_req))
      {
        $this->_req->closeCursor();
      }
    }



    public function readAll(int $pagination, int $start = 0, string $orderBy = 'item_label', string $order = 'DESC') : array
    {


      // Sécurisation des valeurs de tri : Au cas ou quelqu'un modifierait la value dans le HTML
      $order = strtoupper($order);      
      if($order != 'ASC' && $order != 'DESC' )
      {
        $order = 'DESC';
      }

      // Ajout d'autres colonnes autorisées
      // $allowedOrderBy = ['item_label', 'item_ref', 'item_puht']; 
      // if (!in_array($orderBy, $allowedOrderBy)) {
      //     $orderBy = 'item_label';
      // }

  // Requête SQL avec tri et pagination
      $query = "SELECT  
      i.item_Id AS item_idItem, i.item_label AS item_labelItem, i.item_ref, i.item_puht, i.item_cdt, 
      t.tvas_label AS tvas_labelTva ,
      r.stor_qty AS stor_storeQty, r.stor_stockSecurity,
      s.sppl_name AS sppl_nameSppl, s.sppl_contact, s.sppl_phoneContact, s.sppl_orderEmail,
      d.addr_adr1 AS addr_adr1Sppladr,d.addr_adr2 AS addr_adr2Sppladr, d.addr_cp AS addr_cpSppladr, d.addr_town AS addr_townSppladr,  d.addr_country AS addr_countrySppladr,
      x.stck_place, x.stck_label AS stck_labelStock    
      FROM item i
      LEFT JOIN tva t ON i.tvas_Id = t.tvas_Id
      LEFT JOIN propose p ON i.item_Id = p.item_Id
      LEFT JOIN supplier s ON s.sppl_Id = p.sppl_Id
      LEFT JOIN sppladr d ON d.sppl_Id = s.sppl_Id
      LEFT JOIN store r ON i.item_Id = r.item_Id  
      LEFT JOIN stock x ON r.stck_Id = x.stck_Id
      ORDER BY $orderBy $order
      LIMIT :start, :pagination
      ";

      try{
        if(($this->_req = $this->getDb()->prepare($query)) !== false)
        {
          // if($this->_req->bindValue(':idItem', $idItem, PDO::PARAM_INT) 
         // && 
          if($this->_req->bindValue(':start', $start, PDO::PARAM_INT)
          && $this->_req->bindValue(':pagination', $pagination, PDO::PARAM_INT)
          )
          {
            if($this->_req->execute())
            {
              $datas = $this->_req->fetchAll();
              /* dump($datas, 'FetchAll DashboardModel'); */
              return $datas;
            
            }
          }
        }
        // Retourner un tableau vide en cas d'échec
        return [];
      } 
      catch(PDOException $e)
      {
        throw new Exception('Erreur lors de la récupération des données : ' . $e->getMessage());
      }             

    }


    public function countNbItem()
    {
        $query = 'SELECT COUNT(item_Id) AS nbItem FROM item'; // Requête pour compter les items
    
        try {
            // Préparation de la requête
            if(($this->_req = $this->getDb()->prepare($query)) !== false) {
                
                // Exécution de la requête
                if($this->_req->execute()) {
                  // Récupère les résultats
                    $datas = $this->_req->fetch(PDO::FETCH_ASSOC); 
                    // Retourne le nombre d'items
                   /*  echo '<br>Count item dans DashboardModel: ' . $datas['nbItem'] . '</br><hr>';  */
                }
                    return $datas['nbItem'];
                    
            }
            // Si la requête échoue
            return false; 
        } 
        catch(PDOException $e) {
           // Gestion de l'erreur
           throw new Exception('Erreur lors du comptage des items : ' . $e->getMessage());
        }
    }


    public function countNbUser()
    {
        $query = 'SELECT COUNT(user_Id) AS nbuser FROM user'; // Requête pour compter les users
    
        try {
            // Préparation de la requête
            if(($this->_req = $this->getDb()->prepare($query)) !== false) {
                
                // Exécution de la requête
                if($this->_req->execute()) {
                  // Récupère les résultats
                    $datas = $this->_req->fetch(PDO::FETCH_ASSOC); 
                    // Retourne le nombre d'users
                   /*  echo '<br>Count user dans DashboardModel: ' . $datas['nbuser'] . '</br><hr>'; */ 
                }
                    return $datas['nbuser'];
                    
            }
            // Si la requête échoue
            return false; 
        } 
        catch(PDOException $e) {
           // Gestion de l'erreur
           throw new Exception('Erreur lors du comptage des users : ' . $e->getMessage());
        }
    }


    public function countNbSppl()
    {
        $query = 'SELECT COUNT(sppl_Id) AS nbsppl FROM supplier'; // Requête pour compter les sppls
    
        try {
            // Préparation de la requête
            if(($this->_req = $this->getDb()->prepare($query)) !== false) {
                
                // Exécution de la requête
                if($this->_req->execute()) {
                  // Récupère les résultats
                    $datas = $this->_req->fetch(PDO::FETCH_ASSOC); 
                    // Retourne le nombre d'sppls
                    /* echo '<br>Count sppl dans DashboardModel: ' . $datas['nbsppl'] . '</br><hr>';  */
                }
                    return $datas['nbsppl'];
                    
            }
            // Si la requête échoue
            return false; 
        } 
        catch(PDOException $e) {
           // Gestion de l'erreur
           throw new Exception('Erreur lors du comptage des sppls : ' . $e->getMessage());
        }
    }
    



  }