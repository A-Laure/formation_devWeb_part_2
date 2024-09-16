<?php

/*
Écrire un programme qui affiche la table de multiplication pour un nombre donné.
1. Demandez à l'utilisateur d'entrer un nombre.
2. Affichez la table de multiplication pour ce nombre jusqu'à 10
*/

$num = (int) readline("Veuillez saisir un nombre : "); 



for ($i = 0; $i<=10; $i++)
{
  $sum = $num * $i;
 echo "$i * $num = $sum". PHP_EOL;
}


?>