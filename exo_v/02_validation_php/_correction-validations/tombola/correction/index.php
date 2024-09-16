<?php 
  session_start(); 

  $title = 'Tombola';
  require_once 'settings.php'; // On inclut les constantes
  require_once 'lib/_helpers/tools.php'; 
  include 'inc/head.php';

  function ticketsAvailable(array $store, array $bought) : array {
    return array_diff($store, $bought);
  }


  // RESET 
  if(isset($_GET['reset'])){
    if(isset($_SESSION['tombola'])){
      unset($_SESSION['tombola']);
    }
    $page = $_SERVER['PHP_SELF'];
    header('Location:' .$page);
    exit;
  }


  /**
   * 
   * 7 - Déterminer les tickets gagnants
   * 8 - Attribuer le ou les gains
   * 
   */

  if(isset($_GET['tirage'])){

    if(count(ticketsAvailable($_SESSION['tombola']['tickets'], $_SESSION['tombola']['ticketsPlayer'])) < 100){

      $keyWins = array_rand($_SESSION['tombola']['tickets'], 3);
      var_dump($keyWins);
      $winnerTickets = [];
      foreach($keyWins as $winnerNum){

        $winnerTickets[] = $_SESSION['tombola']['tickets'][$winnerNum];

      }

      shuffle($winnerTickets);

      /**
       * 9 - verification des gains
       * 
       */
      $verif = array_intersect($winnerTickets, $_SESSION['tombola']['ticketsPlayer']);

      /**
       * 
       * 10 - Attribution des gains 
       */

      $total = 0;
      foreach($verif as $t){

        $index = array_search($t, $winnerTickets);
        $total += GAINS[$index];
        $_SESSION['tombola']['wallet'] += $total;

      }

      $_SESSION['tombola']['previewsDraw']['ticketsPlayer'] = $_SESSION['tombola']['ticketsPlayer'];
      $_SESSION['tombola']['previewsDraw']['winners'] = $winnerTickets;
      $_SESSION['tombola']['previewsDraw']['verif'] = $verif;
      $_SESSION['tombola']['previewsDraw']['gains'] = $total;

      unset($_SESSION['tombola']['tickets']);
      unset($_SESSION['tombola']['ticketsPlayer']);
      header('Location: index.php');
      exit;      

    } else {

      $error = 'Aucun ticket vendu';

    }

  }



  /**
   *  1 - Générer les tickets
   * 
   */
  if(!isset($_SESSION['tombola']['tickets'])){
    // $tickets = [];
    // for($i = 1; $i <= MAXTICKETS;$i++){
    //   $tickets[] = $i;
    // }
    // la fonction range vous renvoie un tableau avec tous les chiffres entre 1 et MAXTICKETS ( ici 100)
    $tickets = range(1, MAXTICKETS);
    $_SESSION['tombola']['tickets'] = $tickets;
  }

  /**
   *  2 - Porte-monnaie et ma poche
   * 
  */
  if(!isset($_SESSION['tombola']['ticketsPlayer'])){
    $_SESSION['tombola']['ticketsPlayer'] = [];
  }
  
  if(!isset($_SESSION['tombola']['wallet'])){
    $_SESSION['tombola']['wallet'] = INITIALJACKPOT;
  }
  
  /**
   * 3 - Saisir Nombre de ticket a acheter
   * 
   * 
   * 
   */

   if(isset($_POST['nbTicket'])){

    if(ctype_digit($_POST['nbTicket'])){

      if($_POST['nbTicket'] >= 1){
        // On vérifie qu'il reste assez d'argent pour le nombre de ticket demandé
        $nbTicket = $_POST['nbTicket'];
        
        if($_SESSION['tombola']['wallet'] < $nbTicket * PRICETICKET){
          // Sinon on calcule le maximum que l'on peux acheter
          $nbTicket = floor($_SESSION['tombola']['wallet'] / PRICETICKET);
        }

        // on vérifié qu'il reste assez de ticket dispo
        if(count(ticketsAvailable($_SESSION['tombola']['tickets'], $_SESSION['tombola']['ticketsPlayer'])) < $nbTicket){
          // sinon on attribue le maximum restant
          $nbTicket = count(ticketsAvailable($_SESSION['tombola']['tickets'], $_SESSION['tombola']['ticketsPlayer']));
        }

        /**
         * 
         *  4 - Piocher aléatoirement le nombre de ticket
         * 
         */

   
        // (array) permet de redéfinir la sortie de la fonction array_rand()
        $tombolaDraw = (array)array_rand(ticketsAvailable($_SESSION['tombola']['tickets'], $_SESSION['tombola']['ticketsPlayer']), $nbTicket); 
        
        /***
         * 
         * 5 - payer
         * 
         */
        $_SESSION['tombola']['wallet'] -= ($nbTicket * PRICETICKET);

        /***
         * 
         * 6 - récuperer les tickets
         * 
         */
        foreach($tombolaDraw as $keyTicket){

          $ticketsAvailable =  ticketsAvailable($_SESSION['tombola']['tickets'], $_SESSION['tombola']['ticketsPlayer']);
       
          // var_dump($ticketsAvailable[$keyTicket]);
          $_SESSION['tombola']['ticketsPlayer'][] =  ticketsAvailable($_SESSION['tombola']['tickets'], $_SESSION['tombola']['ticketsPlayer'])[$keyTicket];

        }

      }else {
        $error = 'Vous devez saisir un nombre superieur a 0';
      }

    }else {
      $error = 'Vous devez saisir un nombre entier positif';
     }

   } 
