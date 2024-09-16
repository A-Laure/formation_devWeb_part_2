<?php
include '../inc/head.php';
// require 'data/data.php';
include '../lib_vendor/_helpers_debug/tools.php';
include '../lib_vendor/utils_functions/functions.php';

$title='Ecran démarrage';

// RESET
if (isset($_GET['newGame'])) {
  unset($_SESSION['quiz']);
  $page = $_SERVER['PHP_SELF'];
  header('Location: ' . $page);
  exit;
}
?>

<div class="container my-5 ">
  <!-- <a href="?reset" class="btn btn-warning my-5">Reset</a> -->



  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Quiz</h5>
      <p class="card-text">Petit Quiz PHP</p>
      <a type="button" href="quiz.php" class="btn btn-primary mt-3" >Commencer le quiz</a>
    </div>
  </div>
</div>







<?php include '../inc/foot.php'; ?>