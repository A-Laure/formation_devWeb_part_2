<?php
session_start();

// unset($_POST);

dump($_POST, '$_post - Edit Advert');

$title = "Creation Annonce";
$currentPage = "AdvertCreate";


?>


<h1 class="text-align-center title">Modification d'une Annonce</h1>




<section class="container m-l-45">
<div class="d-flex flex-row">
    <a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">
    <i class="fa-solid fa-home"></i>
    <p class="align-items-center"> Menu</p>
    </a>
</div>

  <?php

  # BANNER MESSAGE ALERTE
  if (!empty($_GET['_err'])) {
    $error = htmlspecialchars($_GET['_err']);
    echo "<div class='bg-warning fs-4 text'>{$error}</div>";
  }
  ?>


  <form action="index.php?ctrl=Advert&action=update&id=<?=$advert->getJobAdvertId()?>" method="post" class="formCreate ">

    <div class="mb-3 ">
    <label for="userid" class="form-label"></label>
      <input type="hidden" name="userid" id="userid" class="form-control"   value = "<?= $advert->GetUserId()?>" >
    </div>



    <div class="mb-3 ">
      <label for="joblabel" class="form-label">Titre de l'annonce</label>
      <input type="text" name="joblabel" id="joblabel" class="form-control" value="<?=$advert->GetJobLabel()?>">
    </div>



    <label for="jobstatus" class="form-label mb-3">Statut de l'annonce :</label>
    <div class="d-flex flex-row">

      <label class="form-check-label" >Ouverte</label>
      <input class="" type="radio" id="jobstatus" value="Ouverte" name="jobstatus"   <?php if ($advert->getJobStatus() === 'Ouverte') echo 'checked'; ?>>

      <label class="form-check-label" >Pourvue</label>
      <input class="" type="radio" id="jobstatus" value="Pourvue" name="jobstatus"   <?php if ($advert->getJobStatus() === 'Pourvue') echo 'checked'; ?>>  

    </div>

    <label for="jobcontracttype" class="form-label mb-3">Type de contrat :</label>
    <div class="d-flex flex-row">

      <label class="form--check-label" >CDD</label>
      <input class="" type="radio" id="jobcontracttype" value="CDD" name="jobcontracttype"   <?php if ($advert->getJobContractType() === 'CDD') echo 'checked'; ?>>

      <label class="form-check-label" >CDI</label>
      <input class="" type="radio" id="jobcontracttype" value="CDI" name="jobcontracttype"   <?php if ($advert->getJobContractType() === 'CDI') echo 'checked'; ?>>

      <label class="form-check-label" >Alternance</label>
      <input class="" type="radio" id="jobcontracttype" value="Alternance" name="jobcontracttype"   <?php if ($advert->getJobContractType() === 'Alternance') echo 'checked'; ?>>

      <label class="form-check-label" >Freelance</label>
      <input class="" type="radio" id="jobcontracttype" value="Freelance" name="jobcontracttype"   <?php if ($advert->getJobContractType() === 'Freelance') echo 'checked'; ?>>

    </div>

    <div class="mt-3 ">
      <label for="jobemail" class="form-label">Email</label>
      <input type="email" name="jobemail" id="jobemail" class="form-control" placeholder ="<?= $_SESSION[APP_TAG]['connected']['user_userEmail'] ?>">
    </div>


    <div class="mb-3 ">
      <label for="jobtown" class="form-label">Localisation</label>
      <input type="text" name="jobtown" id="jobtown" class="form-control" value="<?=$advert->GetJobTown()?>">
    </div>

    <div class="mb-3 ">
      <label for="jobadvantages" class="form-label">Avantages</label>
      <textarea type="text" name="jobadvantages" id="jobadvantages" class="form-control" row="4" ><?=$advert->getJobAdvantages()?></textarea>
    </div>

    <div class="mb-3">
      <label for="jobdescription" class="form-label">Présentez-vous : </label>
      <textarea name="jobdescription" id="jobdescription" class="form-control" rows="4" placeholder="Votre description ici..."><?=$advert->getJobDescription()?></textarea>
    </div>



  



    <button type="submit" class="n-btn btn-primary fs-3">Valider</button>

  </form>


</section>