<?php

  $title = 'Liste des utilisateurs';
  $currentPage = 'users';

  require_once 'data/data.php';
  require_once 'functions/_helpers/tools.php';
  require_once 'functions/functions.php';
  include 'inc/head.php';
  include 'inc/navbar.php';


  # La pagination 
  /* 
    - Nombre d'utilsateur par page
    - Nombre d'utilsateur totales
    - Nombre total de page (Nombre d'utilsateur totales divivsé par Nombre d'utilsateur par page)(penser a arrondir)
    - Page actuelle/courante
    - Index de départ dans le tableau pour affiché en fonction de la page
    - Découpage du tablau en fonction de la page courante
    - Affichage des utilisateurs sur la page courante en fonction de l'index de départ
    - Affichage et logique de la navigation

  */

  #  Nombre d'utilsateur par page
  $userPerPage = 5;

  # Page actuelle/courante
  // $currentUsersPage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1;
  $currentUsersPage = $_GET['page'] ?? 1;
  
  # index de départ
  $startIndex = ($currentUsersPage - 1 ) * $userPerPage;

  /* 
    Exemple : 
      si on est sur la page 1 alors $currentUserPage = 1
        $startIndex = ( 1 - 1 ) * 5; donc $startIndex = 0 (on commence a l'index 0 de notre tableau)
        ($usersOnPage) sur la page 1 une on ira de 0 à 4 

      si on est sur la page 2 alors $currentUserPage = 2
        $startIndex = ( 2 - 1 ) * 5; donc $startIndex = 5 (on commence a l'index 5 de notre tableau)
        ($usersOnPage) sur la page 2 une on ira de 5 à 9 

      si on est sur la page 3 alors $currentUserPage = 3
        $startIndex = ( 3 - 1 ) * 5; donc $startIndex = 10 (on commence a l'index 10 de notre tableau)
        ($usersOnPage) sur la page 3 une on ira de 10 à 14 
  */

  # Les utilisateurs a afficher sur la page courante
  $usersOnPage = array_slice($users, $startIndex, $userPerPage);

  
  # Recherche par utilisateur
  $userSearch = $_GET['userSearch'] ?? '';

  $usersDisplay = [];

  foreach($users as $user){
    if(strtolower($user['firstname']) == strtolower($userSearch) || strtolower($user['lastname']) == strtolower($userSearch) || strtolower($user['job']) == strtolower($userSearch)){
      $usersDisplay[] = $user;
    }
  }

  $showUsers =  isset($_GET['userSearch']) ? $usersDisplay : $usersOnPage;

  # Nombre d'utilsateur totales
  $totalUsers = isset($_GET['userSearch']) ? count($usersDisplay) :count($users);

  # Nombre total de page
  $totalPages = ceil($totalUsers / $userPerPage);


?>


<h1 class="display-4 text-center my-5 pt-5" > Liste des utilisateurs</h1>

<div class="container w-75">
  <!-- l'attribut action n'est pas obligatoire si la donnée est transmise dans la meme page (exemple un get avec une recherche) et on met action="traitement.php" si on a un traitement/analyse a faire sur la donnee transmise -->
  <form class="d-flex justify-content-end my-4" role="search" method="get" >
    <input class="form-control me-2 w-25" type="search" placeholder="Rechercher" aria-label="Search" name="userSearch">
    <button class="btn btn-primary" type="submit">Rechercher</button>
  </form>
  <div class="card p-4 border-0 shadow-sm">
    
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Métier</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($showUsers as $user) : ?>
        <tr>
          <th scope="row"><?= $user['id'] ?></th>
          <td><?= $user['lastname'] ?></td>
          <td><?= $user['firstname'] ?></td>
          <td><?= $user['job'] ?></td>
          <td>
            <a href="userPage.php?id=<?= $user['id'] ?>" class="me-3" ><i class="bi bi-eye-fill"></i></a>
            <a href="userEdit.php?id=<?= $user['id'] ?>" class="me-3" ><i class="bi bi-pencil-square"></i></a>
            <a href="userDelete.php?id=<?= $user['id'] ?>"><i class="bi bi-trash3-fill text-danger"></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <p class="mt-2 ms-4"><?= $startIndex + 1 ?> - <?= ($startIndex + $userPerPage) > $totalUsers ? $totalUsers : $startIndex + $userPerPage ?> des <?= $totalUsers ?> utilisateurs</p>

    <?php if($totalUsers > $userPerPage) : ?>
      <nav aria-label="Page navigation example" >
        <ul class="pagination justify-content-end">
          <li class="page-item <?= $currentUsersPage == 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $currentUsersPage - 1 ?>">Précédent</a>
          </li>
          <?php for( $i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item">
              <a class="page-link <?= $currentUsersPage == $i ? 'active' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
          <li class="page-item <?= $currentUsersPage == $totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $currentUsersPage + 1 ?>">Suivant</a>
          </li>
        </ul>
      </nav>
    <?php endif; ?>

  </div>
  


</div>



<?php include 'inc/foot.php'; ?>