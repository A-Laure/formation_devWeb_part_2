<?php

/*
Écrire un programme qui vérifie si un nombre est premier
1. Demandez à l'utilisateur d'entrer un nombre.
2. Vérifiez si le nombre est premier.
3. Affichez le résultat
*/

$listDiviseur = [];


$num = (int) readline("Veuillez saisir un nombre : ") . PHP_EOL;
$numCountDown = $num;

// CREATION DE LA LISTE DES DIVISEURS

while ($numCountDown > 2) {
  $numCountDown--;
  $listDiviseur[] = $numCountDown;
  echo "Liste des diviseurs :\n";
  print_r($listDiviseur);
};


// CREATION DE LA LISTE DES MODULOS
$modulo = [];
foreach ($listDiviseur as $number) {

  $modulo[] = $num / $number;
  echo "Print du modulo\n";
  print_r($modulo);
};

// TEST DU MODULO = 0 => n'est pas un nombre premier

$decimalCount = 1; 

  if ($decimalCount != 0) {
   

    foreach ($modulo as $rest) {
      $restString = strval($rest); // on transforme le float (nombre à virgule) en chaîne de caractères
      $decimalPos = strpos($restString, '.'); // on recherche la position de la virgule
      if ($decimalPos !== false) { // si la virgule est trouvée, on compte le nombre de chiffre après la virgule
        $decimalCount =  strlen($restString) - $decimalPos - 1;
        echo "Nombre de chiffres après la virgule : $decimalCount.\n";
      } else {
        $decimalCount = 0; // si aucun point décimal trouvé => 0
        echo "$num n'est pas un nombre 1er\n";
        break;
      }
    };
   } else {
    echo "$num est un nombre 1er\n";
  }

  //---------------- SOLUTION CHATGPT ------------------

  // Demandez à l'utilisateur d'entrer un nombre
$num = (int) readline("Veuillez saisir un nombre : ");

// Initialisation d'une variable pour indiquer si le nombre est premier
$isPrime = true;

if ($num <= 1) {
    $isPrime = false;
} else {
    // Vérifiez les diviseurs possibles de 2 à la racine carrée de $num
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            // Si $num est divisible par $i, ce n'est pas un nombre premier
            $isPrime = false;
            break;
        }
    }
}

// Affichez le résultat
if ($isPrime) {
    echo "$num est un nombre premier\n";
} else {
    echo "$num n'est pas un nombre premier\n";
}

   ?>