?>


  <div class="container">

    <p class="my-5">Mon portfeuille actuel : <?= $_SESSION['tombola']['wallet'] ?></p>

    <?php if(isset($error)) : ?>

      <div class="alert alert-danger"><?= $error ?></div>

    <?php endif; ?>

    <form action="" method="POST">
      
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <input type="number" class="form-control"  step="1" min="1" max="<?= count(ticketsAvailable($_SESSION['tombola']['tickets'], $_SESSION['tombola']['ticketsPlayer'] )) ?>" name="nbTicket" placeholder="0/<?= count(ticketsAvailable($_SESSION['tombola']['tickets'], $_SESSION['tombola']['ticketsPlayer'] )) ?>"> 
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary">Acheter</button>
        </div>
        
      </div>
    </form>

    <div class="row g-3 align-items-center my-4">
        <div class="col-6">
          <p>Tickets du joueur : </p>
          <p>
            <?php
            if(isset($_SESSION['tombola']['ticketsPlayer'])){
              sort($_SESSION['tombola']['ticketsPlayer']);
              echo implode(', ', $_SESSION['tombola']['ticketsPlayer']);
            }
          
            ?>
          </p>
          


        </div>
        <div class="col-6">
        <p>Dernier tirage : </p>

            <?php
            
            if(isset($_SESSION['tombola']['previewsDraw']['ticketsPlayer'])){
              echo '<p>Vous possédiez : ' . implode(', ', $_SESSION['tombola']['previewsDraw']['ticketsPlayer']). '</p>';
            }
            
            if(isset($_SESSION['tombola']['previewsDraw']['winners'])){
              echo '<p>Résultats du tirage : ' . implode(', ', $_SESSION['tombola']['previewsDraw']['winners']). '</p>';
            }
            
            if(isset($_SESSION['tombola']['previewsDraw']['gains'])){
              echo '<p>Vous avez gagné : ' . $_SESSION['tombola']['previewsDraw']['gains'] . '</p>';
            }
            
            ?>

        </div>
    </div>


    <a href="?tirage" class="btn btn-dark">Lancer le tirage</a>
    <a href="?reset" class="btn btn-warning">Réinitialiser</a>

     
    <?php //debug($nbTicket); ?>
    <?php //debug($_SESSION['tombola']); ?>
    

  </div>

  <?php include 'inc/foot.php' ?>