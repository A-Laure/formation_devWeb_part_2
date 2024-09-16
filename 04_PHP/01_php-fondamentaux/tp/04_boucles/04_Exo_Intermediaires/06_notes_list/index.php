<?php

/*
Écrire un programme qui demande à l'utilisateur de saisir une note une par une jusqu'à saisir 1
pour terminer la saisie. Chaque note est stockée dans un tableau de notes, et on affiche à la fin
les notes saisies
*/

$marksList =[];
$inputUser = 0;

// $inputUser = (int) readline("Choisir une action : 1/ Entrer une note, -1/ Afficher les notes : ") . PHP_EOL;

while($inputUser != -1)
{
  $inputUser = (int) readline("Entrer une note ou -1 pour afficher les notes : ") . PHP_EOL;

  $marksList[] = $inputUser;
  print_r($marksList);
  
}

print_r($marksList);


?>