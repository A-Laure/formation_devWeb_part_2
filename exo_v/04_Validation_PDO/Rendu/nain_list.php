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
 


  $query = 'SELECT DISTINCT
  n.n_id, n.n_nom, n.n_barbe,  
  v.v_nom,
  t.t_nom,
  g.g_id, g.g_debuttravail, g.g_fintravail 
  FROM nain n
  RIGHT JOIN ville v ON n.n_ville_fk = v.v_id
  JOIN taverne t ON t.t_ville_fk = v.v_id
  RIGHT JOIN groupe g ON n.n_groupe_fk  = g.g_id
  GROUP BY n.n_nom' ;
  
  

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query)) !== false) {
    // echo '<pre>';
    //   echo 'LOG1';
    //   echo '</pre>';
    # on execute la requête
    if ($request->execute()) {
      // echo '<pre>';
      // echo 'LOG2 execute ok  ';
      // echo '</pre>';
      # On récupère et stocke le jeu de résultats au format tableau associatif
      $nainAll = $request->fetchAll(PDO::FETCH_ASSOC);
      // echo '<pre>';
      // echo 'LOG3 varDump de userAll   ';
      // var_dump($nainAll);
      // echo '</pre>';

      # on termine le traitement de la requete
      $request->closeCursor();
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}

// Requête pour COUNT des nains
$queryNainCount = "SELECT COUNT(*) AS nainCount FROM nain";
if (($request = $pdo->prepare($queryNainCount)) !== false) {
  if ($request->execute()) {
    $result = $request->fetch(PDO::FETCH_ASSOC);
    $countnain = $result['nainCount'];  // Stocker le résultat dans la variable
  }
}

# RECUP DU TUNNEL

try {

$query2 = 'SELECT DISTINCT
 n.n_nom,  
 v1.v_nom AS ville_depart, 
 v2.v_nom AS ville_arrivee
FROM nain n 
LEFT JOIN ville v1 ON n.n_ville_fk = v1.v_id 
LEFT JOIN tunnel t ON t.t_villedepart_fk = v1.v_id 
RIGHT JOIN ville v2 ON t.t_villearrivee_fk = v2.v_id
GROUP BY n.n_nom  
';
  
  

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request2 = $pdo->prepare($query2)) !== false) {   

    // echo '<pre>';
    //   echo 'LOG bindvalue';
    //   echo '</pre>';

    # on execute la requête
    if ($request2->execute()) {

      // echo '<pre>';
      // echo 'LOG execute ok  ';
      // echo '</pre>';

      # On récupère et stocke le jeu de résultats au format tableau associatif
      $nainVille = $request2->fetchAll(PDO::FETCH_ASSOC);

      // echo '<pre>';
      // echo 'LOG nain fetch   ';
      // var_dump($nainVille);
      // echo '</pre>';

      # on termine le traitement de la requete
      $request2->closeCursor();
    }
  }

} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}



// ----------- PAGINATION -----------------------------


$userCount = count($nainAll); // nbre d'élément du $data
$elementByPage = 8; // nbre d'élément par page

$nbreDePages = ceil($userCount / $elementByPage); // nbre de pages

// Page actuelle courante
// $currentItemPage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1;
$currentItemPage = $_GET['page'] ?? 1;

// index de départ : servira pour découpage ou $OFFSET
// calcul de la position du 1er record of the page display
$startIndex = ($currentItemPage - 1) * $elementByPage;

// ex : si on est sur la page 1, $currentUserPAge = 1
//$startIndex = (1-1)*5 = 0; donc $startIndex = 0 dc on commence à l'index 0 de notre tableau -> sur la page 1 on ira de 0 à 4
//$startIndex = (2-1)*5 = 5; donc $startIndex = 5 dc on commence à l'index 0 de notre tableau -> sur la page 2 on ira de 5 à 9
//$startIndex = (3-1)*5 = 10; donc $startIndex = 10 dc on commence à l'index 0 de notre tableau -> sur la page 3 on ira de 10 à 14


