<?php

/*
Créez une fonction qui génère un mot de passe aléatoire. Le mot de passe devrait avoir une longueur donnée en paramètre et contenir des lettres majuscules, des lettres minuscules etdes chiffres. Testez la fonction en générant des mots de passe de différentes longueurs.
(pensez à regarder la doc PHP une ou plusieurs fonction(s) pourrait vous servir)
*/

// ---- SOLUTION DAMIEN ------ 
declare(strict_types=1); // pour activer le typage

function generateWord($length)
{

  $allowedLower = 'azertyuiopqsdfghjklmwxcvbn';  // on peut utiliser les regex
  $allowedUpper =  strtoupper('azertyuiopqsdfghjklmwxcvbn');
  $allowedNumber = '0123456789';
  $allowedCharacters = $allowedNumber . $allowedUpper . $allowedLower;

  $pwd = '';

  //random_int -> Génère un entier uniformément sélectionné entre la valeur minimale et maximale données.

  $pwd .= $allowedLower[random_int(0, strlen($allowedLower) - 1)]; // -1 car on commen ce à 0 
  $pwd .= $allowedUpper[random_int(0, strlen($allowedUpper) - 1)]; // -1 car on commen ce à 0
  $pwd .= $allowedNumber[random_int(0, strlen($allowedNumber) - 1)]; // -1 car on commen ce à 0

  for ($i = strlen($pwd); $i < $length; $i++) { // strlen($pwd) permet de décompter les 3(ici)ers
    $randIndex = random_int(0, strlen($allowedCharacters) - 1);
    $pwd .= $allowedCharacters[$randIndex];
  }

  // on refait un shuffle car sinon commence tjs par une lower, un upper et un number
  $pwd = str_shuffle($pwd);

return $pwd;

}

$pwdLenght = 8;
echo "Mot de passe :" . generateWord($pwdLenght) . PHP_EOL;




// ------ SOLUTION INCOMPLETE --------- //
function pwdGenerator($length)
{

  $pwd = '';
  $randomChoice1 = "abcdefghijklmnopqrstuvwxyz";
  $randomChoice2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $randomChoice3 = "0123456789";


  # substr() -> retourne en segment de chaine 
  # str_shuflle -> Mélange les caractères d'une chaîne de caractères

  $rand1 = substr(str_shuffle($randomChoice1), 0, 1);
  $rand2 = substr(str_shuffle($randomChoice2), 0, 1);
  $rand3  = substr(str_shuffle($randomChoice3), 0, 1);
  $rand4  = substr(str_shuffle($randomChoice3 . $randomChoice2 . $randomChoice3), 0, $length - 3);

  $pwd = $rand1 . $rand2 . $rand3 . $rand4;
  // print_r ($pwd);
  return $pwd;
}
echo "Votre mot de passe est : " . (pwdGenerator(12));
