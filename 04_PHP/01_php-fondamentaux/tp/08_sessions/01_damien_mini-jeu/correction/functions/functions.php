<?php


  /**
   * generateNumber : Génère un nombre aléatoire compris entre les marges passées en paramètres si ells sont précisée, ou entre 0 et la plus grande valeur aléatoire possible
   * @param int $min [optional] 
   * @param int $max [optional] 
   * @return int  
   */
  function generateNumber(int $min=NULL, int $max=NULL) : int {
    if(is_int($min) && is_int($max)){
      return mt_rand($min, $max);
    }
    return mt_rand();
  }


  /**
   * compareNumber : Compare deux nombres passées en paramètre et nous retourne le rapport entre eux : plus petit, plus grand, égalité.
   * @param int $userInput 
   * @param int $randNumber
   * @return string  
   */
  function compareNumber(int $userInput, int $randNumber) : string{
    if($userInput < $randNumber){
      return 'Trop petit';
    }elseif($userInput > $randNumber){
      return 'Trop grand';
    } else {
      return 'Bravo vous avez trouvé !';
    }
  }