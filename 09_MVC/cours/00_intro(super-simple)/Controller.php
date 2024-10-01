<?php 


  class Controller
  {

    public function action()
    {
      $model = new Model;
      $data = $model->getData();
      
      include 'view.php';
    }

  }