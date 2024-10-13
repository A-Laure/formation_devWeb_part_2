<?php
session_start();
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
    <?php



$isAdmin = ($_SESSION[APP_TAG]['connected']['user_userStatus'] ?? '') === 'Administrateur';
$isEditingStudent = ($userToEdit['user_userStatus'] ?? '') === 'Etudiant';
$isSelfEdit = ($_SESSION[APP_TAG]['connected']['user_userId'] ?? '') === ($userToEdit['user_userId'] ?? '');

// Afficher les champs de compétences et de réseaux sociaux si :
// 1. L'utilisateur édite son propre profil et est un étudiant, OU
// 2. L'administrateur édite le profil d'un étudiant
if (($isSelfEdit && $isEditingStudent) || ($isAdmin && $isEditingStudent)) : 
?>
    <label for="skills[]" class="form-label">Compétences</label>

    <ul class="card-text">
    <?php if (!empty($allSkills)): ?>
        <?php 
        $userSkills = !empty($userToEdit['skills']) ? explode(',', $userToEdit['skills']) : [];
        foreach ($allSkills as $skill):
            $skillLabel = $skill['skill_skillLabel'];
        ?>
        <li>
            <label>
                <input type="checkbox" 
                       name="skills[]" 
                       value="<?= htmlspecialchars($skillLabel) ?>"
                       <?= in_array($skillLabel, $userSkills) ? 'checked' : '' ?>>
                <?= htmlspecialchars($skillLabel) ?>
            </label>
        </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucune compétence disponible</li>
    <?php endif; ?>
    </ul>
    <hr>

    <label for="networks[]" class="form-label">Réseaux Sociaux</label>

    <ul class="card-text">
    <?php if (!empty($allNetworks)): ?>
        <?php 
        $userNetworks = !empty($userToEdit['networks']) ? explode(',', $userToEdit['networks']) : [];
        foreach ($allNetworks as $network):
            $networkLabel = $network['netw_networkLabel'];
        ?>
        <li>
            <label>
                <input type="checkbox" 
                       name="networks[]" 
                       value="<?= htmlspecialchars($networkLabel) ?>"
                       <?= in_array($networkLabel, $userNetworks) ? 'checked' : '' ?>>
                <?= htmlspecialchars($networkLabel) ?>
            </label>
        </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucun réseau social disponible</li>
    <?php endif; ?>
    </ul>
<?php endif; ?>
    <hr>

    <label for="pwd" class="form-label">Mot de Passe</label>
    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Si aucun changement, laisser vide" value="<?= htmlspecialchars($user->getUserPwd() ?? '') ?>">

    <button type="submit" class="btn btn-primary edit-btn fs-3">Modifier</button>

  </form>

</section>