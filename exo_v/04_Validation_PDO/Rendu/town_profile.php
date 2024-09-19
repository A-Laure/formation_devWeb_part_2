<?php
session_start();

$title = "Liste des Villes";
$currentPage = "villeList";

require_once 'lib/_helpers/tools.php';
require 'admin/config/config.php';
include 'inc/head.php';
// include 'inc/navBar.php';

?>

<?php

# Connexion à la BDD
$pdo = dbConnect();

try {



  $query = 'SELECT
   v.v_nom, v.v_superficie, v.v_id,
   r.t_villedepart_fk,  r.t_villearrivee_fk, r.t_progres, 
  GROUP_CONCAT(DISTINCT n.n_nom) AS nainlist,
  GROUP_CONCAT(DISTINCT t.t_nom) AS tavernlist,
  t.t_nom
  FROM ville v
  JOIN taverne t ON v.v_id = t.t_ville_fk
  JOIN tunnel r ON v.v_id = r.t_villedepart_fk
  JOIN nain n ON n.n_ville_fk = v.v_id
  WHERE :idUrl= v.v_id
  ';



  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query)) !== false) {
    if ($request->bindValue(':idUrl', $_GET['id'])) {

      // echo '<pre>';
      //   echo 'LOG bindvalue';
      //   echo '</pre>';

      if ($request->execute()) {

        // echo '<pre>';
        // echo 'LOG execute ok  ';
        // echo '</pre>';

        # On récupère et stocke le jeu de résultats au format tableau associatif
        $town = $request->fetch(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // echo 'LOG town fetch   ';
        // var_dump($town);
        // echo '</pre>';


        # on termine le traitement de la requete
        $request->closeCursor();
      }
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}

# RECUP DU TUNNEL

try {

  $query2 = 'SELECT DISTINCT
 v1.v_nom,  
 v1.v_nom AS ville_depart, 
 v2.v_nom AS ville_arrivee
FROM nain n 
JOIN ville v1 ON n.n_ville_fk = v1.v_id 
JOIN tunnel t ON t.t_villedepart_fk = v1.v_id 
JOIN ville v2 ON t.t_villearrivee_fk = v2.v_id 
WHERE :idUrl= v1.v_id
  ';



  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query2)) !== false) {
    if ($request->bindValue('idUrl', $_GET['id'])) {

      // echo '<pre>';
      //   echo 'LOG bindvalue';
      //   echo '</pre>';

      if ($request->execute()) {

        // echo '<pre>';
        // echo 'LOG execute ok  ';
        // echo '</pre>';

        # On récupère et stocke le jeu de résultats au format tableau associatif
        $tunnel = $request->fetch(PDO::FETCH_ASSOC);

        //  echo '<pre>';
        // echo 'LOG tunnel fetch   ';
        // var_dump($tunnel);
        // echo '</pre>';


        # on termine le traitement de la requete
        $request->closeCursor();
      }
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}

?>

<h1 class="text-align-center title">Profile Ville</h1>

<div><a href="dashboard.php" class="n-container btn btn-primary mb-5">HOME</a></div>



<?php if ($town['t_progres'] == 100) : ?>
  <?php $fini = 'TUNNEL FINI!!!';
  $color = 'text-success';
  ?>
  <section class="n-container n-d-grid supplierList">

    <!-- CARD USER -->




    <div class=" supplierCard n-col-3">
      <h1 class='<?= $color ?>'><?= $fini ?></h1>
      <h1><?= $town['v_nom'] ?></h1>
      <h2 class="mt-5 fw-bold">Superficie</h2>
      <p><?= $town['v_superficie'] ?></p>
      <h3 class="mt-5 fw-bold">Liste des Tavernes</h3>
      <p><?= $town['tavernlist'] ?></p>
      <h3 class="mt-5 fw-bold">Liste des Nains</h3>
      <p><?= $town['nainlist'] ?></p>
      <h3 class="mt-5 fw-bold">Tunnel</h3>
      <p><?= $tunnel['ville_depart'] . ' à ' . $tunnel['ville_arrivee'] ?></p>

      <h3 class="mt-5 fw-bold">Progression</h3>
      <p><?= $town['t_progres'] . '%' ?></p>



    </div>


  </section>

<?php endif; ?>


<?php
include 'inc/foot.php';
?>