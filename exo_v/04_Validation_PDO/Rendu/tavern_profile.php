<?php
session_start();

$title = "TavernProfile";
$currentPage = "tavernProfile";

require_once 'lib/_helpers/tools.php';
require 'admin/config/config.php';
include 'inc/head.php';
// include 'inc/navBar.php';

?>

<?php

 # Connexion à la BDD
 $pdo = dbConnect();
try {

  // $query = 'SELECT
  //  v.v_nom,
  //  r.t_villedepart_fk,  r.t_villearrivee_fk,   r.t_progres, 
  // GROUP_CONCAT(n.n_nom) AS nainlist,
  // GROUP_CONCAT(t.t_nom) AS tavernlist
  // FROM ville v
  // JOIN tunnel r ON v.v_id = r.t_villedepart_fk
  // JOIN taverne t ON v.v_id = t.t_ville_fk
  // JOIN nain n ON n.n_ville_fk = v.v_id

  $query = 'SELECT
   t.t_nom, t.t_chambres, t.t_blonde, t.t_brune, t.t_rousse,
   v.v_nom    
  FROM taverne t 
  JOIN ville v ON v.v_id = t.t_ville_fk
  WHERE :idUrl= t_id
  ';

  

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query)) !== false) {

    // echo '<pre>';
    //   echo 'LOG prepare';
    //   echo '<pre>';
    # on execute la requête

    if($request->bindValue('idUrl', $_GET['id'])){

      // echo '<pre>';
      //   echo 'LOG bindvalue';
      //   echo '<pre>';

    if ($request->execute()) {

      // echo '<pre>';
      // echo 'LOG execute ok  ';
      // echo '<pre>';

      # On récupère et stocke le jeu de résultats au format tableau associatif
      $tavernAll = $request->fetchAll(PDO::FETCH_ASSOC);

      // echo '<pre>';
      // echo 'LOG fetch tavernAll   ';
      // var_dump($userAll);
      // echo '<pre>';

      # on termine le traitement de la requete
      $request->closeCursor();
    }
  }
}
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}

// Requête pour COUNT des nains

$nainCount = [];
$query2 = "SELECT
 t_nom, t_chambres, 
 COUNT(n_id) AS nainCount 
FROM nain
JOIN ville ON n_ville_fk = v_id
JOIN taverne ON t_ville_fk = v_id
GROUP BY t_nom
";

if (($request = $pdo->prepare($query2)) !== false) {
  if ($request->execute()) {
    $nainCount = $request->fetchAll(PDO::FETCH_ASSOC);
   
      foreach ($nainCount as $count) {  
        $nainCount[$count['t_nom']] = $count['nainCount'];
    }
    //  echo '<pre>';
    //   echo 'LOG  nainCount   ';
    //   var_dump($nainCount);
    //   echo '<pre>';
  }
}




?>

<h1 class="text-align-center title">Liste des Tavernes</h1>

<div><a href="dashboard.php" class="n-container btn btn-primary mb-5">HOME</a></div>

<section class="n-container n-d-grid supplierList">

  <!-- CARD USER -->

  <?php foreach ($tavernAll as $tavern) : ?>

    <div class=" supplierCard n-col-3">
    <h1><?= $tavern['t_nom'] ?></h1>
    <h2 class="mt-5 fw-bold">Ville</h2>
    <p><?=$tavern['v_nom'] ?></p>
    <h2 class="mt-5 fw-bold">Nbre de chambres(s)</h2>
    <p><?=$tavern['t_chambres'] ?></p>

    <?php
      // Obtenir le nombre de nains pour cette taverne (si disponible)
      $countnain = isset($nainCount[$tavern['t_nom']]) ? $nainCount[$tavern['t_nom']] : 0;
      $chambreDispo = $tavern['t_chambres'] - $countnain;
      ?>
 <h2 class="mt-5 fw-bold">Chambre(s) disponible(s)</h2>
    <p><?= $chambreDispo ?></p>

    <h2 class="mt-5 fw-bold">Bière(s) disponible(s)</h2>
    <p >Blondes : <?=$tavern['t_blonde'] == 0 ? ' Non' : ' Oui'?></p>
    <p>Brunes :  <?=$tavern['t_brune'] == 0 ? ' Non' : ' Oui'?></p>
    <p>Rousses :  <?=$tavern['t_rousse'] == 0 ? ' Non' : 'Oui'?></p>
 
     
      
      
   </div>

  <?php endforeach ?>
</section>




<?php
include 'inc/foot.php';
?>