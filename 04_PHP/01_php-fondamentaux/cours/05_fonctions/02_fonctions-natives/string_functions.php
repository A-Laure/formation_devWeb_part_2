<?php

# https//www.php.net/manuel/fr/ref.strings.fr

$string  = 'Salut tt le monde';
$string2  = 'Hé tt le monde';

# strlen() -> calcule la longueur d'une chaîne de caractères !!! compte les espaces
// attention le "é" compte pour 2

$result = strlen($string);
$result2 = strlen($string2);

echo $result . PHP_EOL;
echo $result2 . PHP_EOL;

# mb_strlen() -> lui compte bien

$string  = 'Salut tt le monde';
$string2  = 'Hé tt le monde';

$result = mb_strlen($string);
$result2 = mb_strlen($string);

echo $result . PHP_EOL;
echo $result2 . PHP_EOL;

# str_word_count() // compte le nombre de mots

$result = str_word_count($string);


# strpos() -> pour savoir la position d'un élément

$string  = 'Salut tt le monde';
$result = strpos($string, 'monde'); // donne la position de la 1ère lettre !! il démarre à 0

echo $result . PHP_EOL;

# récupère une lettre spécifique par son index

$result = $string[3]; // affiche le "n" de monde

# strtolower() -> transforme en minuscule
$result = strtolower($string);

# strtoupper() -> transforme en majuscule
$result = strtoupper($string);

# ucwords() -> majuscule à ts les mots = capitalize
$result = ucwords($string);

# substr() -> retourne en segment de chaine (enlever un mot à la fin d'une phrase, certains mots (str_replace))
$result = substr($string, 5,5);

# str_replace() -> remplace toutes les occurences dans une chaîne
$result = str_replace('tout','****' ,$string); //  remplace tous les 'tout' par une *

# trim() -> enlève tous les espaces
$result = trim('               monde           '); 

# unset() détruit une variable, permet de définir une autre du même nom
// on va s'en servir avec les super global (pour détruire une session qd user se déconnecte)
?>