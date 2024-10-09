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

  # On initialise la valeur du trie,  
  $orderBy = 'joba_jobContractType';

  # Si il y a un parametre dans l'url (?orderBy=trie-id-date-auteur => $_GET['orderBy'])
  # IF : si $_GET['orderBy'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $orderBy
  if(!empty($_GET['orderBy']))
  {
    $orderBy = htmlspecialchars($_GET['orderBy']);
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

        $model = new AdvertModel();
        $datas = $model->readAll($pagination, $pagination * ($currentPage - 1), $orderBy, $order);
        // dump($datas,'Userctrl - Index - $datas'); 
  
        $advertList = [];
        // dump($advertList, 'AdvertCtrl - index - avant Foreach Object AdvertList'); 
  
        // /* echo 'AdvertCtrl - Index, Count du nombre de données ds $datas : ' . count($datas); *
  
        
        if(count($datas) > 0)
        {
          
          foreach($datas as $data)
          {
            $advert = new Advert($data);
            $advert->setSkills(explode(',', $data['skills'])); // Décompose la chaîne en tableau
            $advert->setNetworks(explode(',', $data['networks']));
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
                $advertList[] = new Advert($data);
                // dump($advertList, "AdvertList");
            }
        }
        return $advertList;
    }

     # Affichage Formulaire CREATE User
    public function create()
    {
     

      
      include 'MVC/views/advert/advert_create.php';
    }



      # TRAITEMENT DU CREATE - Récupère le $_POST pour le transmettre au modèle et faire la redirection vers la liste des users
    public function store($request)
    {

      # FAIRE VERIF DES DONNEES : droits, hmtl char, géré par validate static
      # FAIRE ENCRYPTAGE MDP

      $model = new AdvertModel();
      $id = $model->create($request);

      if($id)
      {
        header('Location: index.php?ctrl=Advert&action=index&adduser=success');
        exit;
      }
      else 
      {
        
        header('Location: index.php?ctrl=Advert&action=index&adduser=error');
      }
      exit;

    }

     #  Affichage du formulaire - UPDATE -avec les données d'un utilisateur
     public function edit($id)
     {
 
       $model = new AdvertModel();
       $AdvertEditDatas = $model->readOne($id);
       dump($AdvertEditDatas, 'AdvertCtrl - edit -  $AdvertEditDatas');
 
       if(count($AdvertEditDatas) > 0)
       {
         $AdvertData = new Advert($AdvertEditDatas);
         dump($AdvertEditDatas, 'AdvertCtrl - edit -  $AdvertData');

       }
 
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
        header('Location: index.php?ctrl=Advert&action=index&editAdvert=success');
      }
      else 
      {
        header('Location: MVC/views/Adverts/Advert_list.php?editAdvert=error');
      }

    }

    # TRAITEMENT DELETE - Récupère le $_POST  et le $_GET['id'] 
    public function delete($id)
    {

      $model = new AdvertModel;
      $del = $model->delete($id);

      if($del)
      {
        header('Location: MVC/views/Adverts/Advert_list.phpdeleteuser=success');
      }
      else 
      {
        header('Location: MVC/views/Adverts/Advert_list.phpdeleteuser=error');
      }

    }
  }