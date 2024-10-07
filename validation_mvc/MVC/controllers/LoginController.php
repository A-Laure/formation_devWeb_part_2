<?php
session_start();

class LoginController{

 # ACCES A LA PAGE LOGIN 
 public function index()
 {
// Chemin par rapport à "Index général"
  include 'MVC/views/log_in/login.php';
 }

  # CONNEXION
  public function login()
  {

    try
    {
        // que le constructeur qui se lance, hors pas de contructeur pour loginModel donc va voir dans CoreModel
        $loginModel = new LoginModel();

        // dump($loginModel, '$loginModel');

        // loginProcessing = action dans LoginModel 
        $_SESSION[APP_TAG]['connected'] = $loginModel ->loginProcessing();

        dump($_SESSION[APP_TAG]['connected'], 'Return sans le PWD de $_SESSION[APP_TAG][connected] dans LoginController - login');

        if (isset($_SESSION[APP_TAG]['connected']))
        {
          
          //header("Location: index.php?ctrl=Dashboard&action=index");
          // header("Location: index.php?ctrl=User&action=index&id=1");
          if($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'etudiant')
          {
            header("Location: index.php?ctrl=User&action=index");
            exit; 
            
          }elseif ($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'entreprise')
          {
            header("Location: index.php?ctrl=Firm&action=index");
            exit; 
          }
          elseif ($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'admin')
          {
            header("Location: index.php?ctrl=User&action=index");
            exit; 
          }           
           
         
          
        } else{
         /* The line `include 'index.php?ctrl=Login&action=index';` is attempting to include the file
         `index.php` with query parameters `ctrl=Login&action=index`. However, using `include` in
         this way with query parameters is not the correct approach. */
          include 'index.php?ctrl=Login&action=index';
          // header("Location:../../index.php?ctrl=Login&action=index");
          
        }     
      } 
      catch(Exception $e)
      {
        throw new Exception($e->getMessage(), $e->getCode(), $e);
    }
  }
}





