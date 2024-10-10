<?php

class DashboardController{


# ACCES AU MENU
public function menu()
{

  include 'MVC/views/dashboards/menu.php'; 
  }



# ACCES A LA PAGE DASHBOARD
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

  # On initialise la valeur du trie,  date par défault 
  $orderBy = 'item_label';

  # Si il y a un parametre dans l'url (?orderBy=trie-id-date-auteur => $_GET['orderBy'])
  # IF : si $_GET['orderBy'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $orderBy
  if(!empty($_GET['orderBy']))
  {
    $orderBy = htmlspecialchars($_GET['orderBy']);
  }

  # On initialise la valeur du trie,  date par défault 
  $order = 'DESC';

  # Si il y a un parametre dans l'url (?order=croissant-décroissant  => $_GET['order'])
  # IF : si $_GET['order'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $order
  if(!empty($_GET['order']))
  {
    $order = strtoupper($_GET['order']);
  }

try{
  $dashModel = new DashboardModel();

  // Récupération des données paginées
  $datas = $dashModel->readAll( $pagination,   
  $pagination*($currentPage-1), $orderBy, $order);
/*   dump($datas, 'DashboardCtrl'); */

  

  }
  /* dump($items, 'DashboardCtrl - Foreach Items'); */

      


catch(Exception $e)
{
  // Redirection vers une page d'erreur en cas de problème
  header('Location: index.php?_err=500');
  exit;

}
}
}