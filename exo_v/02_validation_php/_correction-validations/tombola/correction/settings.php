<?php 

  // Parametre de jeux 
  if(!defined('INITIALJACKPOT')){
    define('INITIALJACKPOT', 500); // On définit le montant par défault de la cagnotte
  }

  if(!defined('PRICETICKET')){
    define('PRICETICKET', 2); // On définit le prix de chaque ticket
  }

  if(!defined('MAXTICKETS')){
    define('MAXTICKETS', 100); // On définit le nombre maximum de tickets par tirage
  }

  if(!defined('GAINS')){
    define('GAINS', [100, 50, 20]); // On définit les prix du tirage au sort
  }

