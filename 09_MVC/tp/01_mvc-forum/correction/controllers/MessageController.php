<?php


class MessageController
{

  public function index()
  {

    # On initialise la valeur de la page courante a 1
    $currentPage = 1;

    # Si il y a un parametre dans l'url (?page=numero-de-page => $_GET['page'])
    # IF : si $_GET['page'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['page'] dans $currentpage 
    if (!empty($_GET['page']) && ctype_digit($_GET['page'])) {
      $currentPage = $_GET['page'];
    }

    # On initialise la valeur de la pagination a la valeur de la constante
    $pagination = PAGINATION;

    if (!empty($_REQUEST['pagination']) && ctype_digit($_REQUEST['pagination'])) {
      $pagination = $_REQUEST['pagination'];
    }

    # On initialise la valeur du trie,  date par défault 
    $orderBy = 'date';

    if (!empty($_REQUEST['orderBy'])) {
      $orderBy = $_REQUEST['orderBy'];
    }

    # On initialise la valeur du trie,  date par défault 
    $order = 'DESC';

    if (!empty($_REQUEST['order'])) {
      $order = $_REQUEST['order'];
    }

    try {

      $msgModel = new MessageModel();
      $datas = $msgModel->readAll($_GET['conv'], $pagination, $pagination * ($currentPage - 1), $orderBy, $order);
      $nbMsg = $msgModel->countNbMessages($_GET['conv']);
      // debug($datas);

      if (count($datas) === 0) {
        header('Location: page404.php?_err=404');
        exit;
      }

      foreach ($datas as $data) {
        $messages[] = new Message($data);
      }

      // debug($messages);
    } catch (Exception $e) {
      header('Location: index.php?_err=500');
      exit;
    }

    include 'views/messages.php';
  }
}
