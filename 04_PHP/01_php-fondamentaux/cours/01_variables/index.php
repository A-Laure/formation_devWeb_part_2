<?php
/* le commentaire multiligne comme css */
// le double // pour faire un commentaire sur une ligne  ou le #

/*$ indique une déclaration de variable, une variable = un espace mémoire-stockage , on peut à tt moment redéfinir sa valeur au cours de l'éxécutionde l'algorithme.
le ";" est obligatoire, donne la fin del'INSTRUCTION*/


/** REGLE DES VARIABLES 
* pas obligé ma variable var mais lui donner un nom (cohérent),
* toujours commencer par un "$"
* ne peut contenir que des lettres (majuscule ok), des chiffres et des underscores
* sensible à la casse(différent si majuscule ou minuscule : Name et name pas pareil)
* ne peut pas commencer par un chiffre, forcément par une lettre ou un underscore
*/

/** CONVENTIONS D'ECRITURES : on peut en utiliser +++ dans un langage
 * Snake Case :  $user_name (très utilisé en Python et Dart)
 * Camel Case :  $userName (une des plus utilisée)
 * Pascal Case : $UserName
 * Lower Case :  $username
 * on utilisera la Camel et le Pascal par convention en PHP
 */



/** TYPE DE DONNEES
  * en php on appelle cela du TYPAGE DYNAMIC (JS aussi), pas besoin de lui préciser String ou autre, du coup plus flexible mais "moins sécurisé" et moins opti (place que le serveur doit allouer)
  * string : chaîne de caractères
  * int : integer, nombre entier positif ou négatif
  * float : nombres à virgules (en fait un ".") =  équivalent double (Dart)
  * booleen : valeur true / false
  * array : type de tableau, liste de valeurs
  * object : collections de propriétés (= variables) et de méthodes (=fonctions)
  * null : variable sans valeur
  * ressource : contient une référence vers une ressource externe (fichier, img...)
*/

#string : '' ou "", on verra plus tard qu'il y a une importance dans un certain cas
$name = 'Paul';
#$text="$name n'arrive jamais à l'heure $text"; // en double "" on peut mettre des variables à l'intérieur pas en simple '
$text="n'arrive jamais à l'heure";
$message = 'arrive toujours à l\'heure'; // ou $message = "arrive toujours à l\heure"; le fait de mettre des "", l'apostrophe simple est acceptée au milieu.
// Concaténation

$message2 = $name . ' ' . $text . PHP_EOL; // php_eol fait ENTER pour aller à la ligne dans le terminal sinon géré par css ensuite
echo $message2;




#int:
$age = 22;

#float :
$note = 12.5;

#booleen:
$isTRue = true; 
$isFalse = false; 

#array:
// Tableau indéxé
$vegetables = Array('haricot', 'choux', 'brocolis'); // anciennement mais on peut le rencontrer
$fruits = ['Pomme', "Banane", "Fraise"];
// Tableau associatif (clé / valeur)
$personne = ['nom' => 'Paul', 'age'=> 22];

//print_r($fruits);
//echo $message;

//echo n'affiche que le contenu, var_dump donne des éléments supplémentaires, le type et le nombre de caractères

//var_dump($fruits); 

/*donne le détail du tableau
array(3) {
  [0]=>
  string(5) "Pomme"
  [1]=>
  string(6) "Banane"
  [2]=>
  string(6) "Fraise"
}
*/


#object:
//$personne = new Person(); // on crée une instrance de classe

#null:
$paul = null;

#ressource: r pour read
//$file = fopen('monFichier.txt', 'r'); 


/* CONSTANTES, 2 méthodes pour déclarer
permet de stocker une valeur qui ne change pas ou très rarement, permet de protéger les données, ne pourront être changées par erreur. Sera changée manuellement dans la déclaration et non dans le code par la suite
nom constante, par convention, tjs en maj (pas obligatoire)
*/

define('DBNAME', 'stock');
const DBUSER = 'ALaure'; 


/* ALGORITHME = série d'étapes à appliquer pour résoudre un problème
*/

/*OPERATEURS ARITHMETIQUES
* + :  addition => calcul de la somme
* - : soustraction => calcul de la différence
* * : multiplication => calcul du produit
* ** : puissance => calcul de la puissance
* / : division => calcul u quotient
* % : modulo => calcul du reste
*/

$a = 2;
$b = 3;

echo $a . ' + ' . $b . ' = ' . $a + $b . PHP_EOL; // php_eol fait ENTER pour aller à la ligne dans le terminal sinon géré par css ensuite;
                                       // ou "\n";
echo $a . ' % ' . $b . ' = ' . $a % $b . PHP_EOL;
echo $a . ' / ' . $b . ' = ' . $a / $b . PHP_EOL; // on verra plus tard pour arrondir


$num1 = 5;
$num2 = 15;
$num3 = '20';
$fruit = 'pomme';
$bool1 = true; //bool1 = 1 pour vrai
$bool2 = false; //bool = 0 pour vrai
$paul = null;


// CONVERSION IMPLICITE / reconnait que le string est un int
$result = $num1 + $num2;
$result = $num1 + $num3; // ne devrait pas être possible en dev mais PHP l'autorise, ts les langages en dynamic l'autorisent
$result = $num3 + $num3;
$result = $num1 . $num2; // les transforme en string et les mets côte à côte

//$result = $fruit + $num1; => error car un string et un int
//$result = $fruit + $num3; => error car un string et string ne peuvent s'ajouter mathématiquement

$result = $num1 + $bool1; // int  = 6 car bool1 = 1
$result = $num1 + $bool2; // int  = 5 car bool2 = 0
$result = $num1 + $paul; // int  = 5 car paul is null = 0

// CONVERSION EXPLICITE

$result = (string)$num1; // int to string
$result = (int)$num3; // string to int
$result = (bool)$num1; // int to bool


// VARIABLE DYNAMIQUE

$name = 'Paul';
$$name = 'Personne'; // le double $ => on crée une variable du nom de la chaine de caractère de la variable

echo "VARIABLE DYNAMIQUE 1 : $name {$$name}". PHP_EOL;
echo "VARIABLE DYNAMIQUE 2 :$name $Paul". PHP_EOL; 

var_dump("Le var_dump est : $result"); // var_dump donne des éléments supplémentaires, le type et le nombre de caractères
//var_dump($$paul); 




//balise fermante pas obligatoire 
?> 
