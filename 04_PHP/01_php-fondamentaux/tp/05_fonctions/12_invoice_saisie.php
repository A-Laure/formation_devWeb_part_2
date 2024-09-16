<?php
/*
Imaginez un système de gestion de factures pour une entreprise. Écrivez des fonctions pour
effectuer les opérations suivantes :
1. Ajouter un article à une facture avec son nom, quantité et prix unitaire.
2. Afficher les articles actuellement sur la facture.
3. Calculer le montant total de la facture
*/

declare(strict_types=1); // pour activer le typage

// ------ DAMIEN ----- */

$facture = [
  ['name' => 'carotte', 'qty' => 4, 'price' => 0.2],
  ['name' => 'banae', 'qty' => 2, 'price' => 0.2],
  ['name' => 'poire', 'qty' => 2, 'price' => 0.2],
];

// & : pour faure un passage par référence afin de pouvoir modifier le tableau aussi à l'extérieur de la fonction
function addItemInvoice(array &$facture)
{

  $itemName = (string) readline("Entrez le nom de l'article : ");
  $itemQty = (int) readline("Entrez la qté : ");
  $itemPrice = (float) readline("Entrez le prix : ");

  foreach ($facture as &$item) {  // obligé de mettre du coup aussi le "&"
    if ($item['name'] === $itemName && $item['price'] === $itemPrice) {
      $item['qty'] += $itemQty;
      return; // ou un break
    }
  }

  $facture[] = ['name' => $itemName, 'qty' => $itemQty, 'price' => $itemPrice];
}
print_r($facture);
addItemInvoice($facture);
print_r($facture);


function displayInvoice($invoice)
{
  echo "Voici les items de la facture : " . PHP_EOL;
  foreach ($invoice as $item) {
    echo "Nom : " . $item['name'] . PHP_EOL;
    echo "Qté : " . $item['qty'] . PHP_EOL;
    echo "PU : " . $item['price'] . PHP_EOL;
    echo PHP_EOL;
  }
}


function invoiceTotal(array $invoice): float
{

  $total = 0;
  foreach ($invoice as $item) {
    $total += $item['qty'] * $item['price'];
  }
  return $total;
}


invoiceTotal($invoice);
addItemInvoice($invoice);
displayInvoice($invoice);


# bonus

// while($choice != -1){
while(true){ // ok car on a un quit ds le menu


Echo "Menu Principal" . PHP_EOL;
Echo "1/ Ajouter un article" . PHP_EOL;
Echo "2/ Afficher la facture" . PHP_EOL;
Echo "3/ Afficher montant facture" . PHP_EOL;
Echo "4/ Quitter" . PHP_EOL;


$choice = readline_redisplay();



switch($choice){
  case 1 : 
    addItemInvoice($invoice);
    break;
  case 2 : 
    displayInvoice($invoice);
    break;
  case 3 : 
    echo "La facture est de : " . invoiceTotal($invoice) . "€";
    break;
  case 4 :
    exit(0);
  default:
      echo 'Option invalide, veuillez choisir une option valide.' . PHP_EOL;
}
}