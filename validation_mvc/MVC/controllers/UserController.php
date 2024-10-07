<?php 

  class UserController 
  {

    

    # READALL - Affichage de tous les users
    public function index()  
    {

        $model = new UserModel();
        $datas = $model->readAll();
      /*   dump($datas,'Userctrl - Index - $datas'); */
  
        $userList = [];
        /* echo 'UserCtrl - Index, Count du nombre de données ds $datas : ' . count($datas); */
  
        
        if(count($datas) > 0)
        {
          
          foreach($datas as $data)
          {
            $userList[] = new User($data);
            
          }
         /*  dump($userList, 'UserCtrl - index - Foreach Object UserList'); */
        }
  
        include 'MVC/views/users/user_list.php';

      }
    

    

    # READONE - Affichage d'un utilisateur
    public function show($id)
    {

      $model = new UserModel();
      $datas = $model->readOne($id);

      if(count($datas) > 0)
      {
        $user = new User($datas);
      }

      include "../views/users/user_profile.php";

    }

     # Affichage Formulaire CREATE User
    public function create()
    {

      
      include 'MVC/views/users/user_create.php';
    }



      # TRAITEMENT DU CREATE - Récupère le $_POST pour le transmettre au modèle et faire la redirection vers la liste des users
    public function store($request)
    {

      # FAIRE VERIF DES DONNEES : droits, hmtl char, géré par validate static
      # FAIRE ENCRYPTAGE MDP

      $model = new UserModel;
      $id = $model->create($request);

      if($id)
      {
        header('Location: ./user_list.php?adduser=success');
      }
      else 
      {
        
        header('Location: ./user_list.php?adduser=error');
      }

    }

     #  Affichage du formulaire - UPDATE -avec les données d'un utilisateur
     public function edit($id)
     {
 
       $model = new UserModel();
       $userEditDatas = $model->readOne($id);
       dump($userEditDatas, 'UserCtrl - edit -  $userEditDatas');
 
       if(count($userEditDatas) > 0)
       {
         $userData = new User($userEditDatas);
         dump($userEditDatas, 'UserCtrl - edit -  $userData');

       }
 
       include "MVC/views/users/user_edit.php";
 
     }


     # TRAITEMENT DU UPDATE - Récupère le $_POST  et le $_GET['id'] pour le transmettre au modèle, modifier les données et faire la redirection 
    public function update($id, $request)
    {
      echo 'UserCtrl, je suis rentré ds update';
      # FAIRE VERIF DES DONNEES
      # FAIRE ENCRYPTAGE MDP

      $model = new UserModel;
      $upd = $model->update($id, $request);
      echo 'UserCtrl - Update step 1';

      if($upd)
      {
        header('Location: index.php?ctrl=User&action=index&edituser=success');
      }
      else 
      {
        header('Location: MVC/views/users/user_list.php?edituser=error');
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