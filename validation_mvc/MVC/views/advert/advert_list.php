<?php


$title = "Liste des Annonces";
$currentPage = "advertList";


?>

<h1 class="text-align-center title">Liste des Annonces</h1>

<section class="container ">


  <!-- DIV BUTTON -->
  <div class="d-flex flex-row">
    <a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">Menu</a>

    <a href="index.php?ctrl=Advert&action=create" method="get" type="button" class="mx-5 n-btn">
      <p class="align-items-center"> Ajouter une annonce</p>
    </a>
  </div>



  <!-- PAGINATION -->
 


  <!-- Tri -->
  <div class="mt-5 m-l-52 ">
    <nav aria-label="Page navigation example">

      <form action="" method="GET" class="d-flex flex-row">
        <div class="">

          <div class="">
            <label for="" class="label">Afficher</label>
          </div>

          <!-- PAGINATION -->
          <div class="fiels">
            <div class="select">
              <input type="hidden" name="item" value="<?= $nbItem  ?>">
              <select name="pagination">
                <option <?= $pagination == 8 ? 'selected' : '' ?> value="8">8</option>
                <option <?= $pagination == 16 ? 'selected' : '' ?> value="16">16</option>
                <option <?= $pagination == 24 ? 'selected' : '' ?> value="24">24</option>
              </select>
            </div>
          </div>

          <!-- ORDER BY -->

          <div class="field">
            <div class="select">
              <select name="orderBy">
                <option <?= $orderBy == 'joba_jobContractType' ? 'selected' : '' ?> value="joba_jobContractType">Type de contrat</option>
              </select>
            </div>
          </div>


          <!-- CROISSANT / DECROISSANT -->

          <div class="">
            <div class="select">
              <select name="order">
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

     <!-- Par Page -->
  <div class="mt-5">
    <?php if ($totalPages >= 1): ?>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php for ($page = 1; $page <= $totalPages; $page++): ?>
            <li class="page-item <?php if ($page == $currentPage) echo 'active'; ?>">
              <a class="page-link" href="?ctrl=Advert&action=index&page=<?= $page ?>&pagination=<?= $pagination ?>&orderBy=<?= $orderBy ?>&order=<?= $order ?>">
                <?= $page ?>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    <?php endif; ?>
  </div>

  </div>

  <!-- FIN PAGINATION AND CO -->



  <section class="d-flex flex-row">



  <?php foreach ($advertList as $advert) : ?>
  <form for="" class="row col-3">
    <div class="mt-5 mb-3">
      <div class="card mx-2  mx-2">
        <div class="card-body ">
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
          <ul>
            <?php 
            $skills = $advert->getSkills();
            if (is_array($skills) || $skills instanceof Traversable):
                foreach ($skills as $skill): 
                    if (is_object($skill) && method_exists($skill, 'getSkillLabel')):
            ?>
                        <li><?= htmlspecialchars($skill->getSkillLabel()) ?></li>
            <?php 
                    elseif (is_string($skill)):
            ?>
                        <li><?= htmlspecialchars($skill) ?></li>
            <?php
                    endif;
                endforeach; 
            elseif (is_string($skills)):
            ?>
                <li><?= htmlspecialchars($skills) ?></li>
            <?php else: ?>
                <li>****</li>
            <?php endif; ?>
          </ul>

          <strong>Réseaux sociaux:</strong>
          <?php if ($advert->getNetworks() && is_array($advert->getNetworks())): ?>
            <ul>
              <?php foreach ($advert->getNetworks() as $network): ?>
                <li><?= htmlspecialchars($network) ?></li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <p>*****</p>
          <?php endif; ?>

          <a href="mailto:<?= htmlspecialchars($advert->getJobEmail()) ?>" class="btn btn-primary">Postuler</a>
        </div>
      </div>
    </div>
  </form>
<?php endforeach; ?>
    <?php
    // include '../suppliers/layout_supplier_profile.php';
    // include '../items/layout_item_profile.php';
    ?>

  </section>




  <!-- NAV PAGINATION A FINIR-->



</section>