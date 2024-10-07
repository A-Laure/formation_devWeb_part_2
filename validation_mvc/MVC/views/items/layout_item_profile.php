<?php
if (session_id() == '') {
  session_start();
}


$title = "Fiche Article";
$currentPage = "layoutItemProfile";




?>

<!-- on met "=" car on veut afficher alors que "php" est une instruction  -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="itemProfile<?= $item['itemId'] ?>" aria-labelledby="offcanvasExampleLabel" aria-hidden="">

  <div class="stockBanner text-center ">
    <p>Fiche Article</p>
  </div>


  <div class="offcanvas-header">
    <button type="button" class="btn-close fs-3 " data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>


  <div class="offcanvas-header justify-content-center">
    <img src="../img/creme.jpg" alt="" class="">
  </div>

  <h5 class="offcanvas-title text-center fz30-fwb mt-3" id="mvmtStockLabel"><?= $item['itemName'] ?></h5>



  <div class="offcanvas-body">

    <div class="divRef">
      <p class="offcanvas-title text-center fz18-fwb" id="mvmtStockLabel">Référence</p>
      <p class="offcanvas-title text-center fz12" id="mvmtStockLabel"><?= $item['itemRef'] ?></p>
    </div>

    <div class="divChamp">
      <p class="offcanvas-title text-center fz18-fwb" id="mvmtStockLabel">Fournisseur</p>
      <p class="offcanvas-title text-center fz12" id="mvmtStockLabel"><?= $item['itemSupplier'] ?></p>
    </div>
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="mvmtStockLabel">Stock</p>
      <p class="offcanvas-title text-center fz12" id="mvmtStockLabel"><?= $item['itemStock'] ?></p>
    </div>

<div class="n-d-flex justify-content-center gap-5">
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="mvmtStockLabel">Pu HT</p>
      <p class="offcanvas-title text-center fz12" id="mvmtStockLabel"><?= $item['itemPuht']. "€" ?></p>
    </div>
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="mvmtStockLabel">Tva</p>
      <p class="offcanvas-title text-center fz12" id="mvmtStockLabel"><?= $item['itemTva'] . "%" ?></p>
    </div>
  </div>

    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="mvmtStockLabel">Stock de Sécurité</p>
      <p class="offcanvas-title text-center fz12" id="mvmtStockLabel"><?= $item['itemStockSecurity'] ?></p>
    </div>
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="mvmtStockLabel">Conditionnement d'Achat</p>
      <p class="offcanvas-title text-center fz12" id="mvmtStockLabel"><?= $item['itemCdt'] ?></p>
    </div>
    <div class="divChamp">
    <p class="offcanvas-title text-center fz18-fwb" id="mvmtStockLabel">Emplacement</p>
      <p class="offcanvas-title text-center fz12" id="mvmtStockLabel"><?= $item['itemPlace'] ?></p>
    </div>

   




    <!-- <a href="../views/dashboard.php" class="n-btn m-t-2 align-items-center">Valider</a> -->

  </div>
</div>



