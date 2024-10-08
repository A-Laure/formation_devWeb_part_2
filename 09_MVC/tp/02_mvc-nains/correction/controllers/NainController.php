<?php


  class NainController 
  {

    public function show()
    {

      try {

        $nainModel = new NainModel();
        $datasNain = $nainModel->readOne($_POST['id']);
        
        $groupeModel = new GroupeModel();
        $datasgroupe = $groupeModel->readAll();

        foreach ($datasNain as $data) {
          $nain = new Nain($data);
        }

        foreach ($datasgroupe as $data) {
          $groupes[] = new Groupe($data);
        }

        include 'views/nain/profil.php';
      } catch (Exception $e) {
        throw new Exception($e->getMessage(), $e->getCode(), $e);
      }

    }

  }