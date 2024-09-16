<?php
session_start();

$title = "Liste des Villes";
$currentPage = "villeList";

require_once 'lib/_helpers/tools.php';
require 'admin/config/config.php';
include 'inc/head.php';
// include '../../../inc/navBarBootstrap.php';

?>

<?php
try {
  # Connexion à la BDD
  $pdo = dbConnect();

  $query = 'SELECT 
  v.v_nom, 
  v.v_superficie, 
  v.v_id,
  r.t_villedepart_fk,  
  r.t_villearrivee_fk, 
  r.t_progres, 
  GROUP_CONCAT(DISTINCT n.n_nom) AS nainlist,
  GROUP_CONCAT(DISTINCT t.t_nom) AS tavernlist,
  v2.v_nom AS ville_arrivee
FROM ville v
LEFT JOIN taverne t ON v.v_id = t.t_ville_fk
LEFT JOIN tunnel r ON v.v_id = r.t_villedepart_fk
LEFT JOIN ville v2 ON r.t_villearrivee_fk = v2.v_id
LEFT JOIN nain n ON n.n_ville_fk = v.v_id
GROUP BY v.v_id
';



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
      $townAll = $request->fetchAll(PDO::FETCH_ASSOC);

      // echo '<pre>';
      // echo 'LOG townAll   ';
      // var_dump($townAll);
      // echo '</pre>';

      # on termine le traitement de la requete
      $request->closeCursor();
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}






// ----------- PAGINATION -----------------------------


$userCount = count($townAll); // nbre d'élément du $data
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
$itemsOnPage = array_slice($townAll, $startIndex, $elementByPage);


// echo ("Nbre de fiches : $userCount");
// echo ("Element par page : $elementByPage");
// echo ("Nbre de pages : $nbreDePages");

// "New DATABASE" suite SEARCH ou PAGINATION sera ensuite dans le foreach dans la structure html à la place de $alumnuses ou $alumnuses si pas de SEARCH OU PAGINATION en cours
// $userDisplay = isset($filterArray) && !empty($filterArray) ? $filterArray : $alumnusesOnPage;




?>

<h1 class="text-align-center title">Liste des Villes</h1>

<div><a href="dashboard.php" class="n-container btn btn-primary mb-5">HOME</a></div>



<section class="n-container n-d-grid supplierList">

  <!-- CARD USER -->

  <?php foreach ($townAll as $town) : ?>
   
    <div class=" supplierCard n-col-3">

    <!-- AFFICHAGE TUNNEL FINI -->
      <?php if ($town['t_progres'] != 100) : ?>
        <?= $fini = '';
        $color = ''; ?>
      <?php elseif ($town['t_progres'] == 100) : ?>
        <?php $fini = 'TUNNEL FINI!!!';
        $color = 'text-success';
        ?>
    

      <?php endif; ?>

      <h1 class='<?= $color ?>'><?= $fini ?></h1>
      <h1><?= $town['v_nom'] ?></h1>

      <h2 class="mt-5 fw-bold">Superficie</h2>
      <p><?= $town['v_superficie'] ?></p>

      <h3 class="mt-5 fw-bold">Liste des Tavernes</h3>
      <p><?= $town['tavernlist'] ?></p>

      <h3 class="mt-5 fw-bold">Liste des Nains</h3>
      <p><?= $town['nainlist'] ?></p>
     
      <h3 class="mt-5 fw-bold">Tunnel vers...</h3>
      <p><?=$town['ville_arrivee'] ?></p>


      <h3 class="mt-5 fw-bold">Progression</h3>
      <p class='<?= $color ?>'><?= $town['t_progres'] . '%' ?></p>

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