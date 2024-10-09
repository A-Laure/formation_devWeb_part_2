<?php
// session_start();
// if(session_id() == '') {
//   session_start();
// }

$title = "Liste des Annonces";
$currentPage = "advertList";


?>

<h1 class="text-align-center title">Liste des Annonces</h1>

<section class= "container ">

<a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">Menu</a>
 


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
              <option <?= $orderBy == 'id' ? 'selected' : '' ?> value="contract">Type de contrat</option>
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

  <a href="index.php?ctrl=Advert&action=create" class="n-btn btn-card n-col">+Annonce</a>

<section class= "d-flex flex-row">


<?php foreach ($advertList as $advert) :?>

<form for="" class="row">
<div class="col-sm-6 mt-5 mb-3">
<div class="card">
  <div class="card-body">
    <h1 class="card-title"><?= $advert->getJobLabel() ?></h1>
    <p class="card-text"><?= htmlspecialchars($advert->getJobEmail()) ?></p>

    <p class="card-text"><?= $advert->getJobContractType() ?></p>
    <p class="card-text"><strong>Avantages : </strong> <?= $advert->getJobAdvantages() ?></p>
    <p class="card-text"><strong>Localisation : </strong><?= $advert->getJobTown() ?></p>
    <hr>
    <strong>Description du poste</strong>
    <p class="card-text"><?= $advert->getJobDescription() ?></p>
    <hr>
    <strong>Compétences:</strong>
    <?php if ($advert->getSkills() && is_array($advert->getSkills())): ?>
        <ul>
            <?php foreach ($advert->getSkills() as $skill): ?>
                <li><?= htmlspecialchars($skill) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune compétence associée.</p>
    <?php endif; ?>
    <hr>
    <strong>Réseaux sociaux:</strong>
    <?php if ($advert->getNetworks() && is_array($advert->getNetworks())): ?>
        <ul>
            <?php foreach ($advert->getNetworks() as $network): ?>
                <li><?= htmlspecialchars($network) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun réseau social associé.</p>
    <?php endif; ?>





    <a href="mailto:<?= htmlspecialchars($advert->getJobEmail()) ?>" class="btn
    btn-primary">Postuler</a>
  </div>
</div>
</div>

</form>
<?php
endforeach

// include '../suppliers/layout_supplier_profile.php';
// include '../items/layout_item_profile.php';
?>

</section>
    
  


    <!-- NAV PAGINATION A FINIR-->



</section>