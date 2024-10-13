<?php
session_start();
// dump($_POST, 'User_Edit -> Post du edit user');
// echo 'Get Id : ' , $_GET['id'];

// value=<?= $userData->getPwd()
?>


<!-- PENSER A LA REDIRECTION VERS LIST USER SI SUPER_ADMIN OU PROFIL SI USER -->

<h1 class="text-align-center title">Modification du profil de : <?= $_SESSION[APP_TAG]['connected']['user_userFirstname'] . "  " . $_SESSION[APP_TAG]['connected']['user_userlastname'] ?></h1>

<section class="userCreate ">

  <a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn mb-5">Menu</a>
  <!-- Mettre la fonction haspower voir esapce_admin Damien-->

  <!-- /index.php?ctrl=User&action=update&id= -->


  <form action="index.php?ctrl=User&action=update&id=<?= $_SESSION[APP_TAG]['connected']['user_userId'] ?>" method="post" class="">


    <p class="text-center" for="status"><?= $_SESSION[APP_TAG]['connected']['user_userStatus']  ?></p>
    <input type="hidden" name="status" id="status" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userStatus'] ?>">

    <label for="firstName" class="form-label">Prénom / Entité</label>
    <input type="text" name="firstName" id="firstName" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userFirstname'] ?>">

    <?php if (
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant'
      ||
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Administrateur'
    ) : ?> 
    <label for="lastname" class="form-label">Nom</label>
    <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userlastname']  ?>">
    <?php endif; ?>




    <label for="envrnt" class="form-label">Secteur</label>
    <input type="text" name="envrnt" id="envrnt" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userEnvrnt']  ?>">

    <label for="speciality" class="form-label">Secteur</label>
    <input type="text" name="speciality" id="speciality" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userSpeciality']  ?>">

    <label for="textaera" class="form-label">Description</label>
    <textarea name="textaera" id="textaera" class="form-control" rows="4"><?= $_SESSION[APP_TAG]['connected']['user_userTextaera']?></textarea>

    <label for="email" class="form-label">Email</label>
    <input type="mail" name="email" id="email" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userEmail']  ?>">

    <label for="lastName" class="form-label">Adresse</label>
    <input type="text" name="userAdr1" id="userAdr1" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userAdr1']  ?>">
    <input type="text" name="userAdr2" id="userAdr2" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userAdr2']  ?>">

    <div class="d-flex flex-row">
      <input type="text" name="userCp" id="userCp" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userCp']  ?>">
      <input type="text" name="userTown" id="userTown" class="form-control" value="<?= $_SESSION[APP_TAG]['connected']['user_userTown']  ?>">
    </div>


    <hr>
    <?php if (
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Etudiant'
      ||
      $_SESSION[APP_TAG]['connected']['user_userStatus'] === 'Administrateur'
    ) : ?> 
    <label for="skills[]" class="form-label">Compétences</label>

    <ul class="card-text">
  <?php
  if (!empty($allSkills)):
    foreach ($allSkills as $skill):
      $skillLabel = $skill['skill_skillLabel'];
  ?>
    <li>
      <label>
        <input type="checkbox" 
               name="skills[]" 
               value="<?= htmlspecialchars($skillLabel) ?>"
               <?= in_array($skillLabel, explode(',', $userEditDatas['skills'])) ? 'checked' : '' ?>>
        <?= htmlspecialchars($skillLabel) ?>
      </label>
    </li>
  <?php
    endforeach;
  else:
  ?>
    <li>Aucune compétence disponible</li>
  <?php endif; ?>
</ul>
<hr>


    <label for="networks[]" class="form-label">Réseaux Sociaux</label>

    <ul class="card-text">
  <?php
  if (!empty($allNetworks)):
    foreach ($allNetworks as $network):
      $networkLabel = $network['netw_networkLabel'];
  ?>
    <li>
      <label>
        <input type="checkbox" 
               name="networks[]" 
               value="<?= htmlspecialchars($networkLabel) ?>"
               <?= in_array($networkLabel, explode(',', $userEditDatas['networks'])) ? 'checked' : '' ?>>
        <?= htmlspecialchars($networkLabel) ?>
      </label>
    </li>
  <?php
    endforeach;
  else:
  ?>
    <li>Aucune compétence disponible</li>
  <?php endif; ?>
</ul>
<?php endif; ?>
<hr>

  

    <label for="pwd" class="form-label">Mot de Passe</label>
    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Si aucun changement, laisser vide" value=<?= $_SESSION[APP_TAG]['connected']['user_userPwd'] ?>>




    <button type="submit" class="btn btn-primary edit-btn fs-3">Modifier</button>


  </form>


  </div>


</section>

<?php

?>