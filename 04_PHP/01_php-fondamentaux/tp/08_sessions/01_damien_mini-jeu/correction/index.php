<?php

session_start();

##### ENONCE ####
    /**
         * 1 - Faire un script qui affiche un nombre aléatoire
         * 2 - Enregistrer ce nombre en session. Une fois qu'il est généré, n'affiche que celui là.
         * 3 - Créer un lien "Nouvelle partie" qui va générer un nouveau nombre.
         * 4 - Ajouter un champs de formulaire pour saisir un nombre.
         *      - A la validation, la page nous indique si le nombre généré aléatoirement est inférieur, supérieur ou égal à notre saisie.
         * 5 - Organiser un comportement de jeu.
         *      - Masquer le nombre aléatoire
         *      - Lorsqu'on a trouvé le nombre, faire une nouvelle partie etc...
         * 6 - Ajouter une gestion des erreurs (saisie non numérique etc...)
         * 7 - Afficher l'historique des coups joués
    */
##### FIN ENONCE ####

  $title = 'Mini Jeu | Session';

  // define('MIN', 1);
  const MIN = 1; 
  const MAX = 100;

  include 'inc/head.php';
  include 'inc/navbar.php';
  include 'functions/_helpers/tools.php';
  include 'functions/functions.php';



  # Si dans l'url j'ai ?newGame alors on efface la session $_SESSION['game'] et on redirige vers la page en cours(ce qui va évité d'avoir tout le temps ?newGame dasn l'url)
  if(isset($_GET['newGame'])){
    unset($_SESSION['game']);
    // $_SERVER['PHP_SELF'] récupère le nom de la page en cours (pratique pour au cas ou le nom du fichier change plus tard)
    $page = $_SERVER['PHP_SELF'];
    header('Location: '. $page);
  }



  # On vérifie si $_SESSION['game']['rand'] n'existe pas alors on la crée en générant le nombre aléatoire
  if(!isset($_SESSION['game']['rand'])){
    // $_SESSION['game']['rand'] = mt_rand(MIN,MAX);
    $_SESSION['game']['rand'] = generateNumber(MIN, MAX);
  }


  if(isset($_POST['userTry'])){

    if(ctype_digit($_POST['userTry'])){
      // On appelle la fonction de comparaison et on stocke le résultat dans $result
      $result = compareNumber(intval($_POST['userTry']), $_SESSION['game']['rand']);

      // On stocke tous les essaies et les messages retournés par la fonction de comparaison
      $_SESSION['game']['historic'][] = [
        'attemp' => $_POST['userTry'],
        'compareMsg' => $result,
      ];
    } else {
      $error = 'Veuillez saisir un entier !';
    }

  }
  

?>

<div class="container my-5">

  <?php if(isset($error)) : ?>
    <div class="alert alert-danger">
      <?= $error ?>
    </div>
  <?php endif; ?>  


    <form class="row g-3" method="POST" action="">
        <!-- Si $error alors on affiche le message d'erreur -->
        <div class="col-auto">
            <input type="number" id="number" name="userTry" class="form-control" aria-labelledby="numberHelp" min="" max="">
            <div id="numberHelp" class="form-text">
            Devinez un nombre compris entre <?= MIN ?> et <?= MAX ?> .
            </div>
        </div>

        <div class="col-auto">
            <!-- teranire pour rendre le bouton désactivé si on a trouvé -->
            <button type="submit" class="btn btn-primary <?= isset($_SESSION['game']['historic']) && $_SESSION['game']['historic'][count($_SESSION['game']['historic'])-1]['compareMsg'] === 'Bravo vous avez trouvé !' ? 'disabled' : '' ?>" >Essayer</button>
        </div>
    </form>

    <!-- si $_SESSION['game']['historic'] existe -->
    <?php if(isset($_SESSION['game']['historic'])) : ?>

      <!-- Bouton pour réinitialisé la partie -->
      <a href="?newGame" class="btn btn-primary my-5">Nouvelle partie</a>


      <!-- On parcours le tableau $_SESSION['game']['historic'] pour pouvoir affiché les tentatives et les messages associés  -->
      <?php foreach($_SESSION['game']['historic'] as $key => $attemp) : ?>

        <!-- ternaire pour choisir la class alert-success ou alert-warning en fonction de si on a trouvé ou pas le nombre  -->
        <div class="alert <?= $attemp['compareMsg'] === 'Bravo vous avez trouvé !' ? 'alert-success' : 'alert-warning' ?>">
           <!-- On affiche les tentatives et messages associés  -->
          Tentative n° <?= $key + 1 ?> : <?= $attemp['attemp'] ?> => <?= $attemp['compareMsg'] ?> <?= $attemp['compareMsg'] === 'Bravo vous avez trouvé !' ? '(en '.count($_SESSION['game']['historic']). ' coups)' : '' ?>
          <!-- exemple d'affichage :  Tentative n°1 : 27 => tro petit! -->
        </div>

      <?php endforeach; ?>   
    <?php endif; ?>   


    <!-- #### DEBUG #### -->
        <?php debug($_SESSION['game']);?>
        <?php debug($result);?>
    <!-- #### FIN DEBUG #### -->


</div>


<?php include 'inc/foot.php'; ?>
