<?php
/*
1. Créer une liste de nombre de 1 à 10
2. Ajouter les nombres 16, 24 et 47 à la liste
3. 

*/

$number = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
print_r($number);
echo "\n";
$number[] = 16;
$number[] = 24;
$number[] = 47;
print_r($number);
echo "\n";

// ou en une fois

array_push($number, 16,24,47);
print_r($number);
echo "\n";
?>