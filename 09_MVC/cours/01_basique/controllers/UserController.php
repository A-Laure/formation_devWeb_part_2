<?php 


  class UserController 
  {

    # READALL - Affichage des tous les users
    public function index()
    {

      $model = new UserModel();
      $datas = $model->readAll();

      $users = [];

      if(count($datas) > 0)
      {
        foreach($datas as $data)
        {
          $users[] = new User($data);
        }
      }

      include './views/user/index.php';

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

      include "./views/user/show.php";

    }

    # CREATE - Affichage d'un formulaire pour ajouter un user
    public function create()
    {
      include './views/user/create.php';
    }



    # TRAITEMENT DU CREATE - Récupère le $_POST pour le transmettre au modele et faire la redirection vers la liste des users
    public function store($request)
    {

      # FAIRE VERIF DES DONNEES
      # FAIRE ENCRYPTAGE MDP

      $model = new UserModel;
      $id = $model->create($request);

      if($id)
      {
        header('Location: ./index.php?adduser=success');
      }
      else 
      {
        header('Location: ./index.php?adduser=error');
      }

    }

     # UPDATE - Affichage d'un formualire avec les données d'un utilisateur
     public function edit($id)
     {
 
       $model = new UserModel();
       $datas = $model->readOne($id);
 
       if(count($datas) > 0)
       {
         $user = new User($datas);
       }
 
       include "./views/user/edit.php";
 
     }


     # TRAITEMENT DU UPDATE - Récupère le $_POST  et le $_GET['id'] pour le transmettre au modele, modifier les données et faire la redirection vers la liste des users
    public function update($id, $request)
    {

      # FAIRE VERIF DES DONNEES
      # FAIRE ENCRYPTAGE MDP

      $model = new UserModel;
      $upd = $model->update($id, $request);

      if($upd)
      {
        header('Location: ./index.php?edituser=success');
      }
      else 
      {
        header('Location: ./index.php?edituser=error');
      }

    }

    # TRAITEMENT DU UPDATE - Récupère le $_POST  et le $_GET['id'] pour le transmettre au modele, modifier les données et faire la redirection vers la liste des users
    public function delete($id)
    {

      $model = new UserModel;
      $del = $model->delete($id);

      if($del)
      {
        header('Location: ./index.php?deleteuser=success');
      }
      else 
      {
        header('Location: ./index.php?deleteuser=error');
      }

    }
     





  }