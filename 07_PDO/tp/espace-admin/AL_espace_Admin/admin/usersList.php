<?php
session_start();
//! SESSION SEULEMENT POUR LE USER CONNECTE, les autres on fera un foreach

$title = 'Users List';
$currentPage = 'users';

include '../inc/head.php';
include '../inc/navbar.php';
include '../lib/_helpers/tools.php';

?>

<div class="container my-5">

  <h1 class="my-5">Liste utilisateurs</h1>

  <!-- BOUTON CREATION USER MAIS UNIQUEMENT SUPER_ADMIN -->
  <?php if ($_SESSION['cem']['connected']['user']['role_id'] == 1) : ?>
    <a href="userCreate.php" type="button" class="btn btn-primary mb-3">Ajouter un User</a>
  <?php endif; ?>



  <div class="card p-4 border-0 shadow-sm">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">email</th>
          <th scope="col">Role</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>


        <?php

        // SI AU DESSUS OK, CONNEXION A LA BDD espace_admin 
        $dsn = 'mysql:host=localhost;	dbname=espace_admin;	charset=utf8';
        $userName = 'root';
        $passWord = '';

        try {
          $pdo = new PDO($dsn, $userName, $passWord, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

          // echo '<pre>';
          // echo 'Connexion réussie';
          // echo '<pre>';

          /*  Requête : tu vérifies dans la table users si tu as l'email AND le pwd, pour faire le test, on lui affacte des marqueurs
       - on affecte un marqueur (le ":email") à user_mail.
       - on affecte un marqueur (le ":pwd") à user_pwd.
      */
          $query2 = "SELECT * FROM users JOIN roles USING(`role_id`)";

          $stmt2 = $pdo->prepare($query2);

          // association du marqueur à la variable
          //$stmt2->bindValue(':email',$email); // on "associe" le marqueur à la variable)
          //$stmt2->bindValue(':pwd',$pwd); // on "associe" le marqueur à la variable)

          $stmt2->execute();

          # Tableau associatif qui se crée (transparent pour nous)
          $result2 = $stmt2->fetchALL(PDO::FETCH_ASSOC);

          // Suppression du mot de passe du tableau
          unset($result2['user_pwd']);

          // $result = [
          //   'user_id' => 1,
          //   'user_name' => 'A_LAure',
          //   'user_email' => 'alaure@gmail.com',
          //   'user_pwd' => 'toto',
          //   'role_id' => 1
          // ];


          // toutes les infos du user stocker dans :
          // Mais il faut pas reprendre le pwd


          // debug($result2);


          $_SESSION['cem']['error'] = 'Mauvais identifiant / mot de passe';
          // pas de RETURN , un RETURN vaut pour une fonction et arrête le scriptt

        } catch (PDOException $e) {
          echo 'Connexion échouée : ' . $e->getMessage();
        }

        ?>



        <!-- TABLEAU LISTE DES USERS -->
        <table>
          <?php foreach ($result2 as $user) : ?>
            <tr>
              <th scope="row"><?= $user['user_id'] ?></th>
              <td><?= $user['user_name'] ?></td>
              <td><?= $user['user_email'] ?></td>
              <td><?= $user['role_role'] ?></td>
              <!-- ACTIONS -->
              <td>
                <!-- VOIR -->
                <a href="userPage.php?id=<?= $user['user_id'] ?>" class="me-3"><i class="bi bi-eye-fill"></i></a>
                <!-- Edit -->
                <a href="userEdit.php?id=<?= $user['user_id'] ?>" class="me-3"><i class="bi bi-pencil-square"></i></a>
                <!-- DELETE -->
                <?php if ($_SESSION['cem']['connected']['user']['role_id'] == 1) : ?>
                  <a href="userDelete.php?id=<?= $user['user_id'] ?>"><i class="bi bi-trash3-fill text-danger"></i></a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>



  </div>




</div>


<?php include '../inc/foot.php'; ?>