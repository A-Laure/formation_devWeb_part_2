<?php

require 'BankAcount.php';

$count1 = new BankAccount(10.2);

echo 'Get Solde: ' . $count1->getSolde() . '  ';
echo '<br>';
echo  $count1->add(5);
echo 'ADD / Get Solde: ' . $count1->getSolde() . '  ';

echo '<br>';
echo 'Set Depot: ' . $count1->less(3);
echo '<br>';
echo 'Less / Get Solde: ' . $count1->getSolde() . '  ';

echo '<br>';
echo '<br>';
$count1->displaySolde();

