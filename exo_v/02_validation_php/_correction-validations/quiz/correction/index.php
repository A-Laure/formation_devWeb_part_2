<?php 
 // A NE PAS OUBLIER !!!! 
  session_start();

  $title = 'Quiz';
  require 'db/data.php';
  require_once 'lib/_helpers/tools.php';
  require_once 'lib/utils/functions.php';
  include 'inc/head.php';

  $totalQuestions = count($questions);

  // NEW GAME (RESET)
  if(isset($_GET['newGame'])){
    unset($_SESSION['quiz']);
    $page = $_SERVER['PHP_SELF'];
    header('Location:' . $page);
    exit;
  }

  // INITIALISATION
  if(!isset($_SESSION['quiz'])){
    $_SESSION['quiz']['currentQuestion'] = 0; 
    $_SESSION['quiz']['score'] = 0;
    $_SESSION['quiz']['start'] = false;
    $_SESSION['quiz']['status'] = true;
    
  }

 
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['start'])){
      $_SESSION['quiz']['start'] = true;
      // $_SESSION['quiz']['start'] = $_POST['start'];
    }

    // ERROR POST EMPTY
    if(empty($_POST)){
      $_SESSION['quiz']['error'] = 'Veuillez sélectionner une réponse !';
    }

    // ANSWER 
    if(isset($_POST['answer']) && !empty($_POST['answer'])){
      // $_SESSION['quiz']['status'] === true pour pouvoir incrémenter le score 
      if($_POST['answer'] === $questions[$_SESSION['quiz']['currentQuestion']]['answer'] && $_SESSION['quiz']['status'] === true ){
        $_SESSION['quiz']['score']++;
        // $_SESSION['quiz']['status'] est a false pour éviter d'incrémenter le score si le user rafraichit la page des réponse (cela lui rajouterait un point supplémentaire si on le faisait pas)
        $_SESSION['quiz']['status'] = false;
      }
      unset($_SESSION['quiz']['error']);
    }

    // NEXT QUESTION
    if(isset($_POST['next'])){
      nextQuestion($totalQuestions, $_SESSION['quiz']['currentQuestion']);
      $_SESSION['quiz']['status'] = true;
    }

  }



?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

  <div class="w-50">
    <h1 class="display-1">Quiz</h1>
    <a href="?newGame" class="btn btn-primary mt-4">Nouvelle partie</a>

    <!-- AFFICHAGE MESSAGE ERREUR -->
    <?php if(isset($_SESSION['quiz']['error']) && !empty($_SESSION['quiz']['error'])) : ?>
      <div class="alert alert-warning">
        <?= $_SESSION['quiz']['error'] ?>
      </div>
    <?php endif; ?>

    <!-- SI DEBUT AFFICHER BLOC DEBUT -->
    <?php if( $_SESSION['quiz']['start'] === false && $_SESSION['quiz']['currentQuestion'] === 0 ) : ?>
      <!-- DEBUT PARTIE -->
      <div class="card my-5">
        <div class="card-body">
          <h5 class="card-title">Petit Quiz PHP</h5>
          <p class="card-text">Vous allez avoir 5 questions</p>
          <form action="" method="POST">
            <input type="hidden" name="start" value="true">
            <button type="submit" class="btn btn-primary mt-4" >Commencer le quiz</button>
          </form>
        </div>
      </div>

    <!-- SINON AFFICHER BLOC QUESTION OU REPONSE OU SCORE -->
    <?php else : ?>
      <!-- QUESTION -->

      <?php if($_SESSION['quiz']['start'] === true && $_SESSION['quiz']['currentQuestion'] < $totalQuestions) : ?>
        <?php $currentQuestion = $questions[$_SESSION['quiz']['currentQuestion']]; ?>
        <div class="card my-5">
          <div class="card-body">
            <h5 class="card-title">Question n°<?= $_SESSION['quiz']['currentQuestion'] + 1  ?></h5>
            <p class="card-text"><?= $currentQuestion['question'] ?></p>
            <form action="" method="POST">

              <?php foreach($currentQuestion['options'] as $key => $answer ) : ?>

                <?php if(isset($_POST['answer'])) : ?>
                <!-- MODE REPONSE-->
                  <div class="my-2">
                    <span class="p-1 
                    <?= $answer === $currentQuestion['answer'] ? 'alert alert-success' : ($_POST['answer'] === $answer && $answer !== $currentQuestion['answer'] ? 'alert alert-danger' : '' )  ?>"><?= $answer ?></span>
                  </div>

                <?php else : ?>
                  <!-- MODE QUESTION-->
                    <div class="form-check">
                      <input type="radio" id="inlineRadio<?= $key ?>" class="form-check-input" name="answer" value="<?= $answer ?>">
                      <label for="inlineRadio<?= $key ?>" class="form-check-label"><?= $answer ?></label>
                    </div>

                <?php endif; ?>
              <?php endforeach; ?>
            

              <?php if(isset($_POST['answer'])) : ?>
                <!-- BTN SUIVANT -->
                <input type="hidden" name="next" value="true">
                <div class="mb-3">
                  <button type="submit" class="btn btn-primary mt-4"><?= $_SESSION['quiz']['currentQuestion'] < $totalQuestions-1 ? 'Question suivante': 'Voir mon score'?></button>
                </div>

              <?php else : ?>
                <!-- BTN VALIDER -->
                <div class="mb-3">
                  <button type="submit" class="btn btn-primary mt-4" >Valider la réponse</button>
                </div>
              <?php endif; ?>

            </form>
          </div>
        </div>
      
      <?php else : ?>           
       <!-- FIN PARTIE SCORE -->
        <div class="card my-5">
          <div class="card-body">
            <h5 class="card-title">Score</h5>
            <p class="card-text">Votre score est de <?= $_SESSION['quiz']['score'] ?>/<?= $totalQuestions ?></p>
            <a href="?newGame" class="btn btn-primary mt-4">Nouvelle partie</a>
          </div>
        </div>  

      <?php endif; ?>
    <?php endif; ?>

  <?php 
    debug($_SESSION); 
    debug($_POST); 
  ?>
  </div>

</div>

<?php include 'inc/foot.php'; ?>