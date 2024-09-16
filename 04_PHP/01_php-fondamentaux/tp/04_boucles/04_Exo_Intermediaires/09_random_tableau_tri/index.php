<?php

/*
En utilisant la fonction rand(), écrire un programme qui remplit un tableau avec 20 nombres
aléatoires. Trier ces nombres dans deux tableaux distincts. Le premier contiendra les valeurs
positives et le second contiendra les valeurs négatives. Enfin, afficher le contenu des deux
tableaux.
*/

$listRandomPositif = [];
$listRandomNegatif = [];

for ($i = 0; $i < 20; $i++) {
  $rand = rand(-100, 100);
  echo $rand;
  if ($rand >= 0) {
    $listRandomPositif[] = $rand;
  } else {
    $listRandomNegatif[] = $rand;
  }
};

print_r($listRandomPositif);
print_r($listRandomNegatif);
