<?php

/*
DÉBUT
\\ En fonction d'un nombre d'itérations saisi, faire la somme
\\ des entiers saisis et afficher le résultat de l'opération.
cumul = 0
REQUÊTE "Veuillez indiquer le nombre de valeurs à saisir :", iteration
POUR cpt = 1 JUSQU'À iteration INCRÉMENT 1 FAIRE
REQUÊTE "Saisir une valeur : ", val
cumul = cumul + val
FINPOUR
ÉCRIRE "Le total des", iteration, "valeurs saisies est :", cumul
FIN */

$cumul = 0;


$iteration = (int) readline("Veuillez indiquer le nombre de valeurs à saisir : ");
echo "Le nombre de chiffres à donner est de $iteration : " . PHP_EOL;

for($count = 1; $count <= $iteration; $count++)
{
	
	$num = (int) readline("Saisir une valeur : ");
	$cumul = $cumul + $num;
	echo "Le cumul est de $cumul et vous avez donné $count nombre(s)." . PHP_EOL;
};
echo "L'exercice est fini.";


?>