<?php

/* TABLEAU
	- Tableau = liste/collection de valeurs, chaque valeur est accessible par un indice/index (tableau indexé - List en DART), ou par clé (tableau associatif - MAP en DART)
  - ECHO ne marche pas sauf avec appel index
	- on peut avoir des données mixtes
	- on peut mettre des tableaux dans des tableaux = Tableau imbriqué / nested / à plusieurs dimensions
	- chaîne de caractère est considéré comme un tableau

*/

# Tableau indexé => 1 index / 1 valeur

$grades = [14, 12, 11]; // plus moderne, plutôt l'écrire comme ça surtout que ds la plupart des langages, comme ça
$fruits = array('Pomme', 'Banne'); // autre façon de l'écrire mais moins actuel


var_dump($grades); // affiche le typage 
print_r($fruits); // affiche le tableau

// pourquoi index commence à 0 : par rapport aux adresses mémoires qui commençaient à 0

echo "Essai index $grades[0]\n";
echo "Essai index $grades[1]\n";
echo "Essai index $grades[2]\n";

// Tableau données mixtes
$students = ['Paul', 'Peron', 22, true];

// Tableau imbriqué / nested / à plusieurs dimensions
$students = ['Paul', 'Peron', [12, 16, 4]];

echo $students[2][1]; // affiche 16
echo "\n";
echo "$students[0] a eu " . $students[2][1] . " en math.";

echo "\n";

$name = "Najib"; // chaîne de caractère est considéré comme un tableau
echo "$name[2]"; // récupère le j

echo "\n";
//
$student = 
[
	'Paul', // 0
	'Peron', // 1
[					// 2
	 [12, 16, 4], // 0 puis 0  1  2
	 [11, 18, 16], // 1 puis 0  1  2
	 [10, 9, 6] //2 puis 0  1  2
]
];

	 echo "$student[0] a eu " . $student[2][2][2];
	 echo "\n";

# TABLEAU ASSOCIATIF ('clé'=> valeur)

$student = [
	'firstName' => 'Paul',
	'lastName' => 'Peron',
	'grades' => [12, 16, 4],
];

echo $student['firstName']  . " a eu " . $student['grades'][0] . " en philo.";
echo "\n";
print_r($student);
echo "\n";


$studentAll = [

	[
		'firstName' => 'Paul',
		'lastName' => 'Peron',
		'grades' => [12, 16, 4],
	],
	[
		'firstName' => 'Tom',
		'lastName' => 'Perez',
		'grades' => [12, 16, 4],
	],
	[
		'firstName' => 'Ken',
		'lastName' => 'Roche',
		'grades' => [12, 16, 4],
	],
	[
		'firstName' => 'JP',
		'lastName' => 'Amer',
		'grades' => [12, 16, 4],
	],
	[
		'firstName' => 'Julie',
		'lastName' => 'Farré',
		'grades' => [12, 16, 4],
	],

];

// sans les boucles, obligés de faire un à un manuellement
echo $studentAll[0]['firstName'] . ', ' . $studentAll[1]['firstName'] . ', ' .$studentAll[1]['firstName'] . ', ' .$studentAll[3]['firstName'] . ', ' .$studentAll[04]['firstName'];


// Comment modifier un tableau

$student = [
	'firstName' => 'Paul',
	'lastName' => 'Peron',
	'grades' => [12, 16, 4],
];

$student['grades'][3] = 18; // modif

// ou ajoute automatiquement à la fin du tableau

$student['grades'][] = 14; 

print_r($student);

// ajout d'une clef et d'une valeur

$student['age'] = 22; 


// Pour compter les éléments dans un tableau

$users = ['user1', 'user2', 'user3'];

echo count($users); // donne 3 car 3 users
echo "\n";
echo count($studentAll); // donne 5 car 5 personnes
echo "\n";
echo count($studentAll,1); // donne 35 = tous les éléments du tableau
echo "\n";
echo count($studentAll[0]['grades']); // donne 3 car 3 notes
echo "\n";


?>