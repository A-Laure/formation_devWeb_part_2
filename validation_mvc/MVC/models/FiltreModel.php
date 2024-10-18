<?php


  class FiltreModel extends CoreModel
  {
    
    
    private $_req;


    public function __destruct()
    {
      if(!empty($this->_req))
      {
        $this->_req->closeCursor();
      }
    }



    public function readFilter(string $skills, string $loc) : array  
    {

      // Si les deux champs sont vides, redirection avec message d'erreur
if (empty($skills) && empty($loc)) {
  header('Location: index.php?ctrl=Advert&action=index&_err=Veuillez remplir au moins un champ');
  exit;
}

      $skills = strtolower($skills);
      $loc = strtolower($loc);

      $skillsTest = !empty($skills) ? " LOWER(skill_skillLabel) LIKE '%$skills%' OR " : '';


      $query = "SELECT * 
      FROM jobadvert 
      WHERE $skillsTest LOWER(joba_jobTown) = :loc";

try {
  if (($this->_req = $this->getDb()->prepare($query)) !== false) {
      
      if (!empty($skills)) {
          $this->_req->bindValue(':skills', "%$skills%", PDO::PARAM_STR);
      }
      $this->_req->bindValue(':loc', "%$loc%", PDO::PARAM_STR);  // Recherche de localisation

      if ($this->_req->execute()) {
          $datas = $this->_req->fetchAll();
          return $datas;  // Retourner les données des annonces filtrées
      }
  }
  return [];
} catch (PDOException $e) {
  die($e->getMessage());
      }

    }
    }
