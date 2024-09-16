<?php

/* 
  Écrire un programme qui fait deviner à l'utilisateur un nombre généré aléatoirement entre 1 et
    100.
    Le programme doit :
    1. Générer un nombre aléatoire entre 1 et 100 (fonction rand() regarder dans la doc).
    2. Demander à l'utilisateur de deviner le nombre.
    3. Indiquer si la supposition de l'utilisateur est trop haute, trop basse ou correcte.
    4. Répéter le processus jusqu'à ce que l'utilisateur devine correctement le nombre.
    5. Compter et afficher le nombre de tentatives nécessaires pour deviner correctement le
    nombre.
    6. Bonus) Limiter le nombre de tentatives de l'utilisateur à 10. Si l'utilisateur ne devine pas
    correctement le nombre dans les 10 tentatives, afficher un message de défaite.

*/


$title = 'Deviner le nombre';

include 'inc/head.php';
include 'functions/_helpers/tools.php';
// include 'inc/navbar.php';

$guessNumber = 76;

// isset() - Détermine si une variable est déclarée et est différente de null

if(isset($_GET['number'])){

  $userInput = (int) $_GET['number'];
  if($userInput > $guessNumber){

    echo '<div class="alert alert-danger" role="alert">
            Essayes plus petit
          </div>';


  }elseif($userInput < $guessNumber){
    echo '<div class="alert alert-danger" role="alert">
            Essayes plus grand
          </div>';
  }else {
    echo '<div class="alert alert-success" role="alert">
            Bravo!
          </div>';
  }
}

?>
 

<div class="container pt-5 w-50">

    <h1 class="display-1  my-5">Deviner le nombre! (<?= $guessNumber ?>)</h1>

    <form class="row g-3" method="get">
      <div class="col-auto">
        <label for="number" class="visually-hidden">Nombre</label>
        <input type="number" class="form-control" id="number" name="number" placeholder="<?= isset($_GET['number']) ? $_GET['number'] : 'Saisir un nombre'  ?>" >
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Deviner</button>
      </div>
    </form>

    <hr>
    <?php debug($_GET); ?>

</div>

