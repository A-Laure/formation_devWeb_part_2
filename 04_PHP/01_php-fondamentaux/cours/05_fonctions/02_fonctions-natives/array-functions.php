<?php


$numbers = [40,12,96,16,23,77];
$persons  = ['Paul', 'Florent','Peter'];
$grades = [[12,14,12,36,],[12,14,12,36,],[12,14,12,36,]];



# count() compte le nombre d'élément d'un tableau de la 1ère dimension

$result1 = count($numbers) ; // donne 6
$result2 = count($persons) ; // donne 3
$result3 = count($grades) ; // donne 3

var_dump($result1);
var_dump($result2);
var_dump($result3);


# sort() - tri croissant et reste définitif
# rsort() - tri décroissant et reste définitif

$result1 = sort($numbers) ; // function sort(array &$array, int $flags = SORT_REGULAR): true { } -> le &  devant array indique que le tableau devient définitif
$personsTri = sort($persons) ;

var_dump($numbers);
print_r($numbers);
var_dump($persons);

# array_push() - ajoute un ou ++ élément à la fin d'un tableau et le return (garde en mémoire)

array_push($persons, 'Jp', 'tom' );// autant de personnes/d'élément que l'on veut
var_dump($persons);

# array_pop() - supprime le dernier élément d'un tableau

array_pop($persons); // le met dans un "temp"
var_dump($persons); 
//ou
$persons  = array_pop($persons); // permet de le stocker
var_dump($persons); 

# array_shift() - supprime élément au début d'un tableau
$persons = array_shift($numbers); // le met dans un "temp"

# array_unshift shift() - ajoute élément au début d'un tableau
$persons = array_shift($numbers, 'Alaure'); // le met dans un "temp"

# array_slice() -> extrait une partie du tableau et le return (garde en mémoire)
$slice = array_slice($numbers, 2 , 3); // 2 = position dans le tableau dc le 3ème élmt offset = où on commence, 3 = 3 élmt à sup à partir de l'offset

# array_splice() ->efface et remplace à partir de ... et par quoi 

$splice = array_splice($numbers, 2 , 3); // enlève
$splice = array_splice($numbers, 2 , 3, [99,11,23]);  // enlève et remplace à la position indiquée

var_dump($numbers);

# array_sum() -> calcule somme d'un tableau
$sum = array_sum($numbers);
var_dump($numbers);

# array_search() -> cherche un élément
$search = array_search(12, $numbers); // key 5 car sort depuis tableau 1 dc tableau 1 mais trié
var_dump($numbers);


# in_array() -> cherche un élément et renvoi vrai ou faux, juste vérifie si présent
$in_array = array_search(12, $numbers); 
var_dump($numbers);

# is_array() permet de voir si je dois faire un foreach car encore un tableau dans tableau associatif

# explode() split string by string et renvoi un tableau
$string = "Le chat boit du lait";
$hobby = "voyage,tennis,lecture";
$result = explode(' ', $string);
$result = explode(' ', $string); // faut pas espace après virgule dans ce cas

# implode() join string by string et renvoi un tableau

//$result = implode(', ', $persons);



?>