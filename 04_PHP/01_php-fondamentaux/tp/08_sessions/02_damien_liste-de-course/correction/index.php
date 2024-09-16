<?php

  session_start();

  // unset($_SESSION['shop']);
  // session_destroy();

  /*

    Liste de course
    Créer une application pour gérer une liste de courses. Les utilisateurs pourront ajouter des
    articles avec leur quantité, afficher la liste des courses et supprimer les articles sélectionnés ou
    toute la liste.
  

    1. Nous allons créer un formulaire avec 2 champs de saisie et un bouton :

      - champ pour saisir le nom de l'article
      - champ pour saisir la quantité
      - un bouton pour ajouter a la liste

    2. Nous allons stocker les articles et quantités associées que nous saisissons (stockage en session)

    3. Nous affichons la liste sous forme d'un tableau HTML

    4. Supprimer toute la liste  

    5. Modifier le HTML en rajoutant un formulaire autour du talbeau, en ajoutant une checkbox devant chaque article de la liste et un bouton supprimer les éléments selectionnés afin de pouvoir soumettre les éléments souhaités ( on va suprrimer les éléments stockés en session)

  */

  $title = 'Liste de course | Session';


  include 'inc/head.php';
  include 'inc/navbar.php';
  include 'functions/_helpers/tools.php';
  include 'functions/functions.php';

  # initialise $_SESSION['shop']['shopList'], car au moment du premier ajout on le demande en argmument de la fonction addToList donc on a besoin qu'il existe sinon on aura un message d'erreur
  if(!isset($_SESSION['shop']['shopList'])){
    $_SESSION['shop']['shopList'] = [];
  }

  
  # On vérifie si on a eu une soumission de formulaire d'ajout, si oui on vérifie qu'on a bien de la données et on lance la fonction addToList()
  if(isset($_POST['article']) && isset($_POST['quantity']) ) {
    if($_POST['article'] != '' && is_numeric($_POST['quantity'])){
      addToList($_POST['article'], $_POST['quantity'], $_SESSION['shop']['shopList']);
      unset($_POST);
    }
  }

  #  # On vérifie si on a eu une soumission de formulaire de supression, si oui  on lance la fonction deleteToList()
  if(isset($_POST['products'])){
    deleteToList($_POST['products'], $_SESSION['shop']['shopList']);
  }
  

  # On supprime tout la liste des articles
  if(isset($_GET['reset'])){
    unset($_SESSION['shop']['shopList']);
    $page = $_SERVER['PHP_SELF'];
    header('Location: ' .$page);
  }


?>

<div class="container my-5">

  <h2 class="display-4 my-4">Ajouter un article</h2>
  <form action="" method="post" class="row g-3">
    <div class="col-auto">
      <input class="form-control" type="text" name="article" placeholder="Saisir un article">
    </div>
    <div class="col-auto">
      <input class="form-control" type="number" name="quantity" placeholder="Saisir une quantité">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
    </div>
  </form>

  <hr>

  <h2 class="display-4 my-4">Liste des courses</h2>
  

    <form action="" method="post">
      <div class="card p-4 border-0 shadow-sm">
        <table class="table">
        
          <thead>
            <tr>
              <th scope="col"></th>  
              <th scope="col">article</th>  
              <th scope="col">quantité</th>  
              <th scope="col">actions</th>  
            </tr>
          </thead>
          
            <tbody>
              <?php foreach($_SESSION['shop']['shopList'] as $product) : ?>
              <tr>
                <td scope="row" >
                  <input type="checkbox" name="products[]" value="<?= $product['article'] ?>">
                </td>
                <td><?= $product['article'] ?></td>
                <td><?= $product['quantity'] ?></td>
                <td>
                  <a href="userPage.php?id=" class="me-3" ><i class="bi bi-eye-fill"></i></a>
                  <a href="userEdit.php?id=" class="me-3" ><i class="bi bi-pencil-square"></i></a>
                  <a href="userDelete.php?id="><i class="bi bi-trash3-fill text-danger"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          
        </table>
      </div>

      <div class="d-flex my-5 gap-5">
        <input type="submit" class="btn btn-warning" value="Supprimer les articles sélectionnés">
        <a href="?reset" class="btn btn-danger">Supprimer toute la liste</a>
      </div>
    </form>            

  <!-- #### DEBUG #### -->
    <?php debug($_SESSION['shop']['shopList']);?>
    <?php debug($_POST);?>

  <!-- #### FIN DEBUG #### -->


</div>


<?php include 'inc/foot.php'; ?>
