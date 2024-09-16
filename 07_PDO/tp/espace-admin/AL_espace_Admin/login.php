<?php
  session_start();
  

  $title = 'Connexion';
  include 'inc/head.php';

  if(isset($_SESSION['cem']['connected'])){
    //header('Location: admin/dashboard.php');
    exit;
  }

  // RESET
if (isset($_GET['reset'])) {
  unset($_SESSION['cem']['error']);
  session_destroy();
  $page = $_SERVER['PHP_SELF'];
  header('Location: ' . $page);
  exit;
}

?>

  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="w-25">

    <div class="container">
     <a href="?reset" class="btn btn-warning my-5">Reset</a>
    </div>

      <?php if(isset($_SESSION['cem']['error'])) : ?>
        <div class="alert alert-danger">
          <?= $_SESSION['cem']['error'] ?>
        </div>
      <?php endif; ?>

      <div class="card p-4 ">
        <h1 class="py-2">Connexion</h1>


        <form action="processing.php" method="post">
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="pwd" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
      </div>
    </div>
  </div>

<?php include 'inc/foot.php'; ?>