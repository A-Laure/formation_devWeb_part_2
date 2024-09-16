<?php
session_start();

$title = "Liste des Nains";
$currentPage = "nainList";

require_once 'lib/_helpers/tools.php';
require 'admin/config/config.php';
include 'inc/head.php';
// include '../../../inc/navBarBootstrap.php';

?>



<?php

 # Connexion à la BDD
 $pdo = dbConnect();
 
 
 try {

  $query = 'SELECT
  n.n_id, n.n_nom, n.n_barbe,  
  v.v_nom, v.v_id,
  t.t_nom,
  g.g_id, g.g_debuttravail, g.g_fintravail 
  FROM nain n
  RIGHT JOIN ville v ON n.n_ville_fk = v.v_id
  JOIN taverne t ON t.t_ville_fk = v.v_id
  RIGHT JOIN groupe g ON n.n_groupe_fk  = g.g_id
  WHERE :idUrl= n.n_id';
  
  

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query)) !== false) {

    if($request->bindValue('idUrl', $_GET['id'])){

    // echo '<pre>';
    //   echo 'LOG bindvalue';
    //   echo '</pre>';

    # on execute la requête
    if ($request->execute()) {

      // echo '<pre>';
      // echo 'LOG execute ok  ';
      // echo '</pre>';

      # On récupère et stocke le jeu de résultats au format tableau associatif
      $nain = $request->fetch(PDO::FETCH_ASSOC);

      // echo '<pre>';
      // echo 'LOG nain fetch   ';
      // var_dump($nain);
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

  $query2 = 'SELECT
  n.n_nom,  
  v1.v_nom AS ville_depart, 
  v2.v_nom AS ville_arrivee
FROM nain n 
JOIN ville v1 ON n.n_ville_fk = v1.v_id 
JOIN tunnel t ON t.t_villedepart_fk = v1.v_id 
JOIN ville v2 ON t.t_villearrivee_fk = v2.v_id 
WHERE :idUrl= n.n_id';
  
  

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query2)) !== false) {

    if($request->bindValue('idUrl', $_GET['id'])){

    // echo '<pre>';
    //   echo 'LOG bindvalue';
    //   echo '</pre>';

    # on execute la requête
    if ($request->execute()) {

      // echo '<pre>';
      // echo 'LOG execute ok  ';
      // echo '</pre>';

      # On récupère et stocke le jeu de résultats au format tableau associatif
      $nainVille = $request->fetch(PDO::FETCH_ASSOC);

      // echo '<pre>';
      // echo 'LOG nain fetch   ';
      // var_dump($nain);
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

<h1 class="text-align-center title">Profile Nain </h1>

<div><a href="dashboard.php" class="n-container btn btn-primary mb-5">HOME</a></div>

<section class="n-container n-d-grid supplierList">

  <!-- CARD USER -->


    <div class=" supplierCard n-col-3">

    <h1><?=$nain['n_nom'] ?></h1>

    <h2 class="mt-5 fw-bold">Groupe :</h2>
    <?php if (!empty($nain['g_id'])) : ?>
    <p><?= $nain['g_id']; ?></p>
<?php elseif (empty($nain['g_id'])) : ?>
    <p>Non affecté.</p>
<?php endif; ?>
   

    <h2 class="mt-5 fw-bold">Longueur Barbe</h2>
      <p><?=$nain['n_barbe'] . ' cm' ?></p>

      <a href="town_profile.php?id='<?=$nain['v_id']?>'" >
      <h2 class="mt-5 fw-bold">Ville Natale</h2>
      <p class="link"><?=$nain['v_nom'] ?></p>      
      </a>


      <a href="tavern_profile.php?id='<?=$nain['t_id']?>'" >
      <h2 class="mt-5 fw-bold">Taverne</h2> 
      <?php if (!empty($nain['t_nom'])) : ?>
    <p class="link"><?= $nain['t_nom']; ?></p>
<?php elseif (empty($nain['t_nom'])) : ?>
    <p>Aucune taverne disponible.</p>
<?php endif; ?>

      

      <h2 class="mt-5 fw-bold">Tunnel</h2>     
      <p><?= $nainVille['ville_depart'] .' - ' . $nainVille['ville_arrivee'] ?></p>  
      
      <h2 class="mt-5 fw-bold">HORAIRES DE TRAVAIL</h2>
      <p><?=$nain['g_debuttravail']  . ' à ' . $nain['g_fintravail'] ?></p>    

      <a href="group_edit.php?id=<?= $nain['n_id']?>" class="btn btn-primary mt-5">Changer de Groupe</a> 
   </div>

</section>






<?php
include 'inc/foot.php';
?>