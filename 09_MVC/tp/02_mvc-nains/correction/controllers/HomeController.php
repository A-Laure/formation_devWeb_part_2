<?php 


  class HomeController
  {

    public function index()
    {

      try {

        $nainModel = new NainModel();
        $datasNain = $nainModel->readAll();
        
        $villeModel = new VilleModel();
        $datasville = $villeModel->readAll();

        $groupeModel = new GroupeModel();
        $datasgroupe = $groupeModel->readAll();

        $taverneModel = new TaverneModel();
        $datastaverne = $taverneModel->readAll();

  
        foreach ($datasNain as $data) {
          $nains[] = new Nain($data);
        }
  
        foreach ($datasville as $data) {
          $villes[] = new Ville($data);
        }
  
        foreach ($datasgroupe as $data) {
          $groupes[] = new Groupe($data);
        }
  
        foreach ($datastaverne as $data) {
          $tavernes[] = new Taverne($data);
        }
  
        include 'views/index.php';
      } catch (Exception $e) {
        throw new Exception($e->getMessage(), $e->getCode(), $e);
      }

    }

  }