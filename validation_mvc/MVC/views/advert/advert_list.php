<?php
// session_start();

$title = "Liste des Annonces";
$currentPage = "advertList";

/* dump($datas, '$datas');*/
/* dump($advertList, 'AdvertCtrl - ReadAll');  */


?>

<h1 class="text-align-center title">Liste des Annonces</h1>

<section class="container m-l-45 ">


  <!-- DIV BUTTON MENU ET CREER UNE ANNONCE-->
  <div class="d-flex flex-row justify-content-center ">
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

  <!-- BANNER MESSAGE ALERTE -->
  <?php
  if (!empty($_GET['_err'])) {
    $error = htmlspecialchars($_GET['_err']);
    echo "<div class='bg-warning fs-4 text mt-5'>{$error}</div>";
  }
  ?>

</section>



<!-- PAGINATION -->

<section class="container m-l-52 ">



  <!-- Par Page -->
  

  </div>

  <!-- SEARCH BAR-->

  <section class="container d-flex flex-row col-6 ms-0 w-25">
    <form action="index.php?ctrl=Advert&action=search" method="get" class="search-bar d-flex flex-column mb-4 w-100">
        <!-- Champ pour le titre de l'annonce -->
        <div class="mb-3">
            
            <input type="text" name="jobLabel" id="jobLabel" class="form-control" placeholder="Rechercher par titre d'annonce...">
        </div>

        <!-- Champ pour le type de contrat -->
        <div class="mb-3">
    
            <select name="jobContractType" id="jobContractType" class="form-control">
                <option value="">Choisir un type de contrat</option>
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




  <section class="d-grid supplierList ms-0">


    <?php foreach ($advertList as $advert) : ?>

      <div class="supplierCard d-flex  " style="flex: 1 0 30%; margin: 10px;">


        <div class="w-25 me-5 align-content-center">
          <h2 class="card-title "><?= $advert->getJobLabel() ?></h2>
          <p class="card-text"><?= $advert->getJobContractType() . ' /  ' . $advert->getJobStatus() ?></p>
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
            <a href="mailto:<?= htmlspecialchars($advert->getJobEmail()) ?>"  class="n-btn mt-4">Postuler</a>
          <?php endif; ?>
        </div>
        </div>

        <hr>

        <div class="w-50 text-start text-justify">
          <p class="card-text"><i class="fa-regular fa-envelope me-2"></i><?= htmlspecialchars($advert->getJobEmail()) ?></p>
          <p class="card-text"><i class="fa-solid fa-location-dot me-2 "></i><?= $advert->getJobTown() ?></p>
          <p class="card-text "><strong>Avantages : </strong> <?= $advert->getJobAdvantages() ?></p>
          <hr>
          <strong>Description du poste</strong>
          <p class="card-text text-justify"><?= $advert->getJobDescription() ?></p>
        </div>

        <hr>

        <div class="mx-4 ms-5 align-content-center" >
          <strong>Compétences</strong>
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
        </div>


        

      </div>
    <?php endforeach; ?>
    <?php
    // include '../suppliers/layout_supplier_profile.php';
    // include '../items/layout_item_profile.php';
    ?>

  </section>

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


  <!-- NAV PAGINATION A FINIR-->