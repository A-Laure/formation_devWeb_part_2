<?php
session_start();

class AdvertController
{

  # READALL - Affichage de tous les Adverts
  public function index()
  {

    
    /* dump($_POST, '$Post'); */
    # On initialise la valeur de la page courante a 1
    $currentPage = 1;

    # Si il y a un parametre dans l'url (?page=numero-de-page => $_GET['page'])
    # IF : si $_GET['page'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['page'] dans $currentpage 
    if (!empty($_GET['page']) && ctype_digit($_GET['page'])) {
      $currentPage = $_GET['page'];
    }

    # On initialise la valeur de la pagination a la valeur de la constante
    $pagination = PAGINATION;

    # Si il y a un parametre dans l'url (?pagination=nombre-de-message-par--page => $_GET['pagination'])
    # IF : si $_GET['pagination'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $pagination
    if (!empty($_GET['pagination']) && ctype_digit($_GET['pagination'])) {
      $pagination = (int) $_GET['pagination'];
    }

    # Tri par défaut
    $orderBy = 'joba_jobContractType';
    if (!empty($_GET['orderBy'])) {
      $orderBy = htmlspecialchars($_GET['orderBy']);
    }

    $order = 'DESC';
    if (!empty($_GET['order'])) {
      $order = strtoupper($_GET['order']);
    }

    # On initialise la valeur du trie,  
    $order = 'DESC';

    # Si il y a un parametre dans l'url (?order=croissant-décroissant  => $_GET['order'])
    # IF : si $_GET['order'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $order
    if (!empty($_GET['order'])) {
      $order = strtoupper($_GET['order']);
    }

    try {

      $advertModel = new AdvertModel();
      $skillModel = new SkillModel();

      # Récupération du nombre total d'annonces
      $totalAdverts = $advertModel->countAll();
      //  echo '<br>Nbre d annonces : ' . $totalAdverts . '<br><hr>';

      # Calcul du nombre total de pages
      $totalPages = ceil($totalAdverts / $pagination);
      //  echo  '<br>Nbre pages total : ' . $totalPages  . '<br><hr>';

      # Validation de la page courante
      if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
        // echo '<br>Page courante : ' . $currentPage  . '<br><hr>';
      } elseif ($currentPage < 1) {
        $currentPage = 1;
        // echo '<br>Page courante : ' . $currentPage  . '<br><hr>';
      }

      # Récupération des annonces pour la page actuelle
      $datas = $advertModel->readAll($pagination, $pagination * ($currentPage - 1), $orderBy, $order);


      // Récupération de toutes les compétences
      $allSkills = $skillModel->readAll();

      $advertList = [];

      if (!empty($datas)) {
        foreach ($datas as $data) {
          $advert = new Advert($data);

          // Créez une liste de Skills en fonction des données
          $skillsArray = [];

          foreach (explode(',', $data['skills']) as $skillLabel) {
            $skill = new Skills($data);
            $skill->setSkillLabel(trim($skillLabel)); // Définir le label de compétence
            $skillsArray[] = $skill;
          }

          // Associez la liste de compétences à l'annonce
          $advert->setSkills($skillsArray);
          $advertList[] = $advert;
        }
      }


      // dump($advertList, 'AdvertCtrl - index - Foreach Object AdvertList'); 

      include 'MVC/views/advert/advert_list.php';
    } catch (Exception $e) {
      // Gestion des erreurs
      die($e->getMessage());
    }
  }

  public function show($id)
  {
      try {
          // Créez des instances des modèles nécessaires
          $advertModel = new AdvertModel();
          $skillModel = new SkillModel();      
  
          // Récupération de l'annonce par son ID
          $advertData = $advertModel->readOne($id);
  
          // Vérifiez si des données ont été récupérées
          if (!empty($advertData)) {
              // Créez un objet Advert à partir des données récupérées
              $advert = new Advert($advertData);
  
              // Créez une liste de Skills en fonction des données
              $skillsArray = [];
              foreach (explode(',', $advertData['skills']) as $skillLabel) {
                  $skill = new Skills();
                  $skill->setSkillLabel(trim($skillLabel)); 
                  $skillsArray[] = $skill;
              }
  
              // Associez la liste de compétences à l'annonce
              $advert->setSkills($skillsArray);
          } else {
              // Gérer le cas où aucune annonce n'est trouvée
              throw new Exception("Aucune annonce trouvée avec l'ID: $id");
          }
  
         
          include 'MVC/views/advert/advert_detail.php';
      } catch (Exception $e) {
         
          die($e->getMessage());
      }
  }
  


  /*  ----------READALL FUNCTION ------- */

  # Recup de toutles compétences
/*   public function readAll(int $pagination, int $start = 0, string $orderBy = 'joba_jobContractType', string $order = 'DESC')
{
    $model = new AdvertModel();
    $datas = $model->readAll($pagination, $start, $orderBy, $order);

    $advertList = [];

    if (!empty($datas)) {
        foreach ($datas as $data) {
            $advert = new Advert($data);

            $skills = isset($data['skills']) ? explode(',', $data['skills']) : [];
            $networks = isset($data['links']) ? explode(',', $data['links']) : [];

            $advert->setSkills($skills);
            $advert->setNetworks($networks);

            // Vérifiez les réseaux pour confirmer l'attribution
            dump($advert->getNetworks(), 'AdvertCtrl - ReadAll - networks');

            $advertList[] = $advert;
        }
    }

    return $advertList;
} */




