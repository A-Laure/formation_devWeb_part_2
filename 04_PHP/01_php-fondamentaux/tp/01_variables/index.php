<?php

/*
Ecrire un programme qui échange la valeur de deux variables.
Ex : si a = 2 et b = 5 => a = 5 et b=2
*/

$a=2;
$b=5;

echo 'La variable a est = '. $a . PHP_EOL; // PHP_EOL fait un ENTER à la ligne
echo 'La variable b est = ' .  $b . PHP_EOL;

// SOLUTION 1

$temp=$a;
$a=$b;
$b=$temp;

echo 'Solution 1, la nouvelle variable a est '. $a . PHP_EOL;
echo 'Solution 1 la nouvelle variable b est ' .  $b . PHP_EOL;

// SOLUTION 2

$a=2;
$b=5;

$a=$a+$b; // a = 7 ou $a += $b
$b=$a-$b; // b = 2
$a=$a-$b; // a = 5

echo 'Solution 2, la nouvelle variable a est '. $a . PHP_EOL;
echo 'Solution 2 la nouvelle variable b est ' .  $b . PHP_EOL;

?>


