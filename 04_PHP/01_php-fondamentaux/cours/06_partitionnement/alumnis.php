  <?php 

    $title = "Alumnis";
    $currentPage = "alumnis";

    # include : inclut un fichier, on un avertissement si le fichier n'existe pas (n'existe pas pour le code donc ça veut dire que cela peut être un erreur d'écriture/chemin aussi) 

    # include_once : pareil que le include sauf qu'en plus évite les inclusions multiples du même fichier  

    # require : inclut un fichier, on a une fatal error si le fichier n'existe pas et donc un arrêt du script (n'existe pas pour le code donc ça veut dire que cela peut être un erreur d'écriture/chemin aussi) 

    # require_once : pareil que le require sauf qu'en plus évite les inclusions multiples du même fichier  

    include 'data/data.php';

    require 'functions/functions.php';
    require_once 'functions/functions.php';
    

    include 'functions/_helpers/tools.php';

    include 'inc/head.php';
    include_once 'inc/head.php';
    include 'inc/navbar.php';


  ?>


  
  <div class="container mt-5">

    <h1 class="mt-3">Liste des Alumnis</h1>

    <h2 class="mt-5 mb-3">Nombre d'alumnis par spécialité</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4 ">

      <?php foreach (speAlumni($alumnis) as $spe => $num) : ?>
        <div class="col">
          <div class="card text-bg-light mb-3  text-center">

            <div class="card-body">
              <h5 class="card-title "><?= $num ?></h5>
            </div>
            <div class="card-footer"><?= $spe ?></div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <h2 class="mt-5 mb-3">Taux d'alumnis en poste</h2>
    <div class="progress " role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
      <div class="progress-bar bg-success" style="width: <?= statAlumnisJob($alumnis) ?>%"><?= statAlumnisJob($alumnis) ?>%</div>
    </div>

    <h2 class="mt-5 mb-3">Taux d'alumnis en poste par spe</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php foreach (statSpeJob($alumnis) as $speciality => $percent) : ?>
        <div class="col">
          <div class="card shadow-sm mb-4" data-bs-theme="dark">
            <div class="card-body text-center p-4 p-xxl-5">
              <h3 class="display-4 fw-bold mb-2"><?= $percent ?>%</h3>
              <p class="fs-5 mb-0 text-secondary mt-auto"><?= $speciality ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


    <table class="table table-striped mt-5">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Prénom</th>
          <th scope="col">Nom</th>
          <th scope="col">Email</th>
          <th scope="col">Titre</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($alumnis as $alumni) : ?>
          <tr>
            <th scope="row"><?= $alumni['id'] ?></th>
            <td><?= $alumni['firstname'] ?></td>
            <td><?= $alumni['lastname'] ?></td>
            <td><?= $alumni['email'] ?></td>
            <td><?= $alumni['title'] ?></td>
            <td><button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#profil-card<?= $alumni['id'] ?>" aria-controls="offcanvasRight">Voir profil</button></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

  <!-- OffCanvas (barre latérale droite) -->
  <?php foreach ($alumnis as $alumni) : ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="profil-card<?= $alumni['id'] ?>" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel"><?= $alumni['firstname'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <p><?= $alumni['title'] ?></p>
        <p><?= $alumni['description'] ?></p>
        <p><?= $alumni['classOption'] ?></p>
      </div>
    </div>
  <?php endforeach; ?>


  <hr>
  <?php debug(statSpeJob($alumnis)); ?>

<?php 

  include 'inc/foot.php';

?>
