<?php
session_start();

unset($_POST);

$title = "Creation User";
$currentPage = "userCreate";


// 1 = autorisation d'ajout, si différent de 1 dans la fiche userConnected => redirection
// redirectNotAllowed($_SESSION[APP_TAG]['connected']['autorisations'], 1);

/*
try {

  # Connexion à la BDD
  $pdo = dbConnect();

  # 1 / RECUPERER TOUS LES ROLES POUR LES AFFICHER DANS LE DROPDOWN DU LE FORMULAIRE 
  // PRINT des logs POSSIBLES en enlevant les REDIRECTIONS
// Récupérer tous les rôles pour les afficher dans le dropdown du formulaire
$query = "SELECT * FROM role WHERE role_power >= :rol_power_userConnected ORDER BY role_power";
  
if (($request = $pdo->prepare($query)) !== false) {
  if ($request->bindValue(':rol_power_userConnected', $_SESSION[APP_TAG]['connected']['role_Id'], PDO::PARAM_INT)) {
    if ($request->execute()) {
      $recupAllRoles = $request->fetchAll(PDO::FETCH_ASSOC);
      $request->closeCursor();
    }
  }
}
} catch (PDOException $e) {
die($e->getMessage());
}
*/



    // if (hasPower($pdo, (int) $roleId, $_SESSION[APP_TAG]['connected']['role_Id'])) {

    //   $hashedPassword = password_hash($_POST['pwd'], PASSWORD_DEFAULT, ['cost' => 12]);

    //   echo '<pre>';
    //   echo 'LOG du $hashedPassword pwd : ';
    //   echo $hashedPassword;
    //   echo '<pre>';

    // }


?>


<h1 class="text-align-center title">Création d'un Compte Utilisateur</h1>


<section class="n-container m-l-45">

  <?php

  # BANNER MESSAGE ALERTE
  if (isset($msg)) {
    echo $msg;
  }
  ?>


  <form action="" method="post" class="formCreate ">

    <div class="mb-3 ">
      <label for="firstName" class="form-label">Prénom<span> *</span></label>
      <input type="text" name="firstName" id="firstname" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="lastname" class="form-label mb-3">Nom<span> *</span></label>
      <input type="text" name="lastName" id="lastName" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="email" class="form-label mb-3">Email<span> *</span></label>
      <input type="mail" name="email" id="email" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="pwd" class="form-label mb-3">Password<span> *</span></label>
      <input type="pwd" name="pwd" id="pwd" class="form-control">
    </div>

    <div class="mb-3 ">
      <label for="roleSelect" class="form-label">Role<span> *</span></label>
      <select name="roleSelect" id="roleSelect" class="form-select">
        <!-- <?php foreach ($recupAllRoles as $role) : ?>
          <option value="<?= $role['role_Id'] ?>"> <?= $role['role_label'] ?> </option>
        <?php endforeach; ?> -->
      </select>
    </div>

    <button type="submit" class="n-btn btn-primary fs-3">Valider</button>

  </form>


</section>

