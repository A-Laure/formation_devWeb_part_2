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
    // Préparer la requête pour sélectionner un réseau par son ID
    $query = 'SELECT DISTINCT s.netw_networkId, s.netw_networkLabel 
              FROM display d 
              JOIN socialnetwork s ON s.netw_networkId = d.netw_networkId 
              WHERE d.user_userId = :id';

    try {
        // Préparer la requête
        $this->_req = $this->getDb()->prepare($query);

        // Lier le paramètre ID
        $this->_req->bindValue(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête
        if ($this->_req->execute()) {
            // Récupérer les données
            $datas = $this->_req->fetch(PDO::FETCH_ASSOC);
            return $datas; // Retourner les données
        }

        // Si aucune ligne n'est trouvée, retourner null
        return null;

    } catch (PDOException $e) {
        // Gérer les erreurs
        die('Erreur lors de la récupération du réseau : ' . $e->getMessage());
    }
}




}
