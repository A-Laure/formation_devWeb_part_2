<?php


class UserController
{

  # READALL - LISTE DES ETUDIANTS
  public function indexEtudiantList()
  {
    $model = new UserModel();
    $datas = $model->readAll();

    $userList = [];

    if (count($datas) > 0) {
      foreach ($datas as $data) {
        // Créer un utilisateur en ajoutant ses compétences et réseaux sous forme de tableau
        $user = new User($data);

        // Vérifier si 'skills' n'est pas null avant d'utiliser explode()
        $skills = isset($data['skills']) && $data['skills'] !== null ? explode(',', $data['skills']) : [];
        $user->setSkills($skills);

        // Vérifier si 'networks' n'est pas null avant d'utiliser explode()
        $networks = isset($data['networks']) && $data['networks'] !== null ? explode(',', $data['networks']) : [];
        $user->setNetworks($networks);

        $userList[] = $user;
      }
    }

    include 'MVC/views/users/user_list.php';
  }

  # READALL - Affichage de tous les étudiants
  public function indexEtudiantProfile()
  {
    $model = new UserModel();
    $datas = $model->readAll();

    $userList = [];

    if (count($datas) > 0) {
      foreach ($datas as $data) {
        $user = new User($data);
        $user->setSkills(isset($data['skills']) ? explode(',', $data['skills']) : []);
        $user->setNetworks(isset($data['networks']) ? explode(',', $data['networks']) : []);
        $userList[] = $user;
      }
    }

    include 'MVC/views/users/user_profile.php';
  }

  # READALL - LISTE DES ENTREPRISES
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

  # READALL - PROFILE DES ENTREPRISES
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


  public function create()
  {
    // Récupération des compétences techniques
    $skillsController = new SkillModel();
    $techskills = $skillsController->readAll();

    // Récupération des réseaux sociaux
    $networksController = new NetworkModel();
    $networks = $networksController->readAll();

    // Inclusion de la vue
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
    // DONNEES USER
    $model = new UserModel();
    $userEditDatas = $model->readOne($id);

    // Vérifie si l'utilisateur existe avant de créer l'objet
    if (empty($userEditDatas)) {
      // Redirection si l'utilisateur n'existe pas
      header('Location: index.php?ctrl=Error&action=notFound&message=' . urlencode("Utilisateur non trouvé"));
      exit;
    }

    // Instancie l'objet User avec les données récupérées
    $user = new User($userEditDatas);

    // Array skills User
    // Extraire les IDs des compétences de l'utilisateur
    $userSkills = !empty($userEditDatas['skills']) ? array_map('trim', explode(',', $userEditDatas['skills'])) : [];

    // Récupérer toutes les compétences disponibles pour affichage
    $skillModel = new SkillModel();
    $allSkills = $skillModel->readAll();

    // Array network User
    // Extraire les IDs des réseaux de l'utilisateur
    $userNetworks = !empty($userEditDatas['networks']) ? array_map('trim', explode(',', $userEditDatas['networks'])) : [];

    // Récupérer tous les réseaux disponibles pour affichage
    $networkModel = new NetworkModel();
    $allNetworks = $networkModel->readAll();

    // Inclure la vue et transmettre les données nécessaires
    include "MVC/views/users/user_edit.php";
  }




  # TRAITEMENT DU UPDATE - Récupère le $_POST  et le $_GET['id'] pour le transmettre au modèle, modifier les données et faire la redirection 
  public function update($id, $request)
  {
    echo 'UserCtrl, je suis rentré dans update';

    // Vérification des données et encryptage du mot de passe (à implémenter)

    $model = new UserModel();
    $upd = $model->update($id, $request);



    echo 'UserCtrl - Update step 1';

    if ($upd) {
      header('Location: index.php?ctrl=Dashboard&action=menu&_err=Votre  profil a bien été modifié');
    } else {
      header('Location: index.php?ctrl=Dashboard&action=edit&error');
    }
  }

  # TRAITEMENT DELETE - Récupère le $_POST et le $_GET['id'] pour le transmettre au modele, modifier les données et faire la redirection vers la liste des users
  public function delete($id)
  {

    $model = new UserModel;
    $del = $model->delete($id);

    if ($del) {
      header('Location: index.php?ctrl=Home&action=index&_err=Votre profil a bien été supprimé');
    } else {
      header('Location: index.php?ctrl=Dashboard&action=menu&_err= Suppression profil a échoué');
    }
  }
}