/*  ----------CREATE FUNCTION ------- */

  # Affichage Formulaire CREATE Advert
  public function create()
  {
    $networkModel = new NetworkModel();
    $networkDatas = $networkModel->readAll();
    // dump($networkDatas, 'AdvertCtrl - Create - $networkDatas');

    $skillModel = new SkillModel();
    $skillDatas = $skillModel->readAll();
    // dump($skillDatas, 'AdvertCtrl - Create - $skillDatas');

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
// dump($networkList, 'AdvertCtrl - Create - $networkList');

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
// dump($skillList, 'AdvertCtrl - Create - $skillList');

// Création de l'utilisateur avec réseaux et compétences
$advert = new Advert([]);
$advert->setNetworks($networkList);
$advert->setSkills($skillList);

$advertList = [$advert];
// dump($advertList, 'AdvertCtrl - Create - $advertList');
    


    include 'MVC/views/advert/advert_create.php';
  }

/*  ----------TRAITEMENT CREATE FUNCTION ------- */

  # TRAITEMENT DU CREATE - Récupère le $_POST pour le transmettre au modèle et faire la redirection vers la liste des users
  public function store($request)
  {
    echo '<br>Je rentre dans store de AdvertCtrl</br><hr>';

    # FAIRE VERIF DES DONNEES : droits, hmtl char, géré par validate static
    # FAIRE ENCRYPTAGE MDP

    $model = new AdvertModel();
    $id = $model->create($request);

    if ($id) {
      header('Location: index.php?ctrl=Advert&action=index&Création Advert avec Succés');
      exit;
    } else {

      header('Location: index.php?ctrl=Advert&action=index&Création Advert a échoué');
    }
    exit;
  }


/*  ----------EDIT FUNCTION ------- */

  #  Affichage du formulaire - UPDATE -avec les données d'un utilisateur
  public function edit($id) {
    $model = new AdvertModel();
    $advertEditDatas = $model->readOne($id);
    
    // Vérifie que les données sont valides avant de les envoyer à la vue
    if (!$advertEditDatas) {
        header('Location: index.php?ctrl=Advert&action=index&_err=Annonce introuvable');
        exit;
    }

    $advert = new Advert($advertEditDatas);
    dump($advertEditDatas, 'AdvertCtrl - edit -  $advertEditDatas');
    dump($advert, 'AdvertCtrl - edit -  $advert');

    include "MVC/views/advert/advert_edit.php";
}


/*  ----------TRAITEMENT EDIT FUNCTION ------- */


  # TRAITEMENT DU UPDATE - Récupère le $_POST  et le $_GET['id'] pour le transmettre au modèle, modifier les données et faire la redirection 
  public function update($id, $request)
  {
    echo 'AdvertCtrl, je suis rentré ds update';
    # FAIRE VERIF DES DONNEES
    # FAIRE ENCRYPTAGE MDP

    $model = new AdvertModel;
    $upd = $model->update($id, $request);
    echo 'AdvertCtrl - Update step 1';

    if ($upd) {
      header('Location: index.php?ctrl=Advert&action=index&_err=Modif Réalisée avec succés');
    } else {
      header('Location: index.php?ctrl=Advert&action=index&_err=Modiféchouée');
    }
  }

  # TRAITEMENT DELETE - Récupère le $_POST  et le $_GET['id'] 
  public function delete($id)
  {

    $model = new AdvertModel;
    $del = $model->delete($id);
    // dump($del);

    // if ($del) {
    //   header('Location: index.php?ctrl=Dashboard&action=index&_err=Votre annonce a bien été supprimée');
    //   exit;
    // } else {
    //   header('Location: index.php?ctrl=Dashboard&action=menu&_err= Suppression annonce a échoué');
    //   exit;
    // }
  }


  public function filtre() {
    try {
        // Vérifiez la session ici
        if (!isset($_SESSION[APP_TAG]['connected'])) {
            header('Location: index.php?ctrl=User&action=login&_err=Pas de session connectée');
            exit;
        }

        $skills = $_GET['skills'] ?? '';
        $loc = $_GET['loc'] ?? '';

        if (empty($skills) && empty($loc)) {
            header('Location: index.php?ctrl=Advert&action=index&_err=Veuillez remplir au moins un champ pour la recherche.');
            exit;
        }

$advertModel = new AdvertModel();

// Logique de filtrage

$datas = $advertModel->readFilter($skills, $loc); // Assurez-vous que cette méthode existe et est correctement implémentée

if ($datas) {
    // Inclure la vue avec les données filtrées
    include 'MVC/views/advert/advert_list.php';
} else {
    // Aucune annonce trouvée
    header('Location: index.php?ctrl=Advert&action=index&_err=Aucune annonce trouvée.');
    exit;
}
        
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage(); // ou logger l'erreur
    }
}


  
}
