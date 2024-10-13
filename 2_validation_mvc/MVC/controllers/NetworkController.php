<?php

class NetworksController
{

    # READALL - Affichage de tous les Networks
    public function index()  
    {

        $model = new NetworkModel();
        $datas = $model->readAll();
      /*   dump($datas,'Networkctrl - Index - $datas'); */
  
        $networkList = [];
        /* echo 'networkCtrl - Index, Count du nombre de données ds $datas : ' . count($datas); */
  
        
        if(count($datas) > 0)
        {
          
          foreach($datas as $data)
          {
            $networkList[] = new Networks($data);
            dump($networkList, 'networkCtrl - index'); 
          }
          return $networkList;
         
        }
  

      }
    
    # Recup de toutles compétences
    public function readAll()
    {
      
        $model = new NetworkModel();
        $datas = $model->readAll();
        echo 'je rentre bien la';
        $networkList = [];
        
        // Si $datas contient des données, créez des objets networks
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $networkList[] = new Networks($data);
                dump($networkList, "networkList");
            }
        }
        return $networkList;
    }

    

     # Affichage Formulaire CREATE skills
     public function create()
     {
         $networksController = new NetworksController();
         $networkList = $networksController->readAll(); // Récupère toutes les compétences
         
         include 'MVC/views/advert/advert_create.php';
          // Inclut la vue en lui passant $networkList
     }



      # TRAITEMENT DU CREATE - Récupère le $_POST pour le transmettre au modèle et faire la redirection vers la liste des users
    // public function store($request)
    // {

    //   # FAIRE VERIF DES DONNEES : droits, hmtl char, géré par validate static
    //   # FAIRE ENCRYPTAGE MDP

    //   $model = new SkillModel();
    //   $id = $model->create($request);

    //   if($id)
    //   {
    //     header('Location: index.php?ctrl=Home&action=index&adduser=success');
    //     exit;
    //   }
    //   else 
    //   {
        
    //     header('Location: index.php?ctrl=Home&action=index&adduser=error');
    //   }
    //   exit;

    // }

     #  Affichage du formulaire - UPDATE -avec les données d'un utilisateur
    //  public function edit($id)
    //  {
 
    //    $model = new SkillModel();
      
 
    //    include "MVC/views/skills/skills_edit.php";
 
    //  }


     # TRAITEMENT DU UPDATE - Récupère le $_POST  et le $_GET['id'] pour le transmettre au modèle, modifier les données et faire la redirection 
    public function update($id, $request)
    {
      echo 'UserCtrl, je suis rentré ds update';
      # FAIRE VERIF DES DONNEES
      # FAIRE ENCRYPTAGE MDP

      $model = new UserModel;
      $upd = $model->update($id, $request);

      $skillModel = new SkillModel();
      $datas = $skillModel->readAll();
      echo 'je rentre bien la';
      $skillList = [];
      
      // Si $datas contient des données, créez des objets Skills
      if (!empty($datas)) {
          foreach ($datas as $data) {
              $skillList[] = new Skills($data);
              dump($skillList, "skillList");
      echo 'UserCtrl - Update step 1';

      if($upd)
      {
        header('Location: index.php?ctrl=User&action=index&edituser=success');
      }
      else 
      {
        header('Location: MVC/views/users/user_list.php?edituser=error');
      } return $skillList;
          }
        }
    }
    

    # TRAITEMENT DELETE - Récupère le $_POST  et le $_GET['id'] 
    public function delete($id)
    {

      $model = new UserModel;
      $del = $model->delete($id);

      if($del)
      {
        header('Location: ./user_list.php?deleteuser=success');
      }
      else 
      {
        header('Location: ./user_list.php?deleteuser=error');
      }

    }
  }