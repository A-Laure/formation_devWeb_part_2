<?php 



function compareAnswer($reponse, $userAnswer) {
  if(isset($reponse) && $reponse == $userAnswer){
    return 'Bonne reponse';
    exit;} elseif (isset($reponse) && $reponse != $userAnswer) {
      return 'Mauvaise reponse';
    }  else{
      return '';
    }

  }






  
