<?php
/*
DÉBUT
\\ Saisir des données et s'arrêter dès que leur somme dépasse
\\ 500. somme = 0
RÉPÉTER
REQUÊTE "Saisir une valeur : ", val
somme = somme + val
JUSQU'À somme > 500
FIN
*/

$somme = 0;

do{
	$num = (int) readline('Saisir un nombre : ');
	$somme = $somme + $num;
	echo "Le total de somme est $somme est >= à 500" .PHP_EOL;
}
while($somme < 500);
echo "L'exercice est fini";
?>