<?php

/*
Écrire un programme qui fait deviner à l'utilisateur un nombre généré aléatoirement entre 1 et
100.
Le programme doit :
1. Générer un nombre aléatoire entre 1 et 100 (fonction rand() regarder dans la doc).
2. Demander à l'utilisateur de deviner le nombre.
3. Indiquer si la supposition de l'utilisateur est trop haute, trop basse ou correcte.
4. Répéter le processus jusqu'à ce que l'utilisateur devine correctement le nombre.
5. Compter et afficher le nombre de tentatives nécessaires pour deviner correctement le
nombre.
6. Bonus) Limiter le nombre de tentatives de l'utilisateur à 10. Si l'utilisateur ne devine pas
correctement le nombre dans les 10 tentatives, afficher un message de défaite
*/

$numGenerate = rand(1, 100);
$count = 1;

echo "Nombre à deviner $numGenerate" . PHP_EOL;
$inputUser = (int) readline("Deviner un chiffre entre 1 et 100 :");


// while($count<=10)

do
{
  $count++;
  $inputUser = (int) readline("Wrong!!! Try again : ") . PHP_EOL;
}
while(($inputUser!=$numGenerate) );

  echo"Bravo, vous avez trouver le chiffre $inputUser en $count essais!!";



?>