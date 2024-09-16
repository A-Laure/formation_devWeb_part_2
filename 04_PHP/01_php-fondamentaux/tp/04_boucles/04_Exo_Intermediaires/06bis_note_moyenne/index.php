
<?php
/*
Exercice 6 bis
Écrire un programme qui demande à l'utilisateur de saisir une note une par une jusqu'à saisir 1
pour terminer la saisie. Puis qui fait la somme des notes saisie et calcule la moyenne.
Attention vous aurez besoin de savoir le nombre d'éléments qu'il y a dans le tableau de notes (
on l'a déjà vu si vous avez oublié regardez dans la doc de php)
*/

# SOLUTION AVEC CALCUL MOYENNE A LA FIN DE LA SAISIE

$marksList =[];
$inputUser = 0;

while($inputUser != -1){
  $inputUser = (int) readline("Entrer une note ou -1 pour afficher les notes : ") . PHP_EOL;

  if($inputUser != -1){
    $marksList[] = $inputUser;
  }
}

echo ("Vous aves saisi les notes suivantes : ") . PHP_EOL;
print_r($marksList);

// Somme des notes

$sum = 0;
$count=0;
$average =0;

foreach($marksList as $marks){
  $count++;
  echo "\nLa compteur est de : $count";
  $sum += $marks;
  echo "\nLa somme de vos notes est : $sum";
}

$average = $sum / $count;
echo "\nla moyenne de vos $count notes est de $average. "

# SOLUTION AVEC CALCUL MOYENNE AU FIL DE LA SAISIE

// $marksList =[];
// $inputUser = 0;
// $sum = 0;
// $average =0;
// $count=0;

// $inputUser = (int) readline("Choisir une action : 1/ Entrer une note, -1/ Afficher les notes : ") . PHP_EOL;

// while($inputUser != -1)
// {
//   $inputUser = (int) readline("Entrer une note ou -1 pour afficher les notes : ") . PHP_EOL;

//   if($inputUser != -1)
//   {
//     $sum += $inputUser;
//     $marksList[] = $inputUser;
//     $count = count($marksList);
//     print_r($marksList);
//   }
// else{
  
// echo ("Le nombre de notes est $count."). PHP_EOL;
// $average =  $sum / $count;

// echo "La moyenne finale de vos notes est $average." . PHP_EOL;

// }
    
// }




?>