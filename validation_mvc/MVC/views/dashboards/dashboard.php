<?php
// session_start();
// if(session_id() == '') {
//   session_start();
// }

$title = "Tableau_de_Bord";
$currentPage = "t2bord";


?>

<h1 class="text-align-center title">Tableau de Bord</h1>

<section>

  <!-- ------------ DIV COUNT CARDS -----------------   -->

  <div class="n-container counter n-d-flex ">

    <!-- <a href="toOrder.php" class="count-card cmd n-col-2">
      <?php
      // $nbreItem = $toBeCommandCount;
      // echo  "<p>$nbreItem</p>";
      // echo  "<p>A Commander</p>";
      ?>
    </a> -->

    <a href="#" class="count-card decoration-none n-col-2">
      <?php
      // $nbreItem = "En cours";
      echo  "<p>$nbItem</p>";
      echo  "<p>Article(s)</p>";
      ?>
    </a>

    <a href="../suppliers/supplier_list.php" class="count-card n-col-2">
      <?php
      // $countSupplier = "En cours";
      echo  "<p>$nbSppl</p>";
      echo  "<p>Fournisseurs(s)</p>";
      ?>
    </a>

    <a href="index.php?ctrl=User&action=index" class="count-card n-col-2">
      <?php
      // $countUser = "En cours";
      echo  "<p>$nbUser</p>";
      echo  "<p>Utilisateur(s)</p>";
      ?>
    </a>
  </div>

  <!-- ------------ FIN DIV COUNT CARDS -----------------   -->


  <!-- ------------------ PAGINATION ET RECHERCHE A FINIR ------------------------>

  <nav aria-label="Page navigation example " class="mt-5 m-l-52">
    
  <form action="" method="GET" >
    <div class="">

      <div class="">
        <label for="" class="label">Afficher</label>
      </div>

      <!-- PAGINATION -->
      <div class="">
          <div class="select">
            <input type="hidden" name="item" value="<?= $nbItem  ?>">
            <select name="pagination" >
              <option <?= $pagination == 8 ? 'selected' : '' ?> value="8">8</option>
              <option <?= $pagination == 16 ? 'selected' : '' ?> value="16">16</option>
              <option <?= $pagination == 24 ? 'selected' : '' ?> value="24">24</option>
            </select>
            </div>
        </div>

      <!-- ORDER BY -->

      <div class="">
          <div class="select">
            <select name="orderBy" >
              <option <?= $orderBy == 'id' ? 'selected' : '' ?> value="id">Id</option>
            </select>
            </div>
        </div>

      <!-- CROISSANT / DECROISSANT -->

      <div class="">
          <div class="select">
            <select name="order" >
              <option <?= $order == 'ASC' ? 'selected' : '' ?> value="ASC">Croissant</option>
              <option <?= $order == 'DESC' ? 'selected' : '' ?> value="DESC">Décroissant</option>
            </select>
            </div>
        </div>

      <!-- BOUTON TRIER -->

      <div class="ml-3 control">
          <button class="button is-dark" type="submit">Trier</button>
        </div>
      </div>
  </form>
  </nav>
  <!-- FIN PAGINATION AND CO -->


  <!-- --------------------- DIV TITRE DES TABLEAUX ---------------------------------- -->
  <div class="n-container mt-5">

    <div class="n-d-grid label fz12-fwb text-start ">

      <div class="n-col-3">Article</div>
      <div class="n-col ">Référence</div>
      <div class="n-col">Statut</div>
      <div class="n-col ">Stock</div>
      <div class="n-col">Stck Sécu</div>
      <div class="n-col-2">Fournisseur</div>
      <div class="n-col">Place</div>
      <div class="n-col-2">
        Actions
        <a href="../suppliers/supplier_create.php" class="n-btn btn-card n-col ">+ Articles</a>

      </div>

    </div>
    <!--  ------------------FIN DIV TITRE DES TABLEAUX -------------------------------- -->

    <!-- DIV CARDS ITEM -->

    <?php foreach ($items as $item) :
      // $modalId = $item['itemId'];      
    ?>
      <div class="n-d-grid item-card text-start">

        <!-- IMAGE -->
        <!-- <img src=" ?>" class="">   -->

        <!-- ARTICLE en <a> mais surement à mettre en <p> ensuite si pas de link-->
        <a href="?itemProfile" class="fz14-fwb n-col-3" method="get"><?= $item->getLabelItem() ?></a>

        <!-- REF -->
        <div class="n-col fz12 "> <?= $item->getRef() ?> </div>

        <!-- Statut -->
        <div class="n-col fz10-fwb"> <?php
                                      if ($item->getStoreQty() <= $item->getStockSecurity()) {
                                        $itemPage = "A COMMANDER";
                                        echo '<span class= "warning">' . $itemPage . "<span>";
                                      } else {
                                        $itemPage = "Stock ok";
                                        echo  '<span class= "text-success">' . $itemPage . "<span>";
                                      };
                                      ?>
        </div>

        <!-- STOCK ET "NEWSTOCK", si ajout et modif met à jour-->
        <div class="text-start ">
          <?php if (isset($_SESSION['APP_TAG']['newStock'])) {
            echo $_SESSION['APP_TAG']['newStock'];
          } else {
            echo $item->getStoreQty();
          } ?> </div>
        <div class="text-start "> <?= $item->getStockSecurity() ?> </div>


        <!-- FOURNISSEUR-->
        <a href="#layout_supplier_profile.php?sppl=<?= $item->getNameSppl() ?>" class="n-col-2 link"> <?= $item->getNameSppl() ?></a>

        <!-- EMPLACEMENT-->
        <div class=" text-start"> <?= $item->getPlace() ?> </div>

        <!-- --------------EDIT / MVT STOCK / DELETE ICONS ----------------------->

        <div class="">
          <!-- EDIT  ATTENTION METTRE ITEM_EDIT -->
          <a href=""><i class="fa-regular fa-pen-to-square text-primary me-2"></i></a>

          <!-- +/- STOCK   -->
          <a href=""><i class="fa-solid fa-dolly fa-flip-horizontal  text-primary  me-2"></i></a>

          <!-- TRASH -->
          <a href="#<?= $item->getIdItem() ?>" <i class="fa-regular fa-trash-can text-danger"></i> </a>
        </div>

        <!-- --------------BUTTON POUR LAYOUT/VOIR FICHE ARTICLE ----------------------->

        <button class="btn btn-primary text-white fz12" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#itemProfile<?= $item->getIdItem() ?>"><i class="fa-regular fa-eye fz14 text-white me-2"></i>Article</button>
      </div>


    <?php
    endforeach

    // include '../suppliers/layout_supplier_profile.php';
    // include '../items/layout_item_profile.php';
    ?>


    <!-- NAV PAGINATION A FINIR-->



</section>