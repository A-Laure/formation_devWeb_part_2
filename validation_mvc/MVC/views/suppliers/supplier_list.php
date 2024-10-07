<?php
$title = "Liste Founisseurs";
$currentPage = "frns";



?>

<?php
// ----------- PAGINATION -----------------------------
 

  $userCount = count($suppliers); // nbre d'élément du $data
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
  $itemsOnPage = array_slice($suppliers, $startIndex, $elementByPage);


  // echo ("Nbre de fiches : $userCount");
  // echo ("Element par page : $elementByPage");
  // echo ("Nbre de pages : $nbreDePages");

  // "New DATABASE" suite SEARCH ou PAGINATION sera ensuite dans le foreach dans la structure html à la place de $alumnuses ou $alumnuses si pas de SEARCH OU PAGINATION en cours
  // $userDisplay = isset($filterArray) && !empty($filterArray) ? $filterArray : $alumnusesOnPage;

?>


<h1 class="text-align-center title">Liste des fournisseurs</h1>


<div class="n-container text-end pt-5">

 

  <a href="supplier_create.php" class="btn-start n-btn btn-create m-l-96 ">+ Fournisseur</a>



</div>

<section class= "n-container n-d-grid supplierList">


<?php foreach ($itemsOnPage as $supplier) : ?>

  <div class=" supplierCard n-col-3">
        <h2><?= $supplier['spplName'] ?></h2>
        <p><?= $supplier['spplAdr1'] ?></p>
        <p><?= $supplier['spplAdr2'] ?></p>

        <div class= "d-flex cpTown">
           <p><?= $supplier['spplCp'] ?></p>
           <p><?= $supplier['spplTown'] ?></p>
        </div>
       
        <p><?= $supplier['spplCountry'] ?></p>
        <a class="link fz14-fwb"><?= $supplier['spplMail'] ?></p>

        <a href="../views/supplier_edit.php" class="n-btn m-t-2">Modifier</a>
  </div>

<?php endforeach ?>

</section>

  <!-- NAV PAGINATION -->


  <nav aria-label="Page navigation example " class=" resp-pagination mt-5 m-l-52">
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

    $label = 'fournisseur(s)';
        echo  $startIndex+1 . "  "  . " - " . $elementByPage*$currentItemPage . " sur " . $userCount . " " . $label;
    ?>

  </nav>





