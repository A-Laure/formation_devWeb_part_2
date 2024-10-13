<?php


class AdvertController
{

    # READALL - Affichage de tous les Adverts
    public function index()  
    {
        # On initialise la valeur de la page courante a 1
  $currentPage = 1;

  # Si il y a un parametre dans l'url (?page=numero-de-page => $_GET['page'])
  # IF : si $_GET['page'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['page'] dans $currentpage 
  if(!empty($_GET['page']) && ctype_digit($_GET['page']))
  {
    $currentPage = $_GET['page'];
  }

  # On initialise la valeur de la pagination a la valeur de la constante
  $pagination = PAGINATION;

  # Si il y a un parametre dans l'url (?pagination=nombre-de-message-par--page => $_GET['pagination'])
  # IF : si $_GET['pagination'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $pagination
  if(!empty($_GET['pagination']) && ctype_digit($_GET['pagination']))
  {
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
  if(!empty($_GET['order']))
  {
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
    
    # Recup de toutles compétences
    public function readAll(int $pagination, int $start = 0, string $orderBy = 'joba_jobContractType', string $order = 'DESC')
    {
        $model = new AdvertModel();
        $datas = $model->readAll($pagination, $start, $orderBy, $order);
        
        $advertList = [];
        
        // Si $datas contient des données, créez des objets Adverts
        if (!empty($datas)) {
            foreach ($datas as $data) {
               // Création d'un objet Advert pour chaque annonce
            $advert = new Advert($data); 
                // dump($advertList, "AdvertList");
                 // Transformation des champs `skills` et `networks` en tableaux
            $skills = isset($data['skills']) ? explode(',', $data['skills']) : [];
            // $networks = isset($data['networks']) ? explode(',', $data['networks']) : [];

            // Attribution des compétences et des réseaux à l'objet Advert
            $advert->setSkills($skills);
            // $advert->setNetworks($networks);

            // Ajout de l'objet complet à la liste
            $advertList[] = $advert;
            dump($advertList, 'AdvertCtrl -ReadAll'); 
                
            }
        }
        return $advertList;
    }

     # Affichage Formulaire CREATE Advert
    public function create()
    {
      $model = new SkillModel();
        $datas = $model->readAll();
        dump($datas,'Advertctrl - Create - $datas'); 
          
        $advertList = [];      
  
        
        if(count($datas) > 0)
        {
          
          foreach($datas as $data)
          {
            $advert = new Advert($data); 
           
            $skills = isset($data['skills']) ? explode(',', $data['skills']) : [];
            // $networks = isset($data['networks']) ? explode(',', $data['networks']) : [];

            // Assigne les compétences et réseaux à l'objet Advert
            $advert->setSkills($skills);
            // $advert->setNetworks($networks);
            $advertList[] = $advert;
            
          }
         dump($advertList, 'AdvertCtrl - Create - $advertList' ); 
        }

      
      include 'MVC/views/advert/advert_create.php';
    }



      # TRAITEMENT DU CREATE - Récupère le $_POST pour le transmettre au modèle et faire la redirection vers la liste des users
    public function store($request)
    {
      echo '<br>Je rentre dans store de AdvertCtrl</br><hr>';

      # FAIRE VERIF DES DONNEES : droits, hmtl char, géré par validate static
      # FAIRE ENCRYPTAGE MDP

      $model = new AdvertModel();
      $id = $model->create($request);

      if($id)
      {
        header('Location: index.php?ctrl=Advert&action=index&Création Advert avec Succés');
        exit;
      }
      else 
      {
        
        header('Location: index.php?ctrl=Advert&action=index&Création Advert a échoué');
      }
      exit;

    }

     #  Affichage du formulaire - UPDATE -avec les données d'un utilisateur
     public function edit($id)
     {
 
       $model = new AdvertModel();
       $advertEditDatas = $model->readOne($id);
       $advert = new Advert($advertEditDatas);
       dump($advertEditDatas, 'AdvertCtrl - edit -  $advertEditDatas');
 
       
       include "MVC/views/advert/advert_edit.php";
 
     }


     # TRAITEMENT DU UPDATE - Récupère le $_POST  et le $_GET['id'] pour le transmettre au modèle, modifier les données et faire la redirection 
    public function update($id, $request)
    {
      echo 'AdvertCtrl, je suis rentré ds update';
      # FAIRE VERIF DES DONNEES
      # FAIRE ENCRYPTAGE MDP

      $model = new AdvertModel;
      $upd = $model->update($id, $request);
      echo 'AdvertCtrl - Update step 1';

      if($upd)
      {
        header('Location: index.php?ctrl=Advert&action=index&_err=Modif Réalisée avec succés');
      }
      else 
      {
        header('Location: index.php?ctrl=Advert&action=index&_err=Modiféchouée');
      }

    }

    # TRAITEMENT DELETE - Récupère le $_POST  et le $_GET['id'] 
    public function delete($id)
    {

      $model = new AdvertModel;
      $del = $model->delete($id);

      if ($del) {
        header('Location: index.php?ctrl=Dashboard&action=index&_err=Votre annonce a bien été supprimé');
    } else {
        header('Location: index.php?ctrl=Dashboard&action=menu&_err= Suppression annonce a échoué');
    }

    }
  }