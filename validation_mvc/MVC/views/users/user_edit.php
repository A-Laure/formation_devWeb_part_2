<?php

dump($_POST, 'User_Edit -> Post du edit user');
echo 'Get Id : ' , $_GET['id'];

// value=<?= $userData->getPwd() ?>
?>

<!-- PENSER A LA REDIRECTION VERS LIST USER SI SUPER_ADMIN OU PROFIL SI USER -->

<h1 class="text-align-center title">Modification du profil de : <?= $userData->getFirstName() . '  ' . $userData->getLastName() ?></h1> 

<section class="userCreate ">

<!-- Mettre la fonction haspower voir esapce_admin Damien-->

<!-- /index.php?ctrl=User&action=update&id= -->
<!-- <?= $userData->getIdUser() ?> -->

<form action="index.php?ctrl=User&action=update&id=<?= $userData->getIdUser() ?>" method="post" class="">

 
    <label for="firstName" class="form-label" >Nom</label>
    <input type="text" name="firstName" id="firstName" class="form-control" value=<?= $userData->getFirstName() ?> >
   
    <label for="lastName" class="form-label">Prénom</label>
    <input type="text" name ="lastName" id="lastName" class="form-control" value=<?= $userData->getLastName() ?>>
 
    <label for="email" class="form-label">Email</label>
    <input type="mail" name="email" id="email" class="form-control" value=<?= $userData->getEmail() ?> >

    <label for="pwd" class="form-label">Mot de Passe</label>
    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Si aucun changement, laisser vide" >
 
 <label for="roleId" class="form-label">Rôle</label>
    <input type="text" name="roleId" id="role" class="form-control" value=<?= $userData->getRoleId()?>> 


    <button type="submit" class="btn btn-primary edit-btn fs-3">Modifier</button>
  

</form>


</div>


</section>

<?php

?>
