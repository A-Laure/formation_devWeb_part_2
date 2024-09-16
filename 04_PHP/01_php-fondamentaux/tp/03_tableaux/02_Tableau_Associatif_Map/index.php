<?php

/* 
1. Créer un tableau représentant une liste de services et leur description (3)
2. Ajouter un service supplémentaire avec sa description
3. Modifier la description du 2ème élément du tableau
*/

$services1=
[
	'service1' => 'description1',
	'service2' => 'description2',
	'service3' => 'description3',
];

echo "Tableau 1\n";
print_r($services1);

$services1['service4'] = 'description4';

echo "Tableau 2\n";
print_r($services1);

$services1['service2'] = 'description2 modifié';

echo "Tableau 3\n";
print_r($services1);



$services2 =
[
[
	'service' => 'Ménage1',
	'description' =>'laver',
	'price' => 500.00,
],
[
	'service' => 'Ménage2',
	'description' =>'laver',
	'price' => 500.00,
],
[
	'service' => 'Ménage3',
	'description' =>'laver',
	'price' => 500.00,
],
];

echo "Tableau 4\n";
print_r($services2);

// ajout d'un service supplémentaire et une description

$services2[] =
[
	'service' => 'Ménage sup',
	'description' => 'toto',
	'price' => 10
];

echo "Tableau 5\n";
print_r($services2);


// Modifier la description du 2ème élément du tableau

$services2[1]['description'] = 'description2 modifié';

echo "Tableau 6\n";
print_r($services2);



?>