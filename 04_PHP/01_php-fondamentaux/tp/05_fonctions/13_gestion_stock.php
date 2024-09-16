<?php



/* 

Vous devez développer un système de gestion de stock pour un magasin.
Écrivez des fonctions pour effectuer les opérations suivantes :
  1. Ajouter un produit au stock avec son nom, prix unitaire et quantité.
  2. Afficher le stock actuel.
  3. Passer une commande en spécifiant le produit, la quantité désirée et le prix unitaire convenu.
  4. Afficher le coût total de la commande.


*/


$stock = [
  ['name' => 'carotte', 'quantity' => 4, 'price' => 0.2],
  ['name' => 'banane', 'quantity' => 2, 'price' => 1.2],
  ['name' => 'aubergine', 'quantity' => 4, 'price' => 2.3],
];

$orderList = [];


# (1) Ajouter un article à une facture avec son nom, quantité et prix unitaire.
// on ajoute & devant la variable $stock pour faire un passage par reference afin de pouvoir modifié le tableau aussi a l'exterieur de la fonction 
function addItemToStock(array &$stock) {

  $itemName = (string) readline('Nom de l\'item : ');
  $itemQuantity = (int) readline('Quantité de l\'item : ');
  $itemPrice = (float) readline('Prix unitaire de l\'item : ');

  // boucle pour verifier si un item existe deja dans le tableau 
  // & pour agir directement(meme a l'exterieur de la fonction) sur les items
  foreach($stock as &$item){  
    // si le nom et le prix correspondent on a dditionne les quantités 
    if($item['name'] === $itemName && $item['price'] === $itemPrice){
      $item['quantity'] += $itemQuantity;
      // on quitte la focntion
      return;
    }
  }

  // si l'item n'existe pas on l'ajoute au tableau 
 $stock[] = ['name' => $itemName, 'quantity' => $itemQuantity, 'price' => $itemPrice];

}




# (2) Afficher les articles actuellement sur la facture.
function displayStock(array $stock){

  echo 'Voici les items de la facture : ' .PHP_EOL;
  foreach($stock as $item){
    echo 'Nom : ' . $item['name'] .PHP_EOL;
    echo 'Quantité : ' . $item['quantity'] .PHP_EOL;
    echo 'Prix(unitaire) : ' . $item['price'] .PHP_EOL;
    echo PHP_EOL;
  }

}

# (3) Passer une commande en spécifiant le produit, la quantité désirée et le prix unitaire convenu.
function order(array &$stock, array &$orderList) : bool {

  $itemName = (string) readline('Nom de l\'item : ');
  $itemQuantity = (int) readline('Quantité de l\'item : ');
  $itemPrice = (float) readline('Prix unitaire de l\'item : ');

  // boucle pour verifier si un item existe deja dans le tableau 
  // & pour agir directement(meme a l'exterieur de la fonction) sur les items
  foreach($stock as &$item){  
    // si le nom et le prix correspondent on a dditionne les quantités 
    if($item['name'] === $itemName ){
     
      if($item['quantity'] >= $itemQuantity){

        $item['quantity'] -= $itemQuantity;
        $orderList[] = ['name'=> $itemName, 'quantity' => $itemQuantity, 'price' => $itemPrice];
        return true;

      }else {
        echo 'Quantité insuffisante en stock' .PHP_EOL;
        return false;
      }

    }
  }
  echo 'Produit non trouvé dans le stock'.PHP_EOL;
}


# (4) Calculer le montant total de la facture.
function totalOrder(array $orderList) : float{

  $total = 0;
  foreach($orderList as $item){
    $total += $item['quantity'] * $item['price'];
  }

  return $total;
}

// addItemTostock($stock);

// displaystock($stock);

// echo totalstock($stock);


# bonus pour aller plus loin 
while(true){

  echo 'Menu principal'.PHP_EOL;
  echo '1. Ajouter un produit'.PHP_EOL;
  echo '2. Voir le stock'.PHP_EOL;
  echo '3. Passer une commnande'.PHP_EOL;
  echo '4. Voir la commnande'.PHP_EOL;
  echo '5. Voir le montant total de la commande'.PHP_EOL;
  echo '6. Quitter'.PHP_EOL;
  echo PHP_EOL;

  $choice = readline('Choisissez une option : ');


  switch($choice){
    case 1: 
      addItemToStock($stock);
      break;
    case 2: 
      displayStock($stock);
      break;
    case 3: 
      order($stock, $orderList);
      break;
    case 4: 
      displayStock($orderList);
      break;
    case 5: 
      echo 'La montant de la commande est de ' . totalOrder($orderList) . '€' .PHP_EOL;
      echo PHP_EOL;
      break;
    case 6: 
    exit(0);
    default:
      echo 'Option invalide, veuillez choisir une option valide' .PHP_EOL;
      echo PHP_EOL;
  }
  
}