<?php
session_start();
dump($user);
dump($userEditDatas, 'UserCtrl- Edit- $userEditDatas');
dump($skillDatas, 'UserCtrl- Edit- $skillDatas');
dump($networkDatas, 'UserCtrl- Edit- $networktDatas');
?>


<h1 class="text-align-center title">Modification du profil de : <?= htmlspecialchars($user->getUserFirstName() ?? '') . " " . htmlspecialchars($user->getUserLastName() ?? '') ?></h1>



<section class="userCreate">
<div class="justify-content-center mt-5 mb-5">
    <a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">
      <i class="fa-solid fa-home"></i>
      <p class="align-items-center"> Menu</p>
    </a>
  </div>

  <form action="index.php?ctrl=User&action=update&id=<?= htmlspecialchars(htmlspecialchars($user->getUserId()) ?? '') ?>" method="post" class="">

  <!-- STATUT NE CHANGERA PAS DC HIDDEN -->
    <p class="text-center" for="status"><?= htmlspecialchars($user->getUserStatus() ?? '') ?></p>
    <input type="hidden" name="status" id="status" class="form-control" value="<?= htmlspecialchars($user->getUserStatus() ?? '') ?>">

    <label for="firstname" class="form-label">Prénom / Entité</label>
    <input type="text" name="firstname" id="firstname" class="form-control" value="<?= htmlspecialchars($user->getUserFirstName() ?? '') ?>">

    <?php if (
      ($_SESSION[APP_TAG]['connected']['user_userStatus'] ?? '') === 'Etudiant'
      ||
      ($_SESSION[APP_TAG]['connected']['user_userStatus'] ?? '') === 'Administrateur'
    ) : ?> 
    <label for="lastname" class="form-label">Nom</label>
    <input type="text" name="lastname" id="lastname" class="form-control" value="<?= htmlspecialchars($user->getUserLastName() ?? '') ?>">
    <?php endif; ?>

    <label for="envrnt" class="form-label">Secteur</label>
    <input type="text" name="envrnt" id="envrnt" class="form-control" value="<?= htmlspecialchars($user->getUserEnvrnt() ?? '') ?>">

    <label for="speciality" class="form-label">Spécialité</label>
    <input type="text" name="speciality" id="speciality" class="form-control" value="<?= htmlspecialchars($user->getUserSpeciality() ?? '') ?>">

    <label for="textaera" class="form-label">Description</label>
    <textarea name="textaera" id="textaera" class="form-control" rows="4"><?= htmlspecialchars($user->getUserTextaera() ?? '') ?></textarea>

    <label for="email" class="form-label">Email</label>
    <input type="mail" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user->getUserEmail() ?? '') ?>">

    <label for="adr1" class="form-label">N° + voie</label>
    <input type="text" name="adr1" id="userAdr1" class="form-control" value="<?= htmlspecialchars($user->getUserAdr1() ?? '') ?>">

    <label for="adr2" class="form-label">N° + voie</label>
    <input type="text" name="adr2" id="adr2" class="form-control" value="<?= htmlspecialchars($user->getUserAdr2() ?? '') ?>">

    <div class="d-flex flex-row">
      <input type="text" name="cp" id="cp" class="form-control" value="<?= htmlspecialchars($user->getUserCP() ?? '') ?>">
      <input type="text" name="town" id="town" class="form-control" value="<?= htmlspecialchars($user->getUserTown() ?? '') ?>">
    </div>

    <hr>
 
   <!-- NETWORKS -->
<div class="d-flex flex-wrap">
    <?php if (!empty($user->getNetworks())) : ?>
        <label class="form-label">Réseaux</label>
        <?php foreach ($user->getNetworks() as $index => $network) : ?>
            <div class="me-3 align-items-center small-checkbox">
                <label for="links_<?= $index ?>" class="form-check-label ms-1">
                    <?= htmlspecialchars($network->getNetworkLabel()) ?>
                </label>
                <input
                    type="text"
                    name="links[]"
                    id="links_<?= $index ?>"
                    class="form-check-input"
                    value="<?= htmlspecialchars($network->getNetworkLink()) ?>">
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucun réseau disponible.</p>
    <?php endif; ?>
</div>
<hr>

<!-- SKILLS -->
<label for="u" class="form-label">Compétences</label>
<div class="d-flex flex-row">
    <?php if (isset($skillList)) : ?>
        <?php foreach ($skillList as $skill) : ?>
            <label for="skill[]" class="form-check-label ms-1">
                <?= htmlspecialchars($skill->getSkillLabel()) ?>
            </label>
            <input
                type="checkbox"
                name="skill[]"
                id="skill[]"
                class="form-check-input"
                value="<?= htmlspecialchars($skill->getSkillId()) ?>">
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucune compétence disponible.</p>
    <?php endif; ?>
</div>




    

    <label for="pwd" class="form-label">Mot de Passe</label>
    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Si aucun changement, laisser vide" value="<?= htmlspecialchars($user->getUserPwd() ?? '') ?>">

    <button type="submit" class="btn btn-primary edit-btn fs-3">Modifier</button>

  </form>

</section>