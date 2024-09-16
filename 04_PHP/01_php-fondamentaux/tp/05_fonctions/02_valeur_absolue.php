<?php

/*
Créez une fonction qui prend un nombre en tant que paramètre et calcule puis renvoie la valeur absolue d’un nombre
*/

// ---------  MOI --------- //

function absoluteValue($num){
	
	if($num > 0){
		return $num;
	}else{
		return -$num;
	}
}

// --------- DAMIEN --------- //

$num = (int) readline("Entrer nombre : ") . PHP_EOL;
echo "La valeur absolue de $num est : " . absoluteValue($num);

function absoluteValue2($num){
	return $num <0 ? -$num : $num;
}

$num = (int) readline("Entrer nombre : ") . PHP_EOL;
echo "La valeur absolue de $num est : " . absoluteValue2($num);

// ------------ AUTRE -------------
echo abs(-17);  // abs en natif