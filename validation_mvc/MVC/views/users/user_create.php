<?php
// session_start();

// unset($_POST);

// dump($_POST, 'Create USER');

$title = "Creation User";
$currentPage = "userCreate";




?>


<h1 class="text-align-center title">Création d'un Compte Utilisateur</h1>



<section class="container m-l-45">



  <?php

  # BANNER MESSAGE ALERTE
  if (!empty($_GET['_err'])) {
    $error = htmlspecialchars($_GET['_err']);
    echo "<div class='bg-warning fs-4 text'>{$error}</div>";
  }
  ?>


  <form action="index.php?ctrl=User&action=store" method="post" class="formCreate ">


    <label for="status" class="form-label">Votre Statut :<span> *</span></label>

    <div class="d-flex flex-row">
      <label class="form-check-label" for="status">Etudiant</label>
      <input class="" type="radio" id="status" value="Etudiant" name="status">

      <label class="form-check-label" for="status">Entreprise</label>
      <input class="" type="radio" id="status" value="Entreprise" name="status">

      <label class="form-check-label" for="status">Admin</label>
      <input class="" type="radio" id="status" value="Admin" name="status">
    </div>


    <div class="mb-3 ">
      <label for="speciality" class="form-label">Spécialité</label>
      <input type="text" name="speciality" id="speciality" class="form-control">
    </div>


    <div class="mb-3 ">
      <label for="lastname" class="form-label mb-3">Nom<span> *</span></label>
      <input type="text" name="lastName" id="lastName" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="firstName" class="form-label">Prénom<span> *</span></label>
      <input type="text" name="firstName" id="firstname" class="form-control">
    </div>

<hr>
    <div class="d-flex flex-row">
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

    <div class="mb-3 ">
      <label for="email" class="form-label mb-3 mt-3">Email<span> *</span></label>
      <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="pwd" class="form-label mb-3">Password<span> *</span></label>
      <input type="password" name="pwd" id="pwd" class="form-control">
    </div>

    <div class="mb-3">
      <label for="textaera" class="form-label">Présentez-vous :</label>
      <textarea name="textaera" id="textaera" class="form-control" rows="4" placeholder="Votre description ici..."></textarea>
    </div>

    <hr>

    <div class="mb-3 ">
      <label for="userAdr1" class="form-label">N° + rue : </label>
      <input type="text" name="userAdr1" id="userAdr1" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="userAdr2" class="form-label">Complément d'adresse : </label>
      <input type="text" name="userAdr2" id="userAdr2" class="form-control">
    </div>


    <div class="mb-3 ">
      <label for="userCp" class="form-label">Code Postal: </label>
      <input type="text" name="userCp" id="userCp" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="userTown" class="form-label">Ville : </label>
      <input type="text" name="userTown" id="userTown" class="form-control">
    </div>
    <hr>


    <!-- NETWORKS -->
    <div class="d-flex flex-wrap">   
      <?php foreach ($userList as $user) : ?>
       
       <?php        
        // Vérifier que l'attribut `networks` est bien défini et qu'il s'agit d'un tableau
        $networks = $user->getNetworks();
        if (!is_array($networks)) {
          continue;
        }
        ?>

        <label for="networks[]" class="form-label">Réseaux  </label>
        <?php foreach ($networks as $index => $network) : ?>

          <div class="me-3 align-items-center small-checkbox">
            
        <label for="network[<?= $index ?>][networkId]" class="form-check-label ms-1"><?= htmlspecialchars($network->getNetworkLabel()) ?></label>
        <input type="hidden" name="networks[<?= $index ?>][networkId]" value="<?= $network->getNetworkId() ?>">
        <input type="text" name="networks[<?= $index ?>][networkLink]" class="form-check-input" placeholder="Saisir lien" required>
          </div>
     
        <?php endforeach; ?>
      <?php endforeach; ?>
      
    </div>
    <hr>
  
    <!-- SKILLS -->
    <label for="skills[]" class="form-label">Compétences </label>
    
    <div class="d-flex flex-row align-items-center" width="20px">
      <?php foreach ($userList as $user) : ?>
        <?php
        // Vérifier que l'attribut `networks` est bien défini et qu'il s'agit d'un tableau
        $skills = $user->getskills();
        if (!is_array($skills)) {
          continue;
        }
        ?>

        <?php foreach ($skills as $index => $skill) : ?>
         
          <div class="me-3 align-items-center small-checkbox">
            <label for="skills[]" class="form-check-label me-1"><?= htmlspecialchars($skill->getSkillLabel()) ?></label>
            <input
              type="checkbox"
              name="skills[]"
              id="skills[]"
              class="me-1"
              value="<?=$skill-> getSkillId() ?>">
       

        <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
    



    <button type="submit" class="n-btn btn-primary fs-3">Valider</button>

  </form>


</section>