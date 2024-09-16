<?php
/*
Calculer la moyenne de chaque étudiant à partir d'un tableau d'étudiants. Chaque étudiant a
son propre tableau avec la clé 'grades'.
1. Créez un tableau d'étudiants avec leurs noms et leurs notes 0 - 20.
2. Parcourez le tableau d'étudiants
3. Calculer la note moyenne de chaque étudiant
4. Afficher le nom et la moyenne de chaque étudiant
*/



$studentsAll = [
  'Paul' => [2, 2, 2],
  'A-laure' => [4, 8, 12],
  'Tom' => [5, 10, 15],
];



foreach ($studentsAll as $student => $marks)
// pas besoin de compteur dans le foreach

{
  echo "L'élève $student :\n";
  $count = 0;
  $sum = 0;
  $average = 0;


  foreach ($marks as $mark) {
    echo " - $mark" . PHP_EOL;

    $sum += $mark;
    $count++;
    $average = $sum / $count;
  }
  echo "La somme des notes est $sum ." . PHP_EOL;
  echo "La moyenne des notes de $student est $average ." . PHP_EOL;
};
