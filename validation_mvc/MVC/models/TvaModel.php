<?php

class TvaModel extends CoreModel
{

  private $_req;

  # Invoquée quand l'objet est détruit ou que un script se termine, elle libère des ressources
  public function __destruct()
  {
    if (!empty($this->_req)) {
      $this->_req->closeCursor();
    }
  }

  # CREATE, le $request = le $_POST

  public function create($request)
  {
    echo '<br>TvaModel, je suis rentré ds Create</br><h
  r>';
    dump($_POST, '$_post dans TvaModel - Create');


    try {

      // Étape 1 : Vérifier si le tvas_label existe déjà
      $checkQuery = "SELECT COUNT(*) FROM tva WHERE tvas_label = :tvaLabel";
      $checkStmt = $this->getDb()->prepare($checkQuery);
      $checkStmt->bindValue(':tvaLabel', $request['tvaLabel']);
      $checkStmt->execute();

      if ($checkStmt->fetchColumn() > 0) {
        // Si le label existe déjà, renvoyer un message ou `false`
        echo 'Label déjà existant, insertion annulée';
        return false;
      }


      // Étape 2 : Si le label n'existe pas, insérer la nouvelle TVA
      // id auto_increment dc pas besoin de l'indiquer, fait automatiquement
      // date mettre dans phpMyDamin type : timestamp et valeur par défut current_timestamp()
      $query = "INSERT 
  INTO tva (tvas_label) 
  VALUES 
  (:tvaLabel)";

      if (($this->_req = $this->getDb()->prepare($query)) !== false) {
        if ((
          $this->_req->bindValue(':tvaLabel', $request['tvaLabel'])
        )) {
          if ($this->_req->execute()) {
            // lastInsertId : Retourne l'identifiant de la dernière ligne insérée, on peut du coup l'utiliser pour afficher un message, 'le user intel a bien été créé' ou autre utilisation
            $res = $this->getDb()->lastInsertId();
            return $res;
          }
        }
      }
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }
}