// items à afficher sur la page courante
// Récupère le sous-ensemble d'enregistrements à afficher à partir du tableau
// ne pas l'appeler comme le array initial d'où $itemsOnPage car c'est une sélection ce qui fait que le mode recherchene se fera que sur la sélection d x item prévus au display (ici 4 par page)
$itemsOnPage = array_slice($nainAll, $startIndex, $elementByPage);


// echo ("Nbre de fiches : $userCount");
// echo ("Element par page : $elementByPage");
// echo ("Nbre de pages : $nbreDePages");

// "New DATABASE" suite SEARCH ou PAGINATION sera ensuite dans le foreach dans la structure html à la place de $alumnuses ou $alumnuses si pas de SEARCH OU PAGINATION en cours
// $userDisplay = isset($filterArray) && !empty($filterArray) ? $filterArray : $alumnusesOnPage;




?>

<h1 class="text-align-center title">Liste des Nains - <?=  $countnain ?></h1>

<div><a href="dashboard.php" class="n-container btn btn-primary mb-5">HOME</a></div>

<section class="n-container n-d-grid supplierList">

  <!-- CARD USER -->



  <?php foreach ($nainAll as $nain) : ?>
    <div class=" supplierCard n-col-3">
    
      <h1><?=$nain['n_nom'] ?></h1>

      <h2 class="mt-5 fw-bold">Groupe :</h2>
      <?php if (!empty($nain['g_id'])) : ?>
    <p><?= $nain['g_id']; ?></p>
<?php elseif (empty($nain['g_id'])) : ?>
    <p>Non affecté.</p>
<?php endif; ?>
   

      <h2 class="mt-5 fw-bold">Longueur Barbe</h2>
      <p><?=$nain['n_barbe'] ?></p>

      <h2 class="mt-5 fw-bold">Ville Natale</h2>
      <p><?=$nain['v_nom'] ?></p>

      <h2 class="mt-5 fw-bold">Taverne</h2> 
      <?php if (!empty($nain['t_nom'])) : ?>
    <p><?= $nain['t_nom']; ?></p>
<?php elseif (empty($nain['t_nom'])) : ?>
    <p>Aucune taverne disponible.</p>
<?php endif; ?>

      <h2 class="mt-5 fw-bold">Tunnel</h2>  
      <p class="text-danger">J'ai "devrai" faire un foreach sur nainVille mais pas bon fait trop de tour</p>   
      <p><?= $nainVille['ville_depart'] .' - ' . $nainVille['ville_arrivee'] ?></p>
      
      <h2 class="mt-5 fw-bold">HORAIRES DE TRAVAIL</h2>
      <p><?=$nain['g_debuttravail']  . ' à ' . $nain['g_fintravail'] ?></p>    
      <a href="group_edit.php?id=<?= $nain['n_id']?>" class="btn btn-primary mt-5">Changer de Groupe</a> 
   </div>
  <?php endforeach ?>
</section>


<!-- NAV PAGINATION -->


<nav aria-label="Page navigation example " class="mt-5 m-l-52">
  <ul class="pagination justify-content-start">
    <!-- LIGNE QUI N'AFFICHE PAS LA PAGINATION SI QU'UNE PAGE -->
    <li class="page-item  <?= $currentItemPage == 1 ? 'disabled' : '' ?>">
      <a class="page-link " href="?page=<?= $currentItemPage - 1 ?>">Précédent</a>
    </li>
    <?php for ($i = 1; $i <= $nbreDePages; $i++) : ?>
      <li class="page-item">
        <a class="page-link <?= $currentItemPage == $i ? 'active' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
    <li class="page-item <?= $currentItemPage == $nbreDePages ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $currentItemPage + 1 ?>">Suivant</a>
    </li>
  </ul>
  <p class="text-start fz12 text-primary px-2">
    <?php

    $label = 'article(s)';
    echo  $startIndex + 1 . "  "  . " - " . $userCount * $currentItemPage . " sur " . $userCount . " " . $label;
    ?>

</nav>


<?php
include 'inc/foot.php';
?>