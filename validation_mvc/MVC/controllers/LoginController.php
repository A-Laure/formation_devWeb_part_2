<?php


class LoginController
{

  # ACCES A LA PAGE LOGIN 
  public function index()
  {
    // Chemin par rapport à "Index général"
    include 'MVC/views/log_in/login.php';
  }

  # CONNEXION
  public function login()
  {

    try {
      // que le constructeur qui se lance, hors pas de contructeur pour loginModel donc va voir dans CoreModel
      $loginModel = new LoginModel();

      // dump($loginModel, '$loginModel');

      // loginProcessing = action dans LoginModel 
      $_SESSION[APP_TAG]['connected'] = $loginModel->loginProcessing();

      // dump($_SESSION[APP_TAG]['connected'], 'Return sans le PWD de $_SESSION[APP_TAG][connected] dans LoginController - login');

      if (isset($_SESSION[APP_TAG]['connected'])) {
        header("Location: index.php?ctrl=Dashboard&action=menu");
        exit;
      } else {
        
        include 'index.php?ctrl=Login&action=index';
        // header("Location:../../index.php?ctrl=Login&action=index");

      }
    } catch (Exception $e) {
      throw new Exception($e->getMessage(), $e->getCode(), $e);
    }
  }
}
