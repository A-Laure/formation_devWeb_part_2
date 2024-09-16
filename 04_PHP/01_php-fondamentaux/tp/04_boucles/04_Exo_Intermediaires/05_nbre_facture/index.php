<?php

/*
Écrire un programme qui demande le nombre de factures à saisir, puis fait la somme des
dépenses saisies et affiche la somme totale des dépenses ainsi que le nombre de factures
saisies
*/

$count = 1;
$invoiceNumber = (int) readline( "Donner le nombre de factures à saisir : ") . PHP_EOL;
$cumul = 0;
$countDown = $invoiceNumber;


while($countDown!=0)

{

  
    $depense = (int) readline("Saisir un montant : ") . PHP_EOL;
    $count++;
    $countDown --;
    $cumul+=$depense;
    
  


}
echo  "Le montant des dépenses est $cumul € et vous avez saisi $count facture(s)" . PHP_EOL;

?>