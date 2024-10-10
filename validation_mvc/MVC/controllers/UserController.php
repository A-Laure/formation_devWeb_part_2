<?php

class UserController
{



  # READALL - Affichage de tous les étudiants
  public function indexEtudiantList()
  {
    $model = new UserModel();
    $datas = $model->readAll();

    $userList = [];

    if (count($datas) > 0) {
      foreach ($datas as $data) {
        $user = new User($data);

        // Créez une liste de Skills en fonction des données
        $skillsArray = [];
        foreach (explode(',', $data['skills']) as $skillLabel) {
          $skill = new Skills($data);
          $skill->setSkillLabel(trim($skillLabel)); // Définir le label de compétence
          $skillsArray[] = $skill;
        }

        // Associez la liste de compétences à l'utilisateur
        $user->setSkills($skillsArray);
        $userList[] = $user;
      }

      include 'MVC/views/users/user_list.php';
    }
  }

  # READALL - Affichage de tous les étudiants
  public function indexEtudiantProfile()
  {

    $model = new UserModel();
    $datas = $model->readAll();
    /*   dump($datas,'Userctrl - Index - $datas'); */

    $userList = [];
    /* echo 'UserCtrl - Index, Count du nombre de données ds $datas : ' . count($datas); */


    if (count($datas) > 0) {

      foreach ($datas as $data) {
        // Créer un utilisateur en ajoutant ses compétences et réseaux sous forme de tableau
        $user = new User($data);
        $user->setSkills(explode(',', $data['skills'])); // Décompose la chaîne en tableau
        $user->setNetworks(explode(',', $data['networks']));
        $userList[] = $user;
      }

      /*  dump($userList, 'UserCtrl - index - Foreach Object UserList'); */


      include 'MVC/views/users/user_profile.php';
    }
  }

  # READALL - Affichage de toutes les entreprises
  public function indexEntrepriseList()
  {

    $model = new UserModel();
    $datas = $model->readAll();
    /*   dump($datas,'Userctrl - Index - $datas'); */

    $userList = [];
    /* echo 'UserCtrl - Index, Count du nombre de données ds $datas : ' . count($datas); */


    if (count($datas) > 0) {

      foreach ($datas as $data) {
        // Créer un utilisateur en ajoutant ses compétences et réseaux sous forme de tableau
        $user = new User($data);        
        $userList[] = $user;
      }

      /*  dump($userList, 'UserCtrl - index - Foreach Object UserList'); */


      include 'MVC/views/users/firm_list.php';
    }
  }

# READALL - Affichage de toutes les entreprises
public function indexEntrepriseProfile()
{

  $model = new UserModel();
  $datas = $model->readAll();
  /*   dump($datas,'Userctrl - Index - $datas'); */

  $userList = [];
  /* echo 'UserCtrl - Index, Count du nombre de données ds $datas : ' . count($datas); */


  if (count($datas) > 0) {

    foreach ($datas as $data) {
      // Créer un utilisateur en ajoutant ses compétences et réseaux sous forme de tableau
      $user = new User($data);
      $userList[] = $user;
    }

    /*  dump($userList, 'UserCtrl - index - Foreach Object UserList'); */


    include 'MVC/views/users/user_profile.php';
  }
}



  # READONE - Affichage d'un utilisateur
  public function show($id)
  {

    $model = new UserModel();
    $datas = $model->readOne($id);

    if (count($datas) > 0) {
      $user = new User($datas);
    }

    include "../views/users/user_profile.php";
  }

  # Affichage Formulaire CREATE User
  public function create()
  {
    $skillsController = new SkillsController();
    $techskills = $skillsController->readAll();
    

    include 'MVC/views/users/user_create.php';
  }



  # TRAITEMENT DU CREATE - Récupère le $_POST pour le transmettre au modèle et faire la redirection vers la liste des users
  public function store($request)
  {
echo '<br>Je rentre dans store de UserCtrl</br><hr>';
    # FAIRE VERIF DES DONNEES : droits, hmtl char, géré par validate static
    # FAIRE ENCRYPTAGE MDP

    $model = new UserModel;
    $id = $model->create($request);

    if ($id) {
      header('Location: index.php?ctrl=Home&action=index&Création User avec Succés');
      exit;
    } else {

      header('Location: index.php?ctrl=Home&action=index&Création User a échoué');
    }
    exit;
  }

  #  Affichage du formulaire - UPDATE -avec les données d'un utilisateur
  public function edit($id)
  {

    $model = new UserModel();
    $userEditDatas = $model->readOne($id);
    dump($userEditDatas, 'UserCtrl - edit -  $userEditDatas');

    if (count($userEditDatas) > 0) {
      $userData = new User($userEditDatas);
      dump($userEditDatas, 'UserCtrl - edit -  $userData');
    } else {
      echo "Aucune donnée trouvée pour l'utilisateur avec l'ID $id.";
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

    if ($upd) {
      header('Location: index.php?ctrl=User&action=index&edituser=success');
    } else {
      header('Location: MVC/views/users/user_list.php?edituser=error');
    }
  }

  # TRAITEMENT DELETE - Récupère le $_POST et le $_GET['id'] pour le transmettre au modele, modifier les données et faire la redirection vers la liste des users
  public function delete($id)
  {

    $model = new UserModel;
    $del = $model->delete($id);
    dump($del);

  }
}
