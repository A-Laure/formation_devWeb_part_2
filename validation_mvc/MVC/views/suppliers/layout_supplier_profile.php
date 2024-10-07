<?php
if (session_id() == '') {
  session_start();
}

// if (isset($_POST['plusStock']) || isset($_POST['lessStock'])) {
//   unset($_SESSION['gestionStock']['newStock']);
//   // $_SERVER['PHP_SELF'] récupère le nom de la page en cours (pratique pour au cas ou le nom du fichier change plus tard)
//   $page = $_SERVER['PHP_SELF'];
//   header('Location: ' . $page);
//   exit();
// }

$title = "Fiche Fournisseur";
$currentPage = "layoutFrnsProfile";




?>



<?php foreach($suppliers as $supplier) : ?>

<!-- <?php if($_GET['sppl'] === $supplier['spplName'] ) ?> -->

<div class="offcanvas offcanvas-start" tabindex="-1" id="supplierProfile<?= $supplier['spplName'] ?>" aria-labelledby="offcanvasExampleLabel" aria-hidden="">

  <div class="stockBanner text-center ">
    <p>Fiche Fournisseur</p>
  </div>


  <div class="offcanvas-header">
    <button type="button" class="btn-close fs-3 " data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>


  <div class="offcanvas-header justify-content-center">
    <img src="../img/creme.jpg" alt="" class="">
  </div>

  <h5 class="offcanvas-title text-center fz30-fwb mt-3" id="supplierLabel"><?= $supplier['spplName'] ?></h5>


<!-- 
  <div class="offcanvas-body">

    <div class="divRef">
      <p class="offcanvas-title text-center fz18-fwb" id="supplierLabel">Référence</p>
      <p class="offcanvas-title text-center fz12" id="supplierLabel"><?= $item['itemRef'] ?></p>
    </div>

    <div class="divChamp">
      <p class="offcanvas-title text-center fz18-fwb" id="supplierLabel">Fournisseur</p>
      <p class="offcanvas-title text-center fz12" id="supplierLabel"><?= $item['itemSupplier'] ?></p>
    </div>
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="supplierLabel">Stock</p>
      <p class="offcanvas-title text-center fz12" id="supplierLabel"><?= $item['itemStock'] ?></p>
    </div>

<div class="n-d-flex justify-content-center gap-5">
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="supplierLabel">Pu HT</p>
      <p class="offcanvas-title text-center fz12" id="supplierLabel"><?= $item['itemPuht']. "€" ?></p>
    </div>
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="supplierLabel">Tva</p>
      <p class="offcanvas-title text-center fz12" id="supplierLabel"><?= $item['itemTva'] . "%" ?></p>
    </div>
  </div>

    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="supplierLabel">Stock de Sécurité</p>
      <p class="offcanvas-title text-center fz12" id="supplierLabel"><?= $item['itemStockSecurity'] ?></p>
    </div>
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="supplierLabel">Conditionnement d'Achat</p>
      <p class="offcanvas-title text-center fz12" id="supplierLabel"><?= $item['itemCdt'] ?></p>
    </div>
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="supplierLabel">Emplacement</p>
      <p class="offcanvas-title text-center fz12" id="supplierLabel"><?= $item['itemPlace'] ?></p>
    </div> -->

   

    
    <?php endforeach; ?>



    <!-- <a href="../views/dashboard.php" class="n-btn m-t-2 align-items-center">Valider</a> -->

  </div>
</div>












