<?php
session_start();

$title='Score';

include '../inc/head.php';
include '../lib_vendor/_helpers_debug/tools.php';
include '../lib_vendor/utils_functions/functions.php';

// RESET
if (isset($_GET['newGame'])) {
  unset($_SESSION['quiz']);
  $page = $_SERVER['PHP_SELF'];
  header('Location: quiz.php');
  exit;
}
?>



<div class="container mt-5">

<div class="card text-bg-light mb-3 " style="max-width: 18rem;">
  <div class="card-header fw-bold">Quiz PHP</div>
  <div class="card-body">
    <h5 class="card-title">Score</h5>
    <p class="card-text"><?= "Votre score est :  " . $_SESSION['quiz']['score'] . "/" . $_SESSION['quiz']['countQuestion'] . "  " . "questions" ?></p>
    <a href="?newGame" class="btn btn-primary my-2">Nouvelle Partie</a>
  </div>
  
</div>




</div>

<?php include '../inc/foot.php'; ?>