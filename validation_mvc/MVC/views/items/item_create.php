<?php
$title = "Creation Articles";
$currentPage = "itemCreate";


// A REVOIR - PAS BON POUR LA BANNER ERROR 

unset($banner);
$banner ='';
// 1- TESTER SI UNE ZONE OBLIGATOIRE APRES SUBMIT VIDE
// 2- SI TOUTES LES ZONES OBLIGATOIRES APRES SUBMIT SAISIES

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['ref']) && isset($_POST['frns']) && isset($_POST['stock']) && isset($_POST['secu'])) {
// POUR TESTER LE CODE CI-DESSUS CAR NE SE RAJOUTE PAS DANS DATA (VOIR TRANSFERT FICHIER)
 

  $items['newItem'] = [];
  $itemId = count($items) + 1;
  $itemName = $_POST['name'];
  $itemRef = $_POST['ref'];
  $itemSupplier = $_POST['frns'];
  $itemStock = $_POST['stock'];
  $itemstockSecurity = $_POST['secu'];

  //POUR TESTER LE CODE CI-DESSUS CAR NE SE RAJOUTE PAS DANS DATA (VOIR TRANSFERT FICHIER)
  $items['newItem'][] = $itemId;
  $items['newItem'][] = $itemName;
  $items['newItem'][] = $itemRef;
  $items['newItem'][] = $itemSupplier;
  $items['newItem'][] = $itemStock;
  $items['newItem'][] = $itemstockSecurity;
 
  debug($items['newItem']);

} else { //ZONE OBLIGATOIRE APRES SUBMIT VIDE
  $banner =  "Une zone obligatoire n'a pas été saisie";
}

// 3- TEST DES ZONES NON OBLIGATOIRES VIDES OU NON, TRAITEMENT DIFFERENT

if (!isset($_POST['puht']) || !isset($_POST['tva']) || !isset($_POST['place']) || !isset($_POST['cdt'])) {
  // $itemimg = '';
  $itemPuht = '';
  $itemTva = '';
  $itemPlace = '';
  $itemCdt = '';
  $items['newItem'][] = $itemPuht;
  $items['newItem'][] = $itemTva;
  $items['newItem'][] = $itemPlace;
  $items['newItem'][] = $itemCdt;
  
} else {
  // PENSER A RAJOUTER IMAGE DANS LE IF
  // $itemimg = $_POST['img'];
  $itemPuht = $_POST['puht'];
  $itemTva = $_POST['tva'];
  $itemPlace = $_POST['place'];
  $itemCdt = $_POST['cdt'];
  $items['newItem'][] = $itemPuht;
  $items['newItem'][] = $itemTva;
  $items['newItem'][] = $itemPlace;
  $items['newItem'][] = $itemCdt;

}

// A REACTIVER QUAND TOUT OK

// header('Location: ../admin/dashboard.php');
// exit;

?>


<h1 class="title">Création d'un article</h1>


<section class="n-container text-center">

  <!-- BANNER MESSAGE ERREUR -->
 
  <?php if($banner ='') : ?>
    <div class=""> <?=$banner?>
    </div>
    <?php else : ?>
      <div class="alert fz20-fwb alert-<?= $banner  ? 'danger' : '' ?>" role="alert">
      <?= $banner ?>
    </div>
  <?php endif; ?>



  <form action="" method="post" class="formCreate ">

    <div class="mb-3 col">
      <label for="name" class="form-label">Titre Article</label><span> *</span>
      <input type="text" value="<?=$this->getItemLabel()?>" name="name" id="name" class="form-control">
    </div>

    <div class="mb-3 col">
      <label for="ref" class="form-label">Référence</label><span> *</span>
      <input type="text" name="ref" value="<?=$this->getItemRef()?> id="ref" class="form-control">
    </div>

    <div class="mb-3 col">
      <label for="puht" class="form-label">PU HT</label>
      <input type="float" value='value="<?=$this->getItemLabel()?>' name="puht" id="puht" class="form-control">
    </div>

    <!-- DIV TVA /RADIO (choix unique) -->
    <div class="mb-3 col">
      <label for="" class="form-label">TVA</label>


      <!-- <div class="d-flex form-check">
        <?php foreach ($tva as $value) : ?>
          <label for="tva" class="form-radio"><?= $value['tvaRate'] . "%" ?></label>
          <input type="radio" name="tva" id="tva" class="radioFormat" value="<?= $value['tvaRate'] ?>" <?php if ($value['tvaId'] === 1) echo 'checked'; ?>>
        <?php endforeach; ?>
      </div>
    </div> -->


    <div class="mb-3 col">
      <label for="place" class="form-label">Emplacement</label>
      <input type="text" name="place" value="<?=$this->getStockPlace()?>id="place" class="form-control">
    </div>

    <!-- DIV FOURNISSEUR / MENU DEROULANT -->
    <div class="mb-3 col">
      <label for="frns" class="form-label">Fournisseur</label><span> *</span>

      <!-- SANS JS = select -->
      <select name="frns" id="frns" class="form-control">
        <option value="" disabled selected>Liste des Fournisseurs</option>

        <?php foreach ($supplier as $supplier) : ?>
          <option value="<?= $supplier['spplName'] ?>"><?= $supplier['spplName'] ?></option>
        <?php endforeach; ?>

      </select>

      <!-- AVEC JS  = dropdown -->
      <div class="dropdown">

        <button class="btn btn-secondary dropdown-toggle" type="button" id="frns" data-bs-toggle="dropdown" aria-expanded="false">
          Liste des Fournisseurs
        </button>
        <ul class="dropdown-menu" aria-labelledby="frns">
          <?php foreach ($supplier as $supplier) : ?>
            <li><button class="dropdown-item" type="button" name="frns" id="frns"><?= $supplier->get ?></button></li>
          <?php endforeach; ?>
        </ul>
        <!-- <input type="text" name="frns" id="frnsId" class="form-control"> -->
      </div>
    </div>





    <div class="mb-3 col">
      <label for="cdt" class="form-label">Conditionnement</label>
      <input type="number" value="<?=$this->getItemCdt()?> name="cdt" id="cdt" class="form-control">
    </div>

    <!-- <div class="mb-3 col">
      <label for="stock" class="form-label">Stock Initial</label><span> *</span>
      <input type="number" value="<?=$this->getItemLabel()?> name="stock" id="stock" class="form-control">
    </div> -->

    <!-- <div class="mb-3 col">
      <label for="secu" class="form-label">Stock de Sécurité</label><span> *</span>
      <input type="number" value=0 name="secu" id="secu" class="form-control">
    </div> -->

    <div class="">
      <button type="submit" class="n-btn btn-primary">Créer</button>
    </div>

  </form>

  </div>


</section>
