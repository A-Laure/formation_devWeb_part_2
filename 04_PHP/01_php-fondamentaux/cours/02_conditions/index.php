<?php

# OPERATEURS DE COMPARAISON

/*
$a == $b	 Égal	true si $a est égal à $b après le transtypage.
$a === $b	 Identique	true si $a est égal à $b et qu'ils sont de même type.
$a != $b	 Différent	true si $a est différent de $b après le transtypage.
$a <> $b	 Différent	true si $a est différent de $b après le transtypage.
$a !== $b  Différent	true si $a est différent de $b ou bien s'ils ne sont pas du même type.
$a < $b	   Plus petit que	true si $a est strictement plus petit que $b.
$a > $b	   Plus grand	true si $a est strictement plus grand que $b.
$a <= $b	 Inférieur ou égal	true si $a est plus petit ou égal à $b.
$a >= $b	 Supérieur ou égal	true si $a est plus grand ou égal à $b.
$a <=> $b	 Combiné	Un entier inférieur, égal ou supérieur à zéro lorsque $a est inférieur, égal, ou supérieur à $b respectivement.
*/

// le === vérifie aussi le type a utiliser au max, plus précis que le ==

$a = 4;
$b = 6;

$a == $b; // égalité
$a === $b; // égalité stricte (donnée et type)
$a != $b; // différent
$a !== $b; // différent strict (donnée et type)
$a < $b; // strictement inférieur
$a <= $b; // inférieur ou égal
$a > $b; // strictement supérieur
$a >= $b; // supérieur ou égal


# OPERATEURS LOGIQUES (le smots sont plus rarement utilisés)
/*
$a and $b	And (Et)	true si $a ET $b valent true.
$a or $b	Or (Ou)	true si $a OU $b valent true.
$a xor $b	XOR	true si $a OU $b est true, mais pas les deux en même temps.
# ! $a	Not (Non)	true si $a n'est pas true.
$a && $b	And (Et)	true si $a ET $b sont true.
$a || $b	Or (Ou)	true si $a OU $b est true.

 && ou and : l'opérateur ET, permet de préciser une condition en associant des cas logiques
 || ou or : l'opérateur OU, c'est l'un ou l'autre
 # ! : l'opérateur NOT, n'est pas
 xor : l'opérateur OU, l'un ou l'autre mais pas les 2 en même temps


 VRAI && VRAI = VRAI
 FAUX && VRAI = FAUX
 VRAI && FAUX = FAUX
 FAUX && FAUX = FAUX


 VRAI || VRAI = VRAI
 FAUX || VRAI = VRAI
 VRAI || FAUX = VRAI
 FAUX || FAUX = FAUX
*/

/* IF (si)

if (condition)
{
  exécute instruction si la condition est vérifiée
}

*/

$age = 24;

// if($age<18)
// {
// echo "Vous êtes trop jeune pour rentrer!" . PHP_EOL;
// }

// if($age >= 18 && $age < 35)
// {
//   echo "Vous êtes plus ou moins jeunes!";
// }

/* IF (si) else (sinon)

if (condition)
{
  exécute instruction si la condition est vérifiée
}
else
{
  exécute instruction si la condition n'est pas vérifiée
}

*/

#$userInput = 18; // si  '18' (string) => pas égal

Echo "EXERCICE avec input" . PHP_EOL; 

 // la saisie est toujours considérée comme une string, chaîne de valeur même quand c'est un chiffre
$userInput = (int)readline("Saisissez une valeur: "); // le (int) force la string en int

if($userInput === 18){
echo "Egal!" . PHP_EOL;
}
else{
echo "Pas égal!" . PHP_EOL;  //  affichera pas égal car la saisie est toujours considérée comme une string, chaîne de valeur même quand c'est un chiffre
}



Echo "EXERCICE TEMPS" . PHP_EOL;


$temps = 'ensoleille';

if($temps === 'ensoleille')
{
  echo "il fait beau." . PHP_EOL;
}
else
{
  echo "il ne fait pas beau." . PHP_EOL;
}

# TERNAIRE = IF--ELSE sur une ligne

//  condition ? vrai : faux;   ? = si   : = sinon


echo "EXERCICE TERNAIRE" . PHP_EOL;
$roleUser = 'admin';

echo $roleUser ==='admin' ? "Vous avez accés à la partie admin" . PHP_EOL : "Accés refusé" . PHP_EOL;

# IF  ELSEIF ELSE

// if(condition1)
// {
//   instruction si condition 1 vérifiée
// }
// elseif(condition2)
// {
//   instruction si condition 1 non vérifiée mais quela condition 2 est vérifiée
// }
// else
// {
//   instruction si aucune des conditions est vérifiée
// }


echo "EXERCICE IF ELSEIF ELSEIF" . PHP_EOL;

$salaire = (int)readline('Saisissez votre salaire: ') . PHP_EOL;

if($salaire < 1200 )
{
  echo "Vous êtes en dessous du SMIC" . PHP_EOL;
}
elseif($salaire < 1800)
{
  echo "Tu survis" . PHP_EOL;
}
elseif($salaire < 2500)
{
  echo "Vous êtes payés raisonnablement" . PHP_EOL;
}
else{
  echo "Je veux ton job" . PHP_EOL;
}


# SWITCH (SELON LE CAS)

echo "EXERCICE SWITCH" . PHP_EOL;

$action = (int) readline('Entrer une action : (1: Lancer un sort, 2: attaquer, 3: passer son tour)  ') . PHP_EOL;

switch($action)
{
  case 1: 
    echo 'Sort lancé' . PHP_EOL;
    break; // si 1 alors tu as fini, tu sors du script
  case 2: 
    echo 'Attaque lancée' . PHP_EOL;
    break;
  case 3: 
    echo 'Tour passé' . PHP_EOL;
    break;
  default: 
  echo 'Action inconnue' . PHP_EOL;
}

?>