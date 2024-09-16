<?php
/*
Écrivez une fonction qui prend la masse (en kilogrammes) et la taille (en mètres) d'une
personne en paramètres et renvoie son indice de masse corporelle IMC
*/

declare(strict_types=1); // pour activer le typage

function imc(float $weight, float $height) : float {

	return round(($weight / ($height ** 2)), 2);
}

$weight = (float) readline("Entrez votre poids en kg : ");
$height = (float) readline("Entrez votre taille en mètre ex : 1.72 : ");

echo "Votre IMC est de :" . imc( $weight, $height);

?>




