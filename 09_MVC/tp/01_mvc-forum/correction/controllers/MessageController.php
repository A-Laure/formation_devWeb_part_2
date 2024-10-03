<?php


  class MessageController
  {

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
        $pagination = $_GET['pagination'];
      }

      # On initialise la valeur du trie,  date par défault 
      $orderBy = 'date';

      # Si il y a un parametre dans l'url (?orderBy=trie-id-date-auteur => $_GET['orderBy'])
      # IF : si $_GET['orderBy'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $orderBy
      if(!empty($_GET['orderBy']))
      {
        $orderBy = $_GET['orderBy'];
      }

      # On initialise la valeur du trie,  date par défault 
      $order = 'DESC';

      # Si il y a un parametre dans l'url (?order=croissant-décroissant  => $_GET['order'])
      # IF : si $_GET['order'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $order
      if(!empty($_GET['order']))
      {
        $order = $_GET['order'];
      }


      try 
      {
        
        $msgModel = new MessageModel();
        $datas = $msgModel->readAll($_GET['conv'], $pagination, $pagination*($currentPage-1), $orderBy, $order);
        $nbMsg = $msgModel->countNbMessages($_GET['conv']);
        // debug($datas);
    
        if(count($datas) === 0)
        {
          header('Location: page404.php?_err=404');
          exit;
        }
    
    
        foreach($datas as $data)
        {
          $messages[] = new Message($data);
        }
    
        // debug($messages);
      }
      catch(Exception $e)
      {
        header('Location: index.php?_err=500');
        exit;
      }

      include 'views/messages.php';

    }


  }