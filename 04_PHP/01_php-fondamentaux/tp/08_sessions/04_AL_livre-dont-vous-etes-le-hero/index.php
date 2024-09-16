<?php

session_start();
$title = "Index";


##### ENONCE ####
/*
Le livre dont vous êtes le héro
Le livre dont vous êtes le héro est un concept bien connu dans lequel il existe plusieurs points
d'arrêt où un choix vous est proposé. Ce choix influence la suite de votre parcours dans
l'histoire.
Dans cet exercice, le fichier story.php contenant les différents morceaux de l'histoire vous est
mis à disposition.
Il vous est demandé :
● de créer une fonction pour afficher le chapitre n
● mettre en place un formulaire proposant les choix possibles à chaque décision à
prendre
● faire en sorte d'ajouter une persistance des données pour ne pas perdre le cours de
l'histoire
*/
##### FIN ENONCE ####




include './inc/head.php';
// include './inc/navbar.php';
include './functions/_helpers/tools.php';
include './functions/functions.php';
include './datas/story.php';

# Si dans l'url j'ai ?newlist alors on efface la session $_SESSION['list'] et on redirige vers la page en cours(ce qui va évité d'avoir tout le temps ?newlist dasn l'url)
if (isset($_GET['newStory'])) { // bouton remise à zéro
  unset($_SESSION['storychoice']);
  session_destroy();
  // $_SERVER['PHP_SELF'] récupère le nom de la page en cours (pratique pour au cas ou le nom du fichier change plus tard)
  $page = $_SERVER['PHP_SELF'];
  header('Location: ' . $page);
  exit();
}


// VERIFICATION AVANT DE METTRE DANS LA SESSION DU MAIL ET PWD
if (!isset($_POST['choice'])) {
  $i = 0;
} elseif (isset($_POST['choice']))  {
    $i = intval($_POST['choice']);
    // echo "New index" . $i;
    // var_dump($i);
    // displayText($story, $i);
  }








?>

<!-- Bouton pour réinitialisé la liste -->
<a href="?newStory" class="btn btn-primary my-5">Nouvelle Histoire</a>

<pre>
<?php
if (!isset($_SESSION['storyChoice'])) {
  echo "Liste vide";
} else {
  var_dump($_SESSION['storyChoice']);
}
?>
</pre>

<div class='container'>

  <p> <?= displayText($story, $i) ?> </p>


  <form action='' method="post">
    <div class="mb-5 ">
      <?php
      foreach ($story[$i]['choice'] as $value) : ?>
        <div class="form-check">
          <label class="form-check-label" for="choice"><?= $value['text'] ?></label>
          <input class="form-check-input" type="radio" value=" <?= $value['goto'] ?>" name='choice' id="choice">
        </div>
      <?php endforeach; ?>
      <button type="submit" class="btn btn-primary mt-3" >Submit</button>
  </form>

</div>




















<?php include './inc/foot.php'; ?>