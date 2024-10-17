<?php
session_start();
/* dump($userNetworkdatas, 'UserCtrl- Edit- $userNetworkdatas'); */
/* dump($userEditDatas['links'],'$userEditDatas[links]');
dump($userEditDatas['networks'],'$userEditDatas[networks]');*/
/* dump($user,'$user - Object' ); 
dump($userEditDatas['skills'],'$userEditDatas[skills]');  */
/* dump($userEditDatas, 'UserCtrl- Edit- $userEditDatas'); */
/* dump($allSkills, 'UserCtrl- Edit- $allSkills');  
dump($userSkills, 'UserCtrl- Edit- $userSkills'); */

/*dump($_POST, '$post');*/
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


<!-- NETWORKS À Modifier -->
<div class="d-flex flex-column">
    <?php if (!empty($userNetworkdatas)) : ?>
        <?php foreach ($userNetworkdatas as $network) : ?>
            <?php
            // Récupère le lien correspondant au réseau courant
            $userLink = ''; // Initialise le lien utilisateur
            foreach ($user->getLinks() as $link) {  // Utilisation de $user->getLinks() pour obtenir les liens
                if ($link->getNetworkId() === $network->getNetworkId()) {
                    $userLink = $link->getNetworkLink(); // Stocke le lien correspondant
                    break;
                }
            }
            ?>
            <div class="mb-3">
                <label class="form-check-label" for="network_<?= htmlspecialchars($network->getNetworkId()) ?>">
                    <?= htmlspecialchars($network->getNetworkLabel()) ?>
                </label>
                <input
                    type="text"
                    name="network_links[<?= htmlspecialchars($network->getNetworkId()) ?>]"  
                    id="network_<?= htmlspecialchars($network->getNetworkId()) ?>"
                    class="form-control"
                    value="<?= htmlspecialchars($userLink) ?>"
                    placeholder="Entrez le lien pour <?= htmlspecialchars($network->getNetworkLabel()) ?>" />
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun réseau disponible.</p>
    <?php endif; ?>
</div>






















<!-- SKILLS À Modifier -->
<label for="skills[]" class="form-label">Compétences</label>
<div class="d-flex flex-row align-items-center" width="20px">
    <?php if (!empty($allSkills)) : ?>
        <?php foreach ($allSkills as $skill) : ?>
            <?php
            // Vérifie que $skill a les clés requises
            if (isset($skill['skill_skillId']) && isset($skill['skill_skillLabel'])) : 
                // Vérifie si la compétence est déjà sélectionnée dans userSkills
                $isChecked = false; 
                foreach ($userSkills as $userSkill) {
                    // Compare avec skillId pour vérifier
                    if ($userSkill->getSkillId() === $skill['skill_skillId']) { 
                        $isChecked = true;
                        break;
                    }
                }
            ?>
                <div class="me-3 align-items-center small-checkbox">
                    <label class="form-check-label me-1"><?= htmlspecialchars($skill['skill_skillLabel']) ?></label>
                    <input
                        type="checkbox"
                        name="skill_ids[]"  
                        id="skills_<?= htmlspecialchars($skill['skill_skillId']) ?>"
                        class="me-1"
                        value="<?= htmlspecialchars($skill['skill_skillId']) ?>"
                        <?= $isChecked ? 'checked' : '' ?> />
                </div>
            <?php else: ?>
                <div>Les données de compétence ne sont pas valides.</div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div>Aucune compétence disponible.</div>
    <?php endif; ?>
</div>




    


    <label for="pwd" class="form-label">Mot de Passe</label>
<input type="password" name="pwd" id="pwd" class="form-control" placeholder="Si aucun changement, laisser vide">


    <button type="submit" class="btn btn-primary edit-btn fs-3">Modifier</button>

  </form>

</section>