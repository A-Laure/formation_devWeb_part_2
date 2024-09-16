<?php
/*
Écrire les programmes pour dessiner les figures suivantes avec des étoiles (*****):
● un rectangle de 8 étoiles de long et 5 étoiles de large
● un carré de 6 étoiles de côté
● un triangle isocèle rectangle de 7 étoiles de côté
*/

# Rectangle de 8 étoiles de long et 5 de large

// SOLUTION 1
echo "RECTANGLE DE 8 *5 - SOLUTION 1\n";
$line = 1;

do
{
  
  echo "* * * * * * * *" . PHP_EOL;
  $line++;
}
while($line <=5);

// SOLUTION 2

echo "RECTANGLE DE 8 *5 - SOLUTION 2\n";

$line2 = 1;

do{
  for($i = 1; $i <= 8; $i++)
  {
    echo "* ";    
  };
  echo "\n";
  $line2++;
}
while($line2<=5);



# un carré de 6 étoiles de côté

echo "CARRE DE 6*6\n";

$line2 = 1;

do{
  for($i = 1; $i <= 6; $i++)
  {
    echo "*  ";    
  };
  echo "\n";
  $line2++;
}
while($line2<=6);

# ● un triangle isocèle rectangle de 7 étoiles de côté

echo "TRIANGLE ISOCELE DE 7 ETOILES DE CôTES\n";

for($i=0; $i<7; $i++){ //1er for => pour faire instruction tant que pas 7 lignes

  for($j=0; $j<=$i; $j++){  // 2ème for $j=$i => dc 1 étoile pour 1ere ligne,  puis 2 pour la 2 ème puis 3 pour la 3ème  jusqu'à <7 pour faire les 7 lignes
    echo "* ";
  }
  echo"\n";
}

?>