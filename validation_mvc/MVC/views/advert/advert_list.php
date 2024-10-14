<?php
// session_start();

$title = "Liste des Annonces";
$currentPage = "advertList";


?>

<h1 class="text-align-center title">Liste des Annonces</h1>

<section class="container m-l-45 ">


  <!-- DIV BUTTON MENU ET CREER UNE ANNONCE-->
  <div class="d-flex flex-row justify-content-center " >
    <a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">
      <i class="fa-solid fa-home"></i>
      <p class="align-items-center"> Menu</p>
    </a>
  </div>

    <?php if (
      
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Administrateur'
      ||
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Entreprise'
    ) : ?>
    <a href="index.php?ctrl=Advert&action=create" method="get" type="button" class="mx-5 n-btn mt-5">
      <i class="fa-regular fa-address-card"></i>
      <p class="align-items-center"> Ajouter une annonce</p>
    </a>
  </div>
  <?php endif ?>

</section>



  <!-- PAGINATION -->

  <section class="container m-l-52 ">


 
    <!-- Par Page -->
    <div class="mt-5 ">
      <?php if ($totalPages >= 1): ?>
        <nav aria-label="Page navigation example justify-content-right">
          <ul class="pagination ">
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
              <li class="page-item <?php if ($page == $currentPage) echo 'active'; ?>">
                <a class="page-link" href="?ctrl=Advert&action=index&page=<?= $page ?>&pagination=<?= $pagination ?>&orderBy=<?= $orderBy ?>&order=<?= $order ?>"><?= $page ?>
                </a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      <?php endif; ?>
    </div>

  </div>

   <!-- SEARCH BAR-->

<section class="container flew flex-row col-6 ms-0 ">
  <form action="index.php?ctrl=Advert&action=search" method="get" class="search-bar d-flex flex-column mb-4">
    <!-- Champ pour le titre de l'annonce -->
    <div class="mb-3">
      <input type="text" name="jobLabel" id="jobLabel" class="form-control" placeholder="Rechercher par titre d'annonce... ">
    </div>

    <!-- Champ pour le type de contrat -->
    <div class="mb-3">
        <select name="jobContractType" id="jobContractType" class="form-control">
        <option value="">Recherche part type de contrats -> Choisir dans la liste</option>
        <option value="CDI">CDI</option>
        <option value="CDD">CDD</option>
        <option value="Alternance">Alternance</option>
        <option value="Freelance">Freelance</option>
      </select>
    </div>

    <button type="submit" class="n-btn">Rechercher</button>
  </form>
</section>
<!-- FIN PAGINATION AND CO -->



<section class="container n-d-grid supplierList">


  <?php foreach ($advertList as $advert) : ?>

    <div class=" supplierCard n-col-3">
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

      <div class="d-flex justify-content-center gap-3">

        <?php if (
          $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Entreprise'
          ||
          $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Administrateur'
        ) : ?>
          <a href="index.php?ctrl=Advert&action=edit&id=<?= $advert->getJobAdvertId() ?>" type=" button" class="n-btn">Modifier</a>
          <a href="index.php?ctrl=Advert&action=delete&id=<?= $advert->getJobAdvertId() ?>" type=" button" class="btn-delete">Supprimer</a>
        <?php endif; ?>


        <?php if ($_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant') : ?>
          <a href="mailto:<?= htmlspecialchars($advert->getJobEmail()) ?>" class="n-btn">Postuler</a>
        <?php endif; ?>
      </div>

    </div>
  <?php endforeach; ?>
  <?php
  // include '../suppliers/layout_supplier_profile.php';
  // include '../items/layout_item_profile.php';
  ?>

</section>




<!-- NAV PAGINATION A FINIR-->