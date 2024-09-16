<?php

/*
Exercice 1
Écrivez un programme qui demande à l'utilisateur de saisir un nombre et affiche "Positif" s'il est
positif, "Négatif" s'il est négatif, et "Zéro" s'il est égal à zéro.
*/

echo "EXERCICE 1" . PHP_EOL;

$userInput = (int) readline('Saisissez un nombre positif ou négatif: ');

if ($userInput > 0)
{
  echo $userInput . "est positif" . PHP_EOL;
}
elseif($userInput < 0)
{
  echo $userInput . "est négatif" . PHP_EOL;
}
else
{
  echo $userInput . "est égal à zéro" . PHP_EOL;
}


/*
Exercice 2
Écrivez un programme qui demande à l'utilisateur de saisir une valeur entière et afficher son double si cette valeur donnée est inférieure à un seuil donné.
seuil = 20
*/

echo "EXERCICE 2" . PHP_EOL;

const SEUIL = 20;

$userInput2 = (int) readline('Saisissez un nombre entier inférieur à 20 : ');

if ($userInput2 < SEUIL)
{
  $double = $userInput2 * 2;
  echo "Le double de $userInput2 est " . $double . PHP_EOL;
}
else{
  echo "La valeur dépasse le seuil établi à ". SEUIL . PHP_EOL;
}

/*
Exercice 3
Écrivez un programme qui demande à l'utilisateur de saisir une moyenne entière et affiche la mention correspondant à sa moyenne.
*/

echo "EXERCICE 3" . PHP_EOL;

$average = (int) readline('Saisissez votre moyenne: ');

if($average >= 14)
{
  echo "Mention très bien" . PHP_EOL;
}
elseif($average >=12 && $average < 14)
{
  echo "Mention assez bien" . PHP_EOL;
}
elseif($average >=10 && $average < 12)
{
  echo "Mention passable" . PHP_EOL;
}

else{
  echo "Insuffisant" .PHP_EOL;
}

/*
Exercice 4
Écrivez un programme qui demande de saisir deux nombres à l’utilisateur et l’informe ensuite si leur produit est négatif ou positif (on laisse de côté le cas où le produit est nul).
Attention toutefois : on ne doit pas calculer le produit des deux nombres.
*/



// SOLUTION 1


echo "EXERCICE 4 SOLUTION 1" . PHP_EOL;

$num1 = (int) readline('Saisissez un 1er nombre: ');
$num2 = (int) readline('Saisissez un 2ème nombre: ');

if($num1 < 0 xor $num2 < 0)
{
  echo "Le produit de $num1 et $num2 sera négatif" . PHP_EOL;
}

else
{
  echo "Le produit de $num1 et $num2 sera positif " . PHP_EOL;
}

// SOLUTION 2

echo "EXERCICE 4 SOLUTION 2" . PHP_EOL;

$num1 = (int) readline('Saisissez un 1er nombre: ');
$num2 = (int) readline('Saisissez un 2ème nombre: ');

if(($num1 >=0 && $num2 >= 0) || ($num1 < 0 && $num2 < 0))
{
  echo "Le produit de $num1 et $num2 sera positif" . PHP_EOL;
}
else
{
  echo "Le produit de $num1 et $num2 sera négatif " . PHP_EOL;
}



/*
Exercice 5
Écrivez un programme qui demande à l'utilisateur de saisir un numéro de jour (1 pour lundi, 2 pour mardi, etc.) et affiche le nom du jour correspondant.
*/

echo "EXERCICE 5" . PHP_EOL;

$inputDay = (int) readline('Choisir un nombre entre 1 et 7 : (1: Lundi, 2: Mardi, 3: Mercredi, 4: Jeudi, 5: Vendredi, 6: Samedi, 7: Dimanche)  ');


switch($inputDay)
{
  case 1: 
    echo "Lundi\n";
    break; 
  case 2: 
    echo "Mardi\n";
    break;
  case 3: 
    echo "Mercredi\n";
    break;
  case 4: 
    echo "Jeudi\n";
    break;
  case 5: 
    echo "Vendredi\n";
    break;
  case 6: 
    echo "Samedi\n";
    break;
  case 7: 
    echo "Dimanche\n";
    break;
  default: 
  echo "Error";
}

// on crée une variable et il compare avec la variable initiale
$result = match($inputDay){
  1 => 'Lundi',
  2 => 'Mardi',
  3 => 'Mercredi',
  4 => 'Jeudi',
  5 => 'Vendredi',
  6 => 'Samedi',
  7 => 'Dimanche',
  default => "Numéro jour invalide"
};

echo $result . PHP_EOL;

/*Exercice 6
Écrivez un programme qui demande à l'utilisateur de choisir une boisson parmi plusieurs choixet si il souhaite du sucre (oui/non). Et affiche la boisson choisie avec ou sans sucre.
*/

echo "EXERCICE 6" . PHP_EOL;

$action2 = (int) readline('Entrer une action : (1: café, 2: Thé, 3: Soupe, 4: )  ') . PHP_EOL;
// echo "Entre une action...\n"; etc....
$sugar1 = (int) readline('Voulez-vous du sucre : (1: Oui, 2: Non)  ') . PHP_EOL;

switch($action2)
{
  case 1: 
    echo 'Café' . PHP_EOL;
    break; 
  case 2: 
    echo 'thé' . PHP_EOL;
    break;
  case 3: 
    echo 'Soupe' . PHP_EOL;
    break;
  
  default: 
  echo 'Error' . PHP_EOL;
}


switch($sugar1)
{
  case 1: 
    echo 'Sucré' . PHP_EOL;
    break; 
  case 2: 
    echo 'Non Sucré' . PHP_EOL;
    break;
    default: 
    echo 'Error' . PHP_EOL;
 }

 /*Exercice 6 bis
Écrivez un programme qui demande à l'utilisateur de choisir une boisson parmi plusieurs choixet si il souhaite du sucre (oui/non). Et affiche la boisson choisie avec ou sans sucre.
*/
echo "   ";
echo "EXERCICE 6bis" . PHP_EOL;

$sugar2 = (int) readline('Voulez-vous du sucre : (1: Oui, 2: Non)  ') . PHP_EOL;

if($sugar <=2)
{ // ou <3
  $sugar2 = (int) readline('Voulez-vous du sucre : (1: Oui, 2: Non)  ') . PHP_EOL; // on aurait pû rajouter annuler
}

$action3 = (int) readline('Entrer une action : (1: café, 2: Thé, 3: Soupe, : )  ') . PHP_EOL;


// if($sugar2 == 1)
// {
//   $text='sucré';
// }
// else{
//   $text='non sucré';
// }

$text = $sugar === '1' ? 'Sucré' : 'Non sucré';

switch($action3)
{
  case 1: 
    echo "Café $text" . PHP_EOL;
    break; 
  case 2: 
    echo "Thé $text" . PHP_EOL;
    break;
  case 3: 
    echo "Soupe $text" . PHP_EOL;
    break;  
  default: 
  echo 'Error' . PHP_EOL;
}


?>