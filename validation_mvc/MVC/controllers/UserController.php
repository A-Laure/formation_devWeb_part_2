<?php
session_start();


class UserController
{

    # --------------LES DIFFERENTS INDEX  -----------

    # 1 - INDEX PROFILE USER
    public function indexProfile()
    {
        $model = new UserModel();


        $userId = $_GET['id'] ?? null;  // Récupère l'ID de l'utilisateur depuis l'URL ou une autre source

        if ($userId) {
            $datas = $model->readOne($userId);

            $userList = [];

            if ($datas && count($datas) > 0) {

                $user = new User($datas);
                $user->setSkills(isset($datas['skills']) ? explode(',', $datas['skills']) : []);
                $user->setNetworks(isset($datas['networks']) ? explode(',', $datas['networks']) : []);
                $user->setLinks(isset($datas['links']) ? explode(',', $datas['links']) : []);
                $user->setAdverts(isset($datas['adverts']) ? explode(',', $datas['adverts']) : []);
                $userList[] = $user;
            }

            include 'MVC/views/users/user_profile.php';
        } else {
            echo "Aucun ID d'utilisateur n'a été fourni.";
        }
    }


    # 2 - Index - LISTE DES ETUDIANTS
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


    # --------------  3 -  INDEX - LISTE DES ENTREPRISES

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





    # ------------ 3 - READALL - PROFILE DES ENTREPRISES

    /*  public function indexEntrepriseProfile()
  {

    $model = new UserModel();
    $datas = $model->readAll(); */
    /*   dump($datas,'Userctrl - Index - $datas'); */

    //$userList = [];
    /* echo 'UserCtrl - Index, Count du nombre de données ds $datas : ' . count($datas); */

    /* 
    if (count($datas) > 0) {

      foreach ($datas as $data) {
        // Créer un utilisateur en ajoutant ses compétences et réseaux sous forme de tableau
        $user = new User($data);
        $userList[] = $user;
      } */

    /*  dump($userList, 'UserCtrl - index - Foreach Object UserList'); */


    /*   include 'MVC/views/users/user_profile.php';
    }
  } */



    #  -------  SHOW / READONE - Affichage d'un utilisateur
    /* 
  public function show($id)
  {

    $model = new UserModel();
    $user = $model->readOne($id);

    if (empty($user)) {
      header('Location: index.php?ctrl=Dashboard&action=menu&_err=Utilisateur non trouvé');
      exit;
  }

    // Récupération des réseaux et compétences
    $networkModel = new NetworkModel();
    $networkDatas = $networkModel->readOne($id); 
    $networkList = [];

      // Traitement des réseaux
      foreach ($networkDatas as $data) {
        $network = new Networks([
            'networkId' => (int)$data['netw_networkId'],
            'networkLabel' => $data['netw_networkLabel']
                ]);
        $networkList[] = $network;
    }
    $user->setNetworks($networkList);


    // Récupération des compétences
    $skillModel = new SkillModel();
    $skillDatas = $skillModel->readOne($id); 
    $skillList = [];
    
    // Traitement des compétences
    foreach ($skillDatas as $data) {
        $skill = new Skills([
            'skillId' => (int)$data['skill_skillId'],
            'skillLabel' => $data['skill_skillLabel']
        ]);
        $skillList[] = $skill;
    }
    $user->setSkills($skillList);

// Récupération des liens (links)
$displayModel = new DisplayModel();
$links = $displayModel->getLinksByUserId($id); 

// Ajoute les liens à l'objet utilisateur
$user->setLinks($links);  

// Affichage de la vue avec les données utilisateur complètes
include "MVC/views/users/user_profile.php";


} */

    /* --------------- CREATE AFFICHAGE DU FORMULAIRE--------------*/

    public function create()
    {
       
        $networkModel = new NetworkModel();
        $networkDatas = $networkModel->readAll();
        // dump($networkDatas, 'UserCtrl - Create - $networkDatas');

        $skillModel = new SkillModel();
        $skillDatas = $skillModel->readAll();
        // dump($skillDatas, 'UserCtrl - Create - $skillDatas');

        $networkList = [];
        $skillList = [];

        // Traitement des réseaux
        foreach ($networkDatas as $data) {
            $networkId = $data['netw_networkId'] ?? null;
            $networkLabel = $data['netw_networkLabel'] ?? null;
            $networkLink = $data['netw_networkLink'] ?? null;

            if ($networkId !== null && $networkLabel !== null) {
                $network = new Networks([
                    'networkId' => (int)$networkId,
                    'networkLabel' => $networkLabel,
                    'networkLink' => $networkLink
                ]);
                $networkList[] = $network;
            }
        }
        // dump($networkList, 'UserCtrl - Create - $networkList');

        // Traitement des compétences
        foreach ($skillDatas as $data) {
            $skillId = $data['skill_skillId'] ?? null;
            $skillLabel = $data['skill_skillLabel'] ?? null;

            if ($skillId !== null && $skillLabel !== null) {
                $skill = new Skills([
                    'skillId' => (int)$skillId,
                    'skillLabel' => $skillLabel
                ]);
                $skillList[] = $skill;
            }
        }
        // dump($skillList, 'UserCtrl - Create - $skillList');

        // Création de l'utilisateur avec réseaux et compétences
        $user = new User([]);
        $user->setNetworks($networkList);
        $user->setSkills($skillList);

        $userList = [$user];
        // dump($userList, 'UserCtrl - Create - $userList');

        include 'MVC/views/users/user_create.php';
    }


    # ------------STORE ---TRAITEMENT DU CREATE 

    //- Récupère le $_POST pour le transmettre au modèle et faire la redirection vers la liste des users
    public function store($request)
    {

        echo '<br>Je rentre dans store de UserCtrl</br><hr>';

        // Récupérer les données du formulaire
        $form_data = $request;

        // Si toutes les validations passent, vous pouvez procéder à l'enregistrement
        $model = new UserModel;
        $id = $model->create($form_data); // Utilisez les données validées


        if ($id) {
            unset($_SESSION['form_data']);
            // Supprimez les données de session après un succès
            header('Location: index.php?ctrl=Home&action=index&_err=Votre profil a bien été créé, vous pouvez vous déconnecter');
            exit;
        } else {
            // Ici, vous pouvez décider de garder les données si une autre erreur se produit
            // Par exemple, vous pouvez décider de garder $_SESSION['form_data'] pour que l'utilisateur puisse voir ce qu'il a entré.
            $_SESSION['form_data'] = $form_data; // Si une erreur d'enregistrement, effacez aussi
            header('Location: index.php?ctrl=Home&action=index&_err=Création User a échoué');
            exit;
        }
    }





    #  ----  EDIT/UPDATE-----AFFICHAGE DU FORMULAIRE  (avec les données d'un utilisateur)


    public function edit($id)
    {
        // Vérification de l'ID utilisateur
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            header('Location: index.php?ctrl=Dashboard&action=menu&_err=ID utilisateur non valide');
            exit;
        }

        // Récupération des données utilisateur
        $model = new UserModel();
        $userEditDatas = $model->readOne($id);

        if (empty($userEditDatas)) {
            header('Location: index.php?ctrl=Dashboard&action=menu&_err=Utilisateur non trouvé');
            exit;
        }

        /* --------------------- NETWORKS de la table socialnetwork--------------------- */
        $networkModel = new NetworkModel();
        $networkDatas = $networkModel->readAll();
        $networkList = [];

        if (is_array($networkDatas) && !empty($networkDatas)) {
            foreach ($networkDatas as $data) {
                // Vérification des clés attendues
                if (isset($data['netw_networkId'], $data['netw_networkLabel'])) {
                    $networkList[] = new Networks([
                        'networkId' => (int)$data['netw_networkId'],
                        'networkLabel' => $data['netw_networkLabel']
                    ]);
                } else {
                    echo "<br>Erreur 1 : Données de réseau incomplètes pour une entrée.<br></hr>";
                }
            }
        } else {
            echo "<br>Erreur 2 : Aucune donnée de réseau trouvée.<br></hr>";
        }

        // Stocke le résultat dans $userNetworkdatas pour l'envoyer à la vue
        $userNetworkdatas = $networkList;


        /* --------------------- LINKS de la table display--------------------- */
        $linksString = $userEditDatas['links'] ?? '';
        $linkList = array_filter(array_map('trim', explode(',', $linksString)));

        $networkIdsString = $userEditDatas['networkIds'] ?? '';
        $networkIdsList = is_string($networkIdsString) ? array_map('trim', explode(',', $networkIdsString)) : [];

        $linkObjects = [];
        if (count($linkList) === count($networkIdsList)) {
            foreach ($linkList as $index => $link) {
                if (!empty($link)) {
                    $linkObjects[] = new Display([
                        'userId' => (int)$userEditDatas['user_userId'],
                        'networkId' => (int)$networkIdsList[$index],
                        'networkLink' => $link
                    ]);
                }
            }
        } else {
            echo "Erreur : Le nombre de liens ne correspond pas au nombre d'IDs de réseaux.";
        }

        /* --------------------- SKILLS --------------------- */
        $skillsString = $userEditDatas['skills'] ?? '';
        $skillIdsString = $userEditDatas['skillIds'] ?? '';

        $skillList = is_string($skillsString) && !empty($skillsString) ? array_map('trim', explode(',', $skillsString)) : [];
        $skillIdsList = is_string($skillIdsString) && !empty($skillIdsString) ? array_map('trim', explode(',', $skillIdsString)) : [];

        $userSkills = [];
        foreach ($skillList as $index => $skill) {
            if (!empty($skill) && isset($skillIdsList[$index]) && is_numeric($skillIdsList[$index])) {
                $userSkills[] = new Skills([
                    'skillId' => (int)$skillIdsList[$index],
                    'skillLabel' => $skill
                ]);
            }
        }

        $techSkillModel = new SkillModel();
        $allSkills = $techSkillModel->readAll();
        $allSkills = is_array($allSkills) ? $allSkills : [];

        // Création de l'objet utilisateur avec réseaux, liens et compétences
        $user = new User($userEditDatas);
        $user->setNetworks($networkList);
        $user->setLinks($linkObjects);
        $user->setSkills($userSkills);

        // Passer les données à la vue, y compris $userNetworkdatas
        include "MVC/views/users/user_edit.php";
    }



    #  ----  UPDATE-----MAJ BDD du USER

    public function update($id, $request)
    {
        echo 'UserCtrl, je suis rentré dans update';

        // Vérification de l'email
        if (empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?ctrl=User&action=edit&_err=Adresse email non valide');
            exit;
        }

        // Hachage du mot de passe si présent
        if (!empty($request['pwd'])) {
            $request['pwd'] = password_hash($request['pwd'], PASSWORD_DEFAULT);
        } else {
            unset($request['pwd']); // Retire le mot de passe du tableau s'il est vide
        }

        // Création d'une instance du modèle utilisateur
        $model = new UserModel();
        $upd = $model->update($id, $request);

        echo 'UserCtrl - Update step 1';

        // Vérification du résultat de la mise à jour
        if ($upd) {
            header('Location: index.php?ctrl=Dashboard&action=menu&_err=Votre profil a bien été modifié');
        } else {
            header('Location: index.php?ctrl=Dashboard&action=edit&_err=Erreur lors de la mise à jour');
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
