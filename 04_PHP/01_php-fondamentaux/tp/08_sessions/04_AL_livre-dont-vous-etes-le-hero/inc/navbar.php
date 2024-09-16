<?php
if (session_id() == '') {
  session_start();
}

include '../functions/_helpers/tools.php';
include '../datas/datas.php';
?>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">Admin Connexion | Sessions</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>



    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <?php if (isset($_SESSION['ok'])) : ?>


        <?php if ($_SESSION['ok'][0]['statut'] === 'A') : ?>

       

          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link <?= $currentPage === 'accueil' ? 'active' : '' ?>" aria-current="page" href="home.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $currentPage === 'alumnis' ? 'active' : '' ?>" href="alumnis.php">Admin</a>
            </li>
          </ul>

        <?php elseif ($_SESSION['ok'][0]['statut'] === 'S-A') : ?>

        

          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link <?= $currentPage === 'accueil' ? 'active' : '' ?>" aria-current="page" href="home.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $currentPage === 'alumnis' ? 'active' : '' ?>" href="alumnis.php">Admin</a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?= $currentPage === 'centre' ? 'active' : '' ?>" aria-disabled="true">SuperAdmin</a>
            </li>
          </ul>
              

        <?php elseif ($_SESSION['ok'][0]['statut']=== 'I') : ?>

    

          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link <?= $currentPage === 'accueil' ? 'active' : '' ?>" aria-current="page" href="home.php">Dashboard</a>
            </li>
          </ul>
          <?php endif; ?>

        

        <?php else : ?>
        <p class="navbar-text">Statut non défini.</p>

        <?php endif; ?>

        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

      </div>
   
  </div>
</nav>

<pre>
<?php if (!isset($_SESSION['ok'])) {
	echo "Rien à afficher";
} else {
	var_dump($_SESSION['ok']);
}
?>
</pre>
