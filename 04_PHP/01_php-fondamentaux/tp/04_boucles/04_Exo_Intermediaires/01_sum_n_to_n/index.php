<?php

/*
Écrire un programme qui calcule la somme des nombres de 1 à N.
1. Demandez à l'utilisateur d'entrer un nombre N.
2. Calculez la somme des nombres de 1 à N.
3. Affichez le résultat
*/

$sum = 0;
$num = (int) readline("Veuillez saisir un nombre : ") . PHP_EOL ; 



if($num == 0)
{
  echo "stop" . PHP_EOL;
}
else
{
  $sum = $num;
  $num--;
  $sum += $num; 

  echo "La somme de 1 à N est: $sum" . PHP_EOL ; 
}


?>