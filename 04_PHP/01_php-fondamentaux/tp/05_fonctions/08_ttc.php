<?php

/*Écrivez une fonction qui prend un montant hors taxe et un taux de TVA en paramètres, puis
renvoie le montant total avec la TVA incluse
*/

declare(strict_types=1); // pour activer le typage

function ttc(float $ht, float $tva) : float {

	return $ht * (1+($tva/100));

}

// sont différents des arguments même si même nom, par convention on met le même
$toto = (float) readline("Entrez un montant HT : ") ; 
$tata = (float) readline("Taux de tva : "); 

echo "Le montant TTC est de : " . ttc($toto, $tata) . "TTC";
