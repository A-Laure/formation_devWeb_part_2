<?php
session_start();

// unset($_POST);

dump($_POST, 'Create USER');

$title = "Creation Annonce";
$currentPage = "AdvertCreate";


// 1 = autorisation d'ajout, si différent de 1 dans la fiche userConnected => redirection
// redirectNotAllowed($_SESSION[APP_TAG]['connected']['autorisations'], 1);



// if (hasPower($pdo, (int) $roleId, $_SESSION[APP_TAG]['connected']['role_Id'])) {

//   $hashedPassword = password_hash($_POST['pwd'], PASSWORD_DEFAULT, ['cost' => 12]);

//   echo '<pre>';
//   echo 'LOG du $hashedPassword pwd : ';
//   echo $hashedPassword;
//   echo '<pre>';

// }


?>
<a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">Menu</a>

<h1 class="text-align-center title">Création d'une Annonce</h1>


<section class="container m-l-45">

  <?php

  # BANNER MESSAGE ALERTE
  if (!empty($_GET['_err'])) {
    $error = htmlspecialchars($_GET['_err']);
    echo "<div class='bg-warning fs-4 text'>{$error}</div>";
  }
  ?>


  <form action="index.php?ctrl=Advertr&action=store" method="post" class="formCreate ">

    <div class="mb-3 ">
      <label for="title" class="form-label">Titre de l'annonce<span> *</span></label>
      <input type="text" name="title" id="title" class="form-control">
    </div>

    <label for="typecontrat" class="form-label mb-3">Type de contrat :<span> *</span></label>
    <div class="d-flex flex-row">

      <label class="form--check-label" for="typecontrat">CDD</label>
      <input class="" type="radio" id="typecontrat" value="CDD" name="typecontrat">

      <label class="form-check-label" for="typecontrat">CDI</label>
      <input class="" type="radio" id="typecontrat" value="CDI" name="typecontrat">

      <label class="form-check-label" for="typecontrat">Alternance</label>
      <input class="" type="radio" id="typecontrat" value="Alternance" name="typecontrat">

      <label class="form-check-label" for="typecontrat">Freelance</label>
      <input class="" type="radio" id="typecontrat" value="Freelance" name="typecontrat">

    </div>

    <div class="mt-3 ">
      <label for="email" class="form-label">Email<span> *</span></label>
      <input type="email" name="email" id="email" class="form-control" value ="<?= $_SESSION[APP_TAG]['connected']['user_userEmail'] . '    ' . 'Vous pouvez la modifier'?>">
    </div>

    <div class="mb-3 ">
      <label for="loc" class="form-label">Localisation<span> *</span></label>
      <input type="text" name="loc" id="loc" class="form-control">
    </div>



    <div class="mb-3">
      <label for="textaera" class="form-label">Présentez-vous : <span> *</span></label>
      <textarea name="textaera" id="textaera" class="form-control" rows="4" placeholder="Votre description ici..."></textarea>
    </div>



    <div class="d-flex flex-wrap gap-2">
    <?php foreach($skillsAll as $index => $skill) : ?>
        <div class="form-check">
            <input type="radio" name="skills" id="skill<?= $index ?>" class="form-check-input" value="<?= htmlspecialchars($skill->getSkillLabel()) ?>">
            <label for="skill<?= $index ?>" class="form-check-label"><?= htmlspecialchars($skill->getSkillLabel()) ?></label>
        </div>
    <?php endforeach; ?>
</div>

  



    <button type="submit" class="n-btn btn-primary fs-3">Valider</button>

  </form>


</section>