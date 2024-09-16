/*
1. Créez une fonction addition qui prend deux nombres en paramètres et renvoie leur somme.
2. Créez une fonction soustraction qui prend deux nombres en paramètres et renvoie leur
différence.
3. Créez une fonction multiplication qui prend deux nombres en paramètres et renvoie leur
produit.
4. Créez une fonction division qui prend deux nombres en paramètres et renvoie leur quotient
*/

<?php

# addition

echo"ADDITION" . PHP_EOL;
echo"" . PHP_EOL;

function addition($num1, $num2){

 return  $num1 + $num2;
}

$num1=(int) readline("Entrez un 1er chiffre : ") ;
$num2=(int) readline("Entrez un 2ème chiffre : ") ;

$sum = addition($num1,$num2);
echo "L'addition de $num1 + $num2 est : $sum". PHP_EOL;
echo"" . PHP_EOL;


# soustraction

echo"SOUSTRACTION" . PHP_EOL;
echo"" . PHP_EOL;

function soustraction($sous1, $sous2){

 return  $sous1 - $sous2;
}



$sous1=(int) readline("Entrez un 1er chiffre : ") ;
$sous2=(int) readline("Entrez un 2ème chiffre : ") ;

$sous = soustraction($sous1,$sous2);
echo "La soustraction de $sous1 - $sous2 est : $sous". PHP_EOL;
echo"" . PHP_EOL;




# multiplication

echo"MULTIPLICATION" . PHP_EOL;
echo"" . PHP_EOL;

function multiplication($multipli1, $multipli2){

 return  $multipli1 * $multipli2;
}

$multipli1=(int) readline("Entrez un 1er chiffre : ") ;
$multipli2=(int) readline("Entrez un 2ème chiffre : ") ;

$multipli = multiplication($multipli1,$multipli2);
echo "La multiplication de $multipli1 * $multipli2 est : $multipli". PHP_EOL;
echo"" . PHP_EOL;





# division

echo"DIVISION" . PHP_EOL;
echo"" . PHP_EOL;

function division($division1, $division2){

	if($division2 !=0){ 
	return $division1 / $division2; // else pas obligatoire
}
	return"ERROR"; // =le else

	// return $division2 != 0 ? ($division1/$division2) : "ERROR";

}

$division1=(int) readline("Entrez un 1er chiffre : ") ;
$division2=(int) readline("Entrez un 2ème chiffre : ") ;

$division = division($division1,$division2);
echo "La division de $division1 / $division2 est : $division". PHP_EOL;
echo"" . PHP_EOL;

?>