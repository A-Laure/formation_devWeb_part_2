<?php
/* session_start(); */

/* if (isset(($_SESSION['form_data']))) {
  dump($_SESSION['form_data'], '$session Form data / Récup Data si zone manquante');
}  */

dump($_POST, '$_post');



$title = "Creation User";
$currentPage = "userCreate";

// Récup des infos déjà saisies en cas de zones manquantes pour éviter de tout retaper
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

unset($_SESSION['form_data']);
?>


<h1 class="text-align-center title">Création d'un Compte Utilisateur</h1>



<section class="container m-l-45">



  <?php

  # BANNER MESSAGE ALERTE
  if (!empty($_GET['_err'])) {
    $error = htmlspecialchars($_GET['_err']);
    echo "<div class='bg-warning fs-4 text mb-4'>{$error}</div>";
  }
  ?>


  <form action="index.php?ctrl=User&action=store" method="post" class="formCreate ">


    <!-- Statut -->
    <label for="status" class="form-label">Votre Statut :<span> *</span></label>
    <div class="d-flex flex-row">
      <label class="form-check-label">Etudiant</label>
      <input type="radio" value="Etudiant" name="status" <?= isset($form_data['status']) && $form_data['status'] === 'Etudiant' ? 'checked' : ''; ?>>

      <label class="form-check-label">Entreprise</label>
      <input type="radio" value="Entreprise" name="status" <?= isset($form_data['status']) && $form_data['status'] === 'Entreprise' ? 'checked' : ''; ?>>

      <label class="form-check-label">Admin</label>
      <input type="radio" value="Admin" name="status" <?= isset($form_data['status']) && $form_data['status'] === 'Admin' ? 'checked' : ''; ?>>
    </div>

    <!-- Spécialité -->
    <div class="mb-3 ">
      <label for="spe" class="form-label">Spécialité<span> *</span></label>
      <input type="text" name="spe" id="spe" class="form-control" value="<?= isset($form_data['spe']) ? htmlspecialchars($form_data['spe']) : ''; ?>">
    </div>


    <!-- Nom ou entité-->
    <div class="mb-3 ">
      <label for="lastname" class="form-label">Nom ou Entité<span> *</span></label>
      <input type="text" name="lastname" id="lastname" class="form-control"
        value="<?= isset($form_data['lastname']) ? htmlspecialchars($form_data['lastname']) : ''; ?>">
    </div>


    <div class="mb-3 ">
      <label for="firstname" class="form-label mb-3">Prénom</label>
      <input type="text" name="firstname" id="firstname" class="form-control" value="<?= isset($form_data['firstname']) ? htmlspecialchars($form_data['firstname']) : ''; ?>">
    </div>



    <hr>
    <div class="d-flex flex-row">
      <span> *</span>
      <label class="form-check-label" for="envrnt">IT</label>
      <input class="" type="radio" id="envrnt" value="IT" name="envrnt">

      <label class="form-check-label" for="envrnt">Communication</label>
      <input class="" type="radio" id="envrnt" value="Communication" name="envrnt">

      <label class="form-check-label" for="envrnt">Admin</label>
      <input class="" type="radio" id="envrnt" value="Communication" name="envrnt">
    </div>

    <label class="form-check-label mt-3" for="envrnt">Autres</label>
    <input class="" type="text" id="envrnt" value="" name="envrnt">
    </div>
    <hr>

    <!-- Email -->
    <div class="mb-3 ">
      <label for="email" class="form-label">Email<span> *</span></label>
      <input type="email" name="email" id="email" class="form-control" value="<?= isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>">
    </div>

    <!--PWD -->
    <div class="mb-3 ">
      <label for="pwd" class="form-label mb-3">Password<span> *</span></label>
      <input type="password" name="pwd" id="pwd" class="form-control">
    </div>

    <!-- Textaera -->
    <div class="mb-3">
      <label for="textaera" class="form-label">Présentez-vous :</label>
      <textarea name="textaera" id="textaera" class="form-control" rows="4"><?= isset($form_data['textaera']) ? htmlspecialchars($form_data['textaera']) : ''; ?></textarea>
    </div>

    <hr>

    <!-- Adr1 -->
    <div class="mb-3 ">
      <label for="userAdr1" class="form-label">N° + rue : </label>
      <input type="text" name="userAdr1" id="userAdr1" class="form-control" value="<?= isset($form_data['userAdr1']) ? htmlspecialchars($form_data['userAdr1']) : ''; ?>">
    </div>

    <!-- Adr2 -->
    <div class="mb-3 ">
      <label for="userAdr2" class="form-label">Complément d'adresse : </label>
      <input type="text" name="userAdr2" id="userAdr2" class="form-control" value="<?= isset($form_data['userAdr2']) ? htmlspecialchars($form_data['userAdr2']) : ''; ?>">
      </div>

      <!-- Cp-->
      <div class="mb-3 ">
        <label for="userCp" class="form-label">Code Postal: </label>
        <input type="text" name="userCp" id="userCp" class="form-control" value="<?= isset($form_data['userCp']) ? htmlspecialchars($form_data['userCp']) : ''; ?>">
      </div>

      <!-- Ville-->

      <div class="mb-3 ">
        <label for="userTown" class="form-label">Ville : </label>
        <input type="text" name="userTown" id="userTown" class="form-control" value="<?= isset($form_data['userTown']) ? htmlspecialchars($form_data['userTown']) : ''; ?>">
      </div>
      <hr>


      <!-- NETWORKS -->
      <div class="d-flex flex-wrap">
        <?php foreach ($userList as $user) : ?>
          <?php $networks = $user->getNetworks(); ?>
          <?php foreach ($networks as $index => $network) : ?>
            <div class="me-3 align-items-center small-checkbox">
              <label for="networks[<?= $index ?>][networkLink]" class="form-check-label ms-1"><?= htmlspecialchars($network->getNetworkLabel()) ?></label>
              <input type="hidden" name="networks[<?= $index ?>][networkId]" value="<?= $network->getNetworkId() ?>">
              <input type="text" name="networks[<?= $index ?>][networkLink]" class="form-check-input" placeholder="Saisir lien"
                value="<?= isset($form_data['networks'][$index]['networkLink']) ? htmlspecialchars($form_data['networks'][$index]['networkLink']) : ''; ?>">
            </div>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </div>
      <hr>

      <!-- SKILLS -->
      <label for="skills[]" class="form-label">Compétences </label>

      <?php foreach ($userList as $user) : ?>
        <?php $skills = $user->getskills(); ?>
        <?php foreach ($skills as $index => $skill) : ?>
          <div class="me-3 align-items-center small-checkbox">
            <label for="skills[<?= $index ?>]" class="form-check-label me-1"><?= htmlspecialchars($skill->getSkillLabel()) ?></label>
            <input type="checkbox" name="skills[]" id="skills[<?= $index ?>]" class="me-1" value="<?= $skill->getSkillId() ?>"
              <?= (isset($form_data['skills']) && in_array($skill->getSkillId(), $form_data['skills'])) ? 'checked' : ''; ?>>
          </div>
        <?php endforeach; ?>
      <?php endforeach; ?>

      </div>




      <button type="submit" class="n-btn btn-primary fs-3">Valider</button>

  </form>


</section>