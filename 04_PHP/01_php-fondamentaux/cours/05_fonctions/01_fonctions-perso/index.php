<?php

/* 
- Permet d'automatiser, on les appelera au besoin
- réutilisable et autonome
- permet de mieux organiser notre code
- peut être utilisée seulement une fois mais "we never know" for more
- Peuvent faire plusieurs choses et/ou nous retourner une ou des (ex: tableau) valeurs traitées:
	
	- 1/ déclarer une fonction / on va tt mettre en camelcase sauf nom des classes en pascalcase (maj aux 2 mots) / commence par une lettre ou un '_', jamais un chiffre

-> fonction sans valeur de retour, juste affichage (par défaut retourne une valeur null)

	function nomFonction(){
	echo 'instruction1';
	echo 'instruction2';
}

	- 2/ on appelle la fonction

	 nomFonction();
-> fonction avec valeur de retour

function square($number){ // dans la parenthèse on lui passe des PARAMETRES, permet de transmettre des éléments extérieurs au bloc, des variables déclarées alleurs
	return $number * $number;
}

- > appel avec transmission d'ARGUMENT :

echo square(2).PHP_EOL;

OU

$value=16;
echo square($value).PHP_EOL;

--- Il est possible de trouver des variables de même nom mais "différentes" car une dans un bloc et l'autre dans un autre mais ont "un lien"

diff entre echo et return :

	- echo affiche tout de suite
	- return permet de stocker et de m'en servir plus tard

*/

#-> fonction sans valeur de retour, juste affichage (par défaut retourne une valeur null car pas de valeur de retour)

function nomFonction(){
	echo 'instruction1' . PHP_EOL;
	echo 'instruction2' . PHP_EOL;
}

$result = nomFonction();
var_dump($result);

#-> fonction avec valeur de retour
echo"" . PHP_EOL;
echo "FONCTION AVEC VALEUR DE RETOUR".PHP_EOL;
echo"" . PHP_EOL;

function nomFonction2(){
	echo 'instruction1' . PHP_EOL;
	echo 'instruction2' . PHP_EOL;

	// global $value;  pour accéder la variable NE PAS UTILISER COMME CA, JUSTE POUR INFO
	// $value = 18;

	return 18;
}

$result2 = nomFonction2(). PHP_EOL;
var_dump($result2). PHP_EOL;
echo $result2. PHP_EOL;

echo "FONCTION AVEC PARAMETRES ".PHP_EOL;
echo"" . PHP_EOL;


function square($number){ // dans la parenthèse on lui passe des ARGUMENTS = paramètres, permet de transmettre des éléments extérieurs au bloc, des variables déclarées alleurs
	return $number * $number;
}

// appel avec transmission d'argument
echo square(2).PHP_EOL;
$value=16;
echo square($value).PHP_EOL;


function addition($number1,$number2){

return $number1 + $number2;
}

echo"" . PHP_EOL;
echo "Fonction addition : " . addition(4,5).PHP_EOL;
echo"" . PHP_EOL;



function display($number3,$string){ // on peut déclarer dans la () => function display($number3 = 4,$string) mais au moment de l'appel on peut changer $number3 par display(4, 'tom')

 echo 'Display:  ' . $number3. PHP_EOL;
 echo 'Display:  ' . $string. PHP_EOL;
}

echo"" . PHP_EOL;
echo "Fonction display sans return : " . display(4,'Tom').PHP_EOL;
echo"" . PHP_EOL;





function sayHello($firstName, $lastName){
	echo "Bonjour " . $firstName . ' ' . $lastName . PHP_EOL;
}



sayHello('tom', 'cruise') . PHP_EOL;
// sayHello($firstName, $lastName);
// sayHello($user['firstName'], $user['lastName'] ) . PHP_EOL;



$user = [
	'firstName' => 'John',
	'lastName' =>'Doe',
];

echo"" . PHP_EOL;
echo "HYDRATATION OU AUTO-ASSIGNATION" . PHP_EOL;

foreach($user as $key => $value){ 

	$$key = $value; // = hydratation ou auto-assignation
	// 1er tour  $key = 'firstName'
	// 2ème tour : $value
}


// PARAMETRE NOMME : il a conscience du nom du paramètre
// n'existe que depuis la version 8 et plus gourmand en ressource

sayHello(lastName: $lastName, firstName : $firstName);

echo"" . PHP_EOL;
echo "DIFFERENCE ECHO ET RETURN".PHP_EOL;
// return permet d'accéder à tt moment à la donnée car stockée alors que echo est ponctuel et non stocké
echo"" . PHP_EOL;

$firstName = $user['firstName'];

function familyName($firstName, $lastName){
	// echo "$firstName $lastName" . PHP_EOL;
	return "$firstName $lastName" . PHP_EOL;

}

$familyName = familyName($firstName, $lastName);
echo "Nom complet : " . $familyName . PHP_EOL;



//--------------------//
echo"" . PHP_EOL;
echo"Autre exemple" . PHP_EOL;
echo"" . PHP_EOL;

function average($grades){

	return array_sum($grades) / count($grades);

}

$grades = [16, 12, 14];
$average = average($grades);

echo "Vous avez : $average de moyenne" . PHP_EOL;
echo"" . PHP_EOL;


echo"Spread OPERATOR le ... : pur une chekbox par ex car on ne sait pas combien de cases il coche"; 
echo"" . PHP_EOL;

function average2(...$grade){ 	// pour compter, le spread operator = ... qd on ne connaît pas en avance le nombre d'élément saisi

	return array_sum($grade) / count($grade);



}

	$grade1 = (int) readline('Saissez une note 1 :');
	$grade2 = (int) readline('Saissez une note 2 :');
	$grade3 = (int) readline('Saissez une note 3 :');

	echo "grade 1 : $grade1, grade 2 : $grade2, grade 3 : $grade3". PHP_EOL;


$average2 = average2($grade1, $grade2, $grade3);
echo "Vous avez : $average2 de moyenne" . PHP_EOL;
echo"" . PHP_EOL;







// FONCTIONS POUR FOREACH SIMPLE OU AVEC CLE


echo "FONCTIONS POUR FOREACH SIMPLE OU AVEC CLE ".PHP_EOL;
echo"" . PHP_EOL;

function foreachSimple($array){

foreach ($array as $item){ // remplacer item par un nom générique comme dessous
	echo $item.PHP_EOL;
}

}

function foreachComplexe($array){

foreach ($array as $key => $value){
	echo $key . ':' . $value .PHP_EOL;
}
}


$tab = ['pomme', 'kiwi', 'graise'];
$numbers = [16, 18, 96];
$users = [
	'name' => 'Paul',
	'sexe' => 'indéfini',
];

foreachSimple($tab).PHP_EOL;
foreachSimple($numbers).PHP_EOL; // dans la parenthèse = PARAMETRE
foreachComplexe($users).PHP_EOL;

?>