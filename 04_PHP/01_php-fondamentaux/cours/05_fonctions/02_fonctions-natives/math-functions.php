<?php

# https//www.php.net/manuel/fr/ref.math.fr


# rand() génère un nombre aléatoire
$result = rand();
$result2 = rand(0, 10); // avec un intervalle

echo $result;
echo $result;

# round() pour arrondir un nombre flottant (type float), à virgule
// on peut mettre un 2ème paramètre
$round = round(4.5); // donne 5, 4.2 donne 4
$round = round(4.5666, 2); //arrondira avec 2 décimales après la virgule

# ceil() arrondi forcément chiffre supérieur
$round = ceil(4.2); // donne 5

# floor() arrondi forcément chiffre inférieur
$round = ceil(4.6); // donne 4

# sqrt() calcule la racine carrée
$result = sqrt(4); // donne 16

# abs() la valeur absolue
$result = abs(4);

# pi() la valeur pi
$result = pi();

# max() retourne la valeur la plus haute d'un tableau
$result = max(4,6,9,12); // donne 12
$result = max([4,6,19,12]); // donne 19

# max() retourne la valeur la plus basse d'un tableau
$result = min(4,6,9,12); // donne 4
$result = min([4,6,19,12]); // donne 4
# number-format()
# ?string -> le "?" null safety indique que la variable n'est pas obligatoire

$result = number_format(1215665.255541,2,  ', ', '');

?>