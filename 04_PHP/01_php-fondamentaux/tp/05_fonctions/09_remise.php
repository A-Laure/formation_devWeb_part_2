<?php

/*
Écrivez une fonction qui prend un montant total d'achat et un pourcentage de remise, puis renvoie le montant après application de la remise.
*/

declare(strict_types=1); // pour activer le typage

function remise(float $achat, float $remise) : float{
	return $achat*(1-$remise/100);
}


// noms peuvent être différents des arguments, par convention on met le même
$achat = (float) readline("Entrez un montant d'achat : ");
$remise = (float) readline("Taux de remise en % : ");

echo "La montant net est de : " . remise($achat, $remise)  ;

?>