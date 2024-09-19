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

  $query = 'SELECT
   t.t_nom, t.t_chambres, t.t_blonde, t.t_brune, t.t_rousse,
   v.v_nom    
  FROM taverne t 
  JOIN ville v ON v.v_id = t.t_ville_fk

  ';



  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare($query)) !== false) {

    // echo '<pre>';
    //   echo 'LOG prepare';
    //   echo '</pre>';
    # on execute la requête

    if ($request->execute()) {

      // echo '<pre>';
      // echo 'LOG execute ok  ';
      // echo '</pre>';

      # On récupère et stocke le jeu de résultats au format tableau associatif
      $tavernAll = $request->fetchAll(PDO::FETCH_ASSOC);

      // echo '<pre>';
      // echo 'LOG fetch tavernAll   ';
      // var_dump($userAll);
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

// ----------- PAGINATION -----------------------------


$userCount = count($tavernAll); // nbre d'élément du $data
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
$itemsOnPage = array_slice($tavernAll, $startIndex, $elementByPage);


// echo ("Nbre de fiches : $userCount");
// echo ("Element par page : $elementByPage");
// echo ("Nbre de pages : $nbreDePages");

// "New DATABASE" suite SEARCH ou PAGINATION sera ensuite dans le foreach dans la structure html à la place de $alumnuses ou $alumnuses si pas de SEARCH OU PAGINATION en cours
// $userDisplay = isset($filterArray) && !empty($filterArray) ? $filterArray : $alumnusesOnPage;




?>

<h1 class="text-align-center title">Liste des Tavernes</h1>

<div><a href="dashboard.php" class="n-container btn btn-primary mb-5">HOME</a></div>

<section class="n-container n-d-grid supplierList">

  <!-- CARD USER -->

  <?php foreach ($tavernAll as $tavern) : ?>

    <div class=" supplierCard n-col-3">
      <h2><?= $tavern['t_nom'] ?></h2>

      <h2 class="mt-5 fw-bold">Ville</h2>
      <p><?= $tavern['v_nom'] ?></p>

      <h2 class="mt-5 fw-bold">Nbre de chambres(s)</h2>
      <p><?= $tavern['t_chambres'] ?></p>

      <?php
      // Obtenir le nombre de nains pour cette taverne (si disponible)
      $countnain = isset($nainCount[$tavern['t_nom']]) ? $nainCount[$tavern['t_nom']] : 0;
      $chambreDispo = $tavern['t_chambres'] - $countnain;
      ?>
      <h2 class="mt-5 fw-bold">Chambre(s) disponible(s)</h2>
      <p><?= $chambreDispo ?></p>

      <h2 class="mt-5 fw-bold">Bière(s) disponible(s)</h2>
      <p>Blondes : <?= $tavern['t_blonde'] == 0 ? ' Non' : ' Oui' ?></p>
      <p>Brunes : <?= $tavern['t_brune'] == 0 ? ' Non' : ' Oui' ?></p>
      <p>Rousses : <?= $tavern['t_rousse'] == 0 ? ' Non' : 'Oui' ?></p>




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