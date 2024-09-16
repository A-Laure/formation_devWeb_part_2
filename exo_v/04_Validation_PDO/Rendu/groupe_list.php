<?php
session_start();

$title = "groupeProfile";
$currentPage = "groupeProfile";

require_once 'lib/_helpers/tools.php';
require 'admin/config/config.php';
include 'inc/head.php';
// include 'inc/navBar.php';

?>



<?php

# Connexion à la BDD
$pdo = dbConnect();


# RECUP DE TOUTES LES INFOS LIEES A LA VILLE

try {

  $query = 'SELECT
  g.g_id, g_debuttravail, g_fintravail, 
  GROUP_CONCAT(DISTINCT n.n_nom) AS listenain,  
  ta.t_nom,
  tu.t_id, tu.t_progres,
  tu.t_villedepart_fk AS ville_depart,
  tu.t_villearrivee_fk AS ville_arrivee,
  v1.v_nom AS depart_nom,
  v2.v_nom AS arrivee_nom
FROM groupe g
LEFT JOIN nain n ON g.g_id = n.n_groupe_fk  
LEFT JOIN taverne ta ON g.g_taverne_fk = ta.t_id 
JOIN tunnel tu ON g_tunnel_fk = tu.t_id
LEFT JOIN ville v1 ON tu.t_villedepart_fk = v1.v_id
LEFT JOIN ville v2 ON tu.t_villearrivee_fk = v2.v_id
GROUP BY g.g_id, ta.t_nom
';




  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query)) !== false) {



    // echo '<pre>';
    //   echo 'LOG1';
    //   echo '</pre>';

    # on execute la requête
    if ($request->execute()) {

      // echo '<pre>';
      // echo 'LOG execute ok  ';
      // echo '</pre>';

      # On récupère et stocke le jeu de résultats au format tableau associatif
      $groupeAll = $request->fetchAll(PDO::FETCH_ASSOC);

      //  echo '<pre>';
      //     echo 'LOG $groupe ';
      //     echo var_dump ($groupeAll) ;
      //     echo '</pre>';

      // $villearriveeId = $ville['t_villearrivee_fk'];

      // echo '<pre>';
      // echo 'Log t_villearrivee_fk';
      // var_dump($villearriveeId);
      // echo '</pre>';

      # on termine le traitement de la requete
      $request->closeCursor();
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}




?>

<h1 class="text-align-center title">Profile Groupe </h1>

<div><a href="dashboard.php" class="n-container btn btn-primary mb-5">HOME</a></div>

<section class="n-container n-d-grid supplierList">

  <!-- CARD USER -->

  <?php foreach ($groupeAll as $groupe) : ?>
     <!-- AFFICHAGE TUNNEL FINI -->
     <?php if ($groupe['t_progres'] != 100) : ?>
        <?= $fini = '';
        $color = ''; ?>
      <?php elseif ($groupe['t_progres'] == 100) : ?>
        <?php $fini = 'TUNNEL FINI!!!';
        $color = 'text-success';
        ?>
      <?php endif; ?>

    <div class=" supplierCard n-col-4 ">     


        <h1 class=<?= $color?>><?=$fini?></h1>

      <h1>Groupe . <?= $groupe['g_id'] ?></h1>

      <h2 class="mt-5 fw-bold">Liste des Nains</h2>
      <p><?= $groupe['listenain'] ?></p>

      <h2 class="mt-3 fw-bold">Taverne :</h2>
      <p><?= $groupe['t_nom'] ?></p>

      <h2 class="mt-3 fw-bold">Horaires</h2>
      <p><?= 'De ' . $groupe['g_debuttravail'] . " à " . $groupe['g_fintravail'] ?></p>

      <h2 class="mt-3 fw-bold">Tunnel n° </h2>
      <p><?= $groupe['t_id'] ?></p>

      <h2 class="mt-3 fw-bold">Départ</h2>
      <p><?= $groupe['depart_nom'] ?></p>

      <h2 class="mt-3 fw-bold">Arrivée</h2>
      <p><?= $groupe['arrivee_nom'] ?></p>

      <h2 class="mt-3 fw-bold ">Progression : </h2>
      <p class="fw-bold <?=$color?>"><?= $groupe['t_progres'] . ' %' ?></p>

    </div>

  <?php endforeach; ?>



</section>


<?php
include 'inc/foot.php';
?>