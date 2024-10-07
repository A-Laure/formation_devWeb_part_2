<?php 

  class AutorizationController 
  {

    public function index()
    {

      try
      {

        $autoModel = new AutorizationModel();
        $datas = $autoModel->readAll();

        foreach($datas as $data)
        {
          $autorisations[] = new Autorization($data);

          
        }

        // include 'views/index.php';
      
      }
      catch(Exception $e)
      {
        throw new Exception($e->getMessage(), $e->getCode(), $e);
      }

    }

  }