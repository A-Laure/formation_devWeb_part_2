<?php

/*
Exercice1
Reproduire l'algorithme avec la boucle TANTQUE...FAIRE.

DÉBUT
\\ L'expression logique d'arrêt sera la saisie de la valeur
\\ "-1".
cumul = 0
iteration = 0
REQUÊTE "Saisissez une valeur (-1 termine la saisie) : ", val
TANTQUE val != -1 FAIRE
iteration = iteration + 1
cumul = cumul + val
REQUÊTE "Saisissez une valeur (-1 termine la saisie) : ", val
FIN TANT QUE
ÉCRIRE "Le total des", iteration, "valeurs saisies est :", cumul
fin
*/

$cumul = 0;
$i = 0;



while($val != -1) {
	$val = (int) readline ("Saisissez une valeur (-1 termine la saisie) : ") ;
	echo "\n";
	$i++;
	$cumul = $cumul + $val;
	echo "Le cumul de vos saisies est $cumul".PHP_EOL;
};

?>