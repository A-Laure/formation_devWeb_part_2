<?php

# BOUCLES / LOOP

//Les boucles sont des structures qui permettent d'exécuter plusiers fois une même série d'instruction en fonction d'une ou plusieurs conditions


# WHILE (TANT QUE) 
//éxecute des instructions tant que la condition n'est pas remplie/vérifiée
// pour répéter une ou +++ instructions jusqu'à un évènement ou une condition précise (ex: saisie de notes, on répète jusqu'à la saisie de -1)

// Pattern :

// while(condition)
// {
// 	instruction;
// };

echo "DEMONSTRATION WHILE\n";
echo "\n";

$num = 0; // meilleure pratique
// $num = (int) readline('Saisir un nombre : '); => moins bonne pratique

while($num !=10)
{
	$num = (int) readline('Saisir un nombre : ');
}

echo "Bravo, vous avez trouver le nombre 10";
echo "\n";


// AUTRE SOLUTION

$num2 = 0; 
$num2 = (int) readline('Saisir un nombre : ');

while($num2 !=10)
{
	$num2 = (int) readline('Essaye encore : ');
}

echo "Bravo2, vous avez trouver le nombre 10";
echo "\n";

// AUTRE EXEMPLE DE WHILE

echo"Autre ex de WHILE" . PHP_EOL;
echo "\n";

$counter = 1;
$num2 = (int) readline('Saisir un nombre : ');

while($num2 !=10)
{
	$num2 = (int) readline('Essaye encore : ');
	$counter++;
}

echo"Vous avez trouvé $counter d'essais!";
echo "\n";

# DO WHILE (FAIT TANT QUE)
// pareil que while sf que l'on fait un 1er tour de boucle quoiqu'il arrive (on éxecute les instructions une première fois sans vérifier la condtion)

// Pattern :

// do 
// {
// 	instruction;
// }
// while(condition);

echo "DEMONSTRATION DO WHILE\n";
echo "\n";
$i = 1;

do
{	
	echo $i . PHP_EOL;
	//$i = $i + 1;
	//$i =+ 1;
	 $i++;
}
while ($i <= 6);

echo "\n";



# FOR (POUR)
// idéal si on connait le nombre d'itération à effectuer
// qd vous voulez faire une boucle sur un tableau ou autre et que l'on connaît le nombre d'itération à l'avance (exemple pagination, on boucle pour générer chaque page)


echo "DEMONSTRATION FOR\n";
echo "\n";

// Pattern :

// for(expression1; condition; expression2){
// 	instructions;
// };

// => expression1, correspond à l'initialisation de la variable d'itération, sera éxecutée une seule fois au début de la boucle
// => condition, sera testée à chaque passage de la boucle (y compris la 1ère fois) tant que la condition ne sera pas vérifiée
// => expression2, sera éxécutée à la fin d'un tour de boucle (en général incrémentation ou décrémentation)

for($i=0; $i<=5; $i++){
	echo $i;
	echo "\n";
}

$fruits = ['Pomme', 'Fraise', 'Banane'];
$fruits[0];

for($i=0; $i < count ($fruits); $i++){
	echo $fruits[$i].PHP_EOL;
}


# FOREACH (POUR CHAQUE)
// permet de parcourir facilement les éléments d'un tableau
// La valeur de chaque élément sera successivement copiée dans une variable

// Pattern 1 / syntaxe simple
// fait "un count" automatique du tableau
// $tableau = tableau que l'on va parcourir
// $valeur, variable qui va stocker temporairement à chaque tour la valeur de l'élément parcouru

// foreach($tableau as $valeur){ 
// instruction
// };

echo "DEMONSTRATION FOREACH LISTE\n";
echo "\n";

$fruits = ['Pomme', 'Fraise', 'Banane', 'kiwi'];

foreach($fruits as $fruit){
echo $fruit . PHP_EOL;
};


// Pattern 2 / syntaxe complexe (avec la clé)
// foreach ($tableau as $cle => $valeur)
// la variable clé contiendra l'index/clé de chaque élément/valeur
// l'index sera numérque pour les tableaux indéxés (LIST) et la clé pour les tableaux associatifs (MAP)


// AUTRE EXEMPLE

echo "DEMONSTRATION FOREACH MAP\n";
echo "\n";

$schoolReport = [[12,13,17],[11,10,19],[7,13,4],[2,14,18] ];

foreach($schoolReport as $trimester => $grades)
{ 
	echo PHP_EOL . "Vos notes du " . $trimester+1 . " ème trimestre : " . PHP_EOL;
	foreach($grades as $grade){
		echo ($grade) . PHP_EOL;
};

};


$user = [
	'firstName' => 'ken',
	'lastName' => 'roche',
	'job' => 'devWeb',
];

foreach($user as $label => $value){
	echo "$label : $value" . PHP_EOL;

};


// Afficher chaque classe avec leur étudiant associé


echo "EXERCICE FOREACH MAP\n";
 
$classes = 
[
	'devWeb' => ['Daris', 'Peter', 'Anare'],
	'devMob' => ['Anne-Laure', 'Ken'],
];


foreach ($classes as $class => $students) {
	// 1er tour, on stocke dans $class = 'devWeb' et dans $students = ['Daris', 'Peter', 'Anare'],'
	echo "La classe $class :\n";  
	//print_r($students);
	

	foreach ($students as $student) {
		// 1er tour de la 1ère boucle
		// 1er tour stocke dans $student = 'Daris'
		// 1er tour stocke dans $student = 'Peter'
		// 1er tour stocke dans $student = 'Anare'

		// 2ème tour de la 1ère boucle
		// 1er tour stocke dans $student = 'Alaure'
		// 1er tour stocke dans $student = 'Ken'
	
		echo " - $student\n";
}
};






?>