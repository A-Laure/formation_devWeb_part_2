<?php
/*
Écrire un programme qui affiche le contenu du tableau.
*/
// LISTE 1

echo "Liste 1\n";
echo "\n";
$vehiculesOne = [
'voitures'=> ['C3 aircross', 'Passat', 'Dacia Sandero'],
'Camions'=> ['Renault truck', 'Mercedes-Benz Unimog']
];


foreach($vehiculesOne as $type => $brands)
{
  echo "Type : $type " . PHP_EOL ;

  foreach($brands as $brand)
  {
    echo "       $brand " . PHP_EOL;
  }
};

// LISTE 2

echo "\n";
echo "Liste 2\n";
echo "\n";

$vehiculesTwo = [
['voitures'=> ['C3 aircross', 'Passat', 'Dacia Sandero']],
['camions'=> ['Renault truck', 'Mercedes-Benz Unimog']]
];

for($i=0; $i< count ($vehiculesTwo); $i++)

foreach($vehiculesTwo[$i] as $type => $brands)
{
  echo "Type : $type " . PHP_EOL ;

  foreach($brands as $brand)
  {
    echo "       $brand " . PHP_EOL;
  }
}

?>