<?php
session_start();


$title = "Tableau_de_Bord";
$currentPage = "t2bord";

require_once 'lib/_helpers/tools.php';
require 'admin/config/config.php';
include 'inc/head.php';
// include 'inc/navbar.php';



// Vérifie si l'un des champs est soumis et non vide
if (isset($_POST['nainform']) && !empty($_POST['nainform'])) {
  $nainName = $_POST['nainform'];
  header('Location: nain_profile.php?id=' . $nainName);
  exit;
} elseif (isset($_POST['villeform']) && !empty($_POST['villeform'])) {
  $villeName = $_POST['villeform'];
  header('Location: town_profile.php?id=' . $villeName);
  exit;
} elseif (isset($_POST['taverneform']) && !empty($_POST['taverneform'])) {
  $taverneName = $_POST['taverneform'];
  header('Location: tavern_profile.php?id=' . $taverneName);
  exit;
} elseif (isset($_POST['groupeform']) && !empty($_POST['groupeform'])) {
  $groupeName = $_POST['groupeform'];
  header('Location: groupe_profile.php?id=' . $groupeName);
  exit;
} else {
  echo 'no post';
}


# RECUP DES NAINS

try {
  # Connexion a la base 
  $pdo = dbConnect();

  $query = 'SELECT *  FROM nain';


  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query)) !== false) {

    # on execute la requête
    if ($request->execute()) {
      # On récupère et stocke le jeu de résultats au format tableau associatif
      $nainName = $request->fetchAll(PDO::FETCH_ASSOC);
      // echo '<pre>';
      // var_dump($nainName);
      // echo '</pre>';


      # on termine le traitement de la requete
      $request->closeCursor();
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}

# RECUP DES VILLES

try {
  # Connexion a la base 
  $pdo = dbConnect();

  $query = 'SELECT *  FROM ville';


  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request2 = $pdo->prepare($query)) !== false) {

    # on execute la requête
    if ($request2->execute()) {
      # On récupère et stocke le jeu de résultats au format tableau associatif
      $villeName = $request2->fetchAll(PDO::FETCH_ASSOC);
      // echo '<pre>';
      // var_dump($villeName);
      // echo '</pre>';


      # on termine le traitement de la requete
      $request2->closeCursor();
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}

# RECUP DES TAVERNES

try {
  # Connexion a la base 
  $pdo = dbConnect();

  $query = 'SELECT *  FROM taverne';


  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request3 = $pdo->prepare($query)) !== false) {

    # on execute la requête
    if ($request3->execute()) {
      # On récupère et stocke le jeu de résultats au format tableau associatif
      $taverneName = $request3->fetchAll(PDO::FETCH_ASSOC);
      // echo '<pre>';
      // var_dump($taverneName);
      // echo '</pre>';


      # on termine le traitement de la requete
      $request2->closeCursor();
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}

# RECUP DES GROUPES

try {
  # Connexion a la base 
  $pdo = dbConnect();

  $query = 'SELECT *  FROM groupe';


  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request4 = $pdo->prepare($query)) !== false) {

    # on execute la requête
    if ($request4->execute()) {
      # On récupère et stocke le jeu de résultats au format tableau associatif
      $groupeName = $request4->fetchAll(PDO::FETCH_ASSOC);
      // echo '<pre>';
      // var_dump($groupeName);
      // echo '</pre>';


      # on termine le traitement de la requete
      $request4->closeCursor();
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}



?>



<section class="container">


<h1>Sélectionner un item</h1>

  <form action="" method="post" class = "mt-5">

    <div class="mb-3">

      <!-- NAINS -->

      <label for="nainform" class="form-label fs-5 ">Choisir un Nain</label>
    
      <select name="nainform" id="nainform" class="form-select"  >
      <option selected default></option>
        <?php foreach ($nainName as $newnain) : ?>


          <!-- <option <?= $newnain['n_id'] ?> value="<?= $newnain['n_id'] ?>"><?= $newnain['n_nom'] ?></option> -->
          <option value="<?= $newnain['n_id'] ?>"><?= $newnain['n_nom'] ?></option>

        <?php endforeach; ?>
      </select>

      <!-- VILLES -->

      <label for="villeform" class="form-label fs-5">Choisir une ville</label>

      <select name="villeform" id="villeform" class="form-select">
      <option selected default></option>
        <?php foreach ($villeName as $newville) : ?>


          <!-- <option <?= $newville['v_id'] ?> value="<?= $newville['v_id'] ?>"><?= $newville['v_nom'] ?></option> -->
          <option value="<?= $newville['v_id'] ?>"><?= $newville['v_nom'] ?></option>

        <?php endforeach; ?>
      </select>

      <!-- TAVERNES -->

      <label for="taverneform" class="form-label fs-5">Choisir une  Taverne</label>

      <select name="taverneform" id="taverneform" class="form-select">
      <option selected default></option>
        <?php foreach ($taverneName as $newtaverne) : ?>


          <!-- <option <?= $newtaverne['t_id'] ?> value="<?= $newtaverne['t_id'] ?>"><?= $newtaverne['t_nom'] ?></option> -->
          <option  value="<?= $newtaverne['t_id'] ?>"><?= $newtaverne['t_nom'] ?></option>

        <?php endforeach; ?>
      </select>

      <!-- GROUPES -->

      <label for="groupeform" class="form-label fs-5">Choisir un  groupe</label>

      <select name="groupeform" id="groupeform" class="form-select">
      <option selected default></option>
        <?php foreach ($groupeName as $newgroupe) : ?>


          <!-- <option <?= $newgroupe['g_id'] ?> value="<?= $newgroupe['g_id'] ?>"><?= $newgroupe['g_id'] ?></option> -->
          <option value="<?= $newgroupe['g_id'] ?>"><?= $newgroupe['g_id'] ?></option>

        <?php endforeach; ?>
      </select>

    </div>

    <button type="submit" class="btn btn-primary edit-btn fs-3">Aller vers</button>
  </form>

  <a href="nain_list.php" class="btn btn-primary edit-btn fs-3">Liste des Nains</a>
  <a href="tavern_list.php" class="btn btn-primary edit-btn fs-3">Liste des Tavernes</a>
  <a href="town_list.php" class="btn btn-primary edit-btn fs-3">Liste des Villes</a>
  <a href="groupe_list.php" class="btn btn-primary edit-btn fs-3">Liste des Groupes</a>
  

</section>









<?php
include 'inc/foot.php';
?>