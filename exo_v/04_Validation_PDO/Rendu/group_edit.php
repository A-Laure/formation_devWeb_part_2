<?php
session_start();

$title = 'Edit group';
$currentPage = 'groupEdit';

require_once 'lib/_helpers/tools.php';
require 'admin/config/config.php';
include 'inc/head.php';
// include 'inc/navBar.php';



if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: user_list.php?_err=404');
  exit;
}

// echo '<pre>';
// echo 'GET  ';
// var_dump($_GET['id']);
// echo '</pre>';

try {

  # Connexion a la base 
  $pdo = dbConnect();

  $query = 'SELECT *
 FROM nain 
 JOIN groupe ON n_groupe_fk = g_id 
WHERE n_id = :idUrl
 ';



  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query)) !== false) {

    if ($request->bindValue(':idUrl', $_GET['id'])) {

      # on execute la requête
      if ($request->execute()) {
        # On récupère et stocke le jeu de résultats au format tableau associatif
        $nain = $request->fetch(PDO::FETCH_ASSOC);
        // echo '<pre>';
        //   echo 'LOG fetch   ';
        //   var_dump($nain);
        //   echo '</pre>';

        # on termine le traitement de la requete
        $request->closeCursor();
      }
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}


try {
  # Connexion a la base 
  $pdo = dbConnect();

  $query = 'SELECT * FROM groupe';

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  $request2 = $pdo->prepare($query);



  # on execute la requête
  if ($request2->execute()) {
    # On récupère et stocke le jeu de résultats au format tableau associatif
    $groupeAll = $request2->fetchAll(PDO::FETCH_ASSOC);
    # on termine le traitement de la requete
    $request2->closeCursor();
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}







# Modifier le groupe

if (!empty($_POST['groupe'])) {

  //  echo '<pre>';
  //     echo 'LOG POST  ';
  //     var_dump($_POST);
  //     echo '<pre>';

  try {

    # Connexion a la base 
    $pdo = dbConnect();

    $query = 'UPDATE nain SET n_groupe_fk = :form_group WHERE n_id = :idUrl';

    # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
    if (($request = $pdo->prepare($query)) !== false) {

      $request->bindValue(':form_group', $_POST['groupe']);
      $request->bindValue(':idUrl', $_GET['id']);

      # on execute la requête
      if ($request->execute()) {
        header('Location: nain_list.php?success=edit');
        exit;
      } else {
        header('Location: nain_list.php?_err=edit');
        exit;
      }
    }
  } catch (PDOException $e) {

    die($e->getMessage());
  }
}




?>



<h1 class="display-1 text-center my-5">Modifier le groupe</h1>

<div><a href="dashboard.php" class="n-container btn btn-primary mb-5">HOME</a></div>
<div class="container w-50">
  <div class="card p-4 border-0 shadow-sm">

    <form action="" method="post">

      <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" name="name" class="form-control" id="name" value="<?= $nain['n_nom'] ?>">
      </div>
      <div class="mb-3">
        <label for="groupe" class="form-label">Groupe</label>

        <select name="groupe" id="groupe" class="form-select">
          <?php foreach ($groupeAll as $newGroupe) : ?>


            <option <?= $newGroupe['g_id'] === $nain['n_groupe_fk'] ? 'selected' : '' ?> value="<?= $newGroupe['g_id'] ?>"><?= $newGroupe['g_id'] ?></option>

          <?php endforeach; ?>
        </select>
      </div>


      <button type="submit" class="btn btn-primary">Mettre à jour</button>

    </form>

  </div>


  <?php
  include 'inc/foot.php';
  ?>