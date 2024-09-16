<?php
session_start();

$title = 'Quiz';

# Relance l'histoire (reset)
if (isset($_GET['reset'])) {
  unset($_SESSION['quiz']);
  $page = $_SERVER['PHP_SELF'];
  header('Location:' . $page);
  exit;
}

include '../inc/head.php';
require '../data/data.php';
include '../lib_vendor/_helpers_debug/tools.php';
include '../lib_vendor/utils_functions/functions.php';

// INITIALISATION DES VARIABLES



$countQuestions = count($questions);
$currentQuestion = 0;
$result = '';

// RESET
if (isset($_GET['reset'])) {
  unset($_SESSION['quiz']);
  $page = $_SERVER['PHP_SELF'];
  header('Location: ' . $page);
  exit;
}

// ON INITIALISE LA SESSION

if (!isset($_SESSION['quiz'])) {
  $_SESSION['quiz'] = [
    'countQuestion' => $countQuestions,
    'currentQuestion' => 0,
    'score' => 0,
    'error' => '',
    'answered' => false,

  ];
}


// On vérifie si POST existe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  debug($_POST);

  if (isset($_POST['userAnswer'])) {
    $currentQuestion = $_SESSION['quiz']['currentQuestion'];
    if ($_POST['userAnswer'] == $questions[$currentQuestion]['answer']) {
      $_SESSION['quiz']['score']++;
      // $result = 'Bonne reponse';
      $result = compareAnswer($questions[$currentQuestion]['answer'], intval($_POST['userAnswer']));
    } else {
      // $result = 'Mauvaise réponse';
      $result = compareAnswer($questions[$currentQuestion]['answer'], intval($_POST['userAnswer']));
    }

    // On verifie si POST du bouton suivant est à true(appui sur bouton suivant) or false(default)
    $_SESSION['quiz']['answered'] = true;
    unset($_SESSION['quiz']['error']);
  } elseif (isset($_POST['suivant'])) { // si existe
    $_SESSION['quiz']['currentQuestion']++;
    $_SESSION['quiz']['answered'] = false;
  } else { // sinon
    $_SESSION['quiz']['error'] = 'N\'oubliez pas de sélectionner une réponse';
  }
}



$currentQuestion = $_SESSION['quiz']['currentQuestion'];
$answered = $_SESSION['quiz']['answered'];





?>


<div class="container">
  <a href="?reset" class="btn btn-warning my-5">Reset</a>
</div>



<div class="container card" style="width: 10rem, p-5">

  <?php if ($currentQuestion < count($questions)) : ?>

    <h1>Question . <?= $_SESSION['quiz']['currentQuestion'] + 1 ?></h1>

    <p><?= $questions[$_SESSION['quiz']['currentQuestion']]['question'] ?></p>


    <?php if (isset($_POST['userAnswer'])) : ?>

      <div class="<?= $result === "Bonne reponse" ? "alert alert-success" : "alert alert-danger" ?>">
        <?= $result ?>
      </div>
    <?php endif; ?>

    <form action='' method='post' class='form check  '>

      <?php foreach ($questions[$currentQuestion]['options'] as  $key => $answer) : ?>


        <div class="">
          <input class="form-check-input " type="radio" name="userAnswer" id="userAnswer" value="<?= $key + 1 ?>">
          <label class="form-check-label" for=" userAnswer"><?= $answer ?>
          </label>
        </div>

      <?php endforeach; ?>
      <?php if ($answered != true) : ?>
        <button type="submit" class="btn btn-primary mt-3 mb-3">Valider la réponse</button>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($answered && $currentQuestion < $countQuestions - 1) : ?>
      <button type="submit" name="suivant" class="btn btn-secondary mt-3 mb-3">Question Suivante</button>
    <?php endif; ?>
    </form>


    </form>


    <!-- PAGE DE SCORE -->

    <?php if ($currentQuestion == count($questions) - 1) : ?>

      <!-- <?php header('Location: score.php') ?> -->

    <?php endif; ?>

    <!-- </div> -->


</div>

<?php debug($_POST); ?>
<?php debug($_SESSION['quiz']); ?>

<?php include '../inc/foot.php'; ?>