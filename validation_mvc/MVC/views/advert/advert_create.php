<?php
session_start();

// unset($_POST);

// dump($_POST, 'Create Advert');
// dump( $_SESSION[APP_TAG]['connected'], 'UserConnected');

$title = "Creation Annonce";
$currentPage = "AdvertCreate";


?>

<section class="container ">
<h1 class="text-align-center title">Création d'une Annonce</h1>

<div class="d-flex flex-row">
    <a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">
    <i class="fa-solid fa-home"></i>
    <p class="align-items-center"> Menu</p>
    </a>

  <?php

  # BANNER MESSAGE ALERTE
  if (!empty($_GET['_err'])) {
    $error = htmlspecialchars($_GET['_err']);
    echo "<div class='bg-warning fs-4 text'>{$error}</div>";
  }
  ?>

</section>



<section class="container">
  <form action="index.php?ctrl=Advert&action=store" method="post" class="formCreate ">

    <div class="mb-3 ">
    <label for="userId" class="form-label"></label>
      <input type="hidden" name="userId" id="userId" class="form-control"   value = "<?= $_SESSION[APP_TAG]['connected']['user_userId']?>" >
    </div>

    <div class="mb-3 ">
      <label for="jobLabel" class="form-label">Titre de l'annonce<span> *</span></label>
      <input type="text" name="jobLabel" id="jobLabel" class="form-control">
    </div>



    <label for="jobStatus" class="form-label mb-3">Statut de l'annonce :<span> *</span></label>
    <div class="d-flex flex-row">

      <label class="form--check-label" for="jobStatus">Ouverte</label>
      <input class="" type="radio" id="jobStatus" value="CDD" name="jobStatus">

      <label class="form-check-label" for="jobStatus">Pourvue</label>
      <input class="" type="radio" id="jobStatus" value="CDI" name="jobStatus">  

    </div>

    <label for="jobContractType" class="form-label mb-3">Type de contrat :<span> *</span></label>
    <div class="d-flex flex-row">

      <label class="form-check-label" for="jobContractType">CDD</label>
      <input class="" type="radio" id="jobContractType" value="CDD" name="jobContractType">

      <label class="form-check-label" for="jobContractType">CDI</label>
      <input class="" type="radio" id="jobContractType" value="CDI" name="jobContractType">

      <label class="form-check-label" for="jobContractType">Alternance</label>
      <input class="" type="radio" id="jobContractType" value="Alternance" name="jobContractType">

      <label class="form-check-label" for="jobContractType">Freelance</label>
      <input class="" type="radio" id="jobContractType" value="Freelance" name="jobContractType">

    </div>

    <div class="mt-3 ">
      <label for="jobEmail" class="form-label">Email<span> *</span></label>
      <input type="email" name="jobEmail" id="jobEmail" class="form-control" value ="<?= $_SESSION[APP_TAG]['connected']['user_userEmail'] ?>">
    </div>

    <div class="mb-3 ">
      <label for="jobTown" class="form-label">Localisation<span> *</span></label>
      <input type="text" name="jobTown" id="jobTown" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="jobAdvantages" class="form-label">Avantages<span>*</span></label>
      <textarea type="text" name="jobAdvantages" id="jobAdvantages" class="form-control"></textarea>
    </div>

    <div class="mb-3">
      <label for="jobDescription" class="form-label">Présentez-vous : <span> *</span></label>
      <textarea name="jobDescription" id="jobDescription" class="form-control" rows="4" placeholder="Votre description ici..."></textarea>
    </div>

<!-- SKILLS -->
<div class="d-flex flex-wrap" >
    <label class="form-label mb-3">Compétences :<span> *</span></label>
    <?php foreach ($advertList as $user) : ?>
        <?php
        // Get the skills array and check if it's defined and an array
        $skills = $user->getskills();
        if (!is_array($skills)) {
            continue;
        }
        ?>
        <?php foreach ($skills as $skill) : ?>
            <div class="form-check ms-1">
            <label for="skill-<?= htmlspecialchars($skill->getSkillId()) ?>" class="form-check-label">
                    <?= htmlspecialchars($skill->getSkillLabel()) ?> - Cocher Case -
                </label>
                <input
                    type="checkbox"
                    name="skills[]"
                    id="skill-<?= htmlspecialchars($skill->getSkillId()) ?>"
                    class="form-check-input"
                    value="<?= htmlspecialchars($skill->getSkillId()) ?>">
               
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

  



    <button type="submit" class="n-btn btn-primary fs-3">Valider</button>

  </form>


</section>