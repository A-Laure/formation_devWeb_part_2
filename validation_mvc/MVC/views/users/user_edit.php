<?php
session_start();
dump($_POST, 'User_Edit -> Post du edit user');
// echo 'Get Id : ' , $_GET['id'];

// value=<?= $userData->getPwd()
 ?>

<a href="index.php?ctrl=Dashboard&action=menu" type="button" class="n-btn">Menu</a>
<!-- PENSER A LA REDIRECTION VERS LIST USER SI SUPER_ADMIN OU PROFIL SI USER -->

<h1 class="text-align-center title">Modification du profil de : <?= $_SESSION[APP_TAG]['connected']['user_userFirstname'] . "  " . $_SESSION[APP_TAG]['connected']['user_userlastname']?></h1> 

<section class="userCreate ">


<!-- Mettre la fonction haspower voir esapce_admin Damien-->

<!-- /index.php?ctrl=User&action=update&id= -->


<form action="index.php?ctrl=User&action=update&id=<?= $_SESSION[APP_TAG]['connected']['user_userId']?>" method="post" class="">

 
    <label for="firstName" class="form-label" >Prénom</label>
    <input type="text" name="firstName" id="firstName" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userFirstname']  ?> >
   
    <label for="lastName" class="form-label">Nom</label>
    <input type="text" name ="lastName" id="lastName" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userStatus']  ?>>

    <label for="status" class="form-label">Statut</label>
    <input type="text" name ="status" id="status" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userlastname']  ?>>

    <label for="envrnt" class="form-label">Secteur</label>
    <input type="text" name ="envrnt" id="envrnt" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userEnvrnt']  ?>>

    <label for="speciality" class="form-label">Secteur</label>
    <input type="text" name ="speciality" id="speciality" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userSpeciality']  ?>>
 
    <label for="textaera" class="form-label">Description</label>
    <textarea name="textaera" id="textaera" class="form-control" rows="4"  value=<?= $_SESSION[APP_TAG]['connected']['user_userTextaera']  ?>"></textarea>   

    <label for="email" class="form-label">Email</label>
    <input type="mail" name="email" id="email" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userEmail']  ?> >

    <label for="lastName" class="form-label">Adresse</label>
    <input type="text" name ="userAdr1" id="userAdr1" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userAdr1']  ?>>
    <input type="text" name ="userAdr2" id="userAdr2" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userAdr2']  ?>>

    <div class="d-flex flex-row">
    <input type="text" name ="userCp" id="userCp" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userCp']  ?>>
    <input type="text" name ="userTown" id="userTown" class="form-control" value=<?= $_SESSION[APP_TAG]['connected']['user_userTown']  ?>>
    </div>

    <!-- <div class="d-flex form-check">
      <?php foreach ($techskills as $skill) : ?>
        <label for="skills" class="form-radio"><?= $skill->getSkillLabel() ?></label>
        <input type="radio" name="skills" id="skill" class="radioFormat" value="<?= $skill->getSkillLabel() ?>">
      <?php endforeach; ?>
    </div>

    <div class="d-flex form-check">
      <?php foreach ($networks as $network) : ?>
        <label for="networks" class="form-radio"><?= $network->getnetworkLabel() ?></label>
        <input type="radio" name="networks" id="network" class="radioFormat" value="<?= $network->getSkillLabel() ?>">
      <?php endforeach; ?>
    </div>
    -->

    <label for="pwd" class="form-label">Mot de Passe</label>
    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Si aucun changement, laisser vide" value=<?= $_SESSION[APP_TAG]['connected']['user_userPwd']?>>
 



    <button type="submit" class="btn btn-primary edit-btn fs-3">Modifier</button>
  

</form>


</div>


</section>

<?php

?>
