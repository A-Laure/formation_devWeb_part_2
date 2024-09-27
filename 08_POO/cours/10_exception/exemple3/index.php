<?php

require 'Order.php';
require 'ProductOutOfStockException.php';
require 'InvalidPaymentMethodException.php';

# le double catch permet de capturer plusieur type d'erreur mais une seule est attrapée a la fois

try{
  $order = new Order();
  $product = ['name' => 'Stylo', 'stock' => 4];

  // $order->addProduct($product, 5);
  $order->addProduct($product, 2);
  $order->setPaymentMethod('Bitcoin');
  $order->placeOrder();

}
catch(ProductOutOfStockException $e)
{
  echo "Erreur : {$e->getMessage()} <br>";
  echo "Produit concerné : {$e->getProductName()} <br>";
  echo "Quantité demandée : {$e->getRequestedQuantity()} <br>";
}
catch(InvalidPaymentMethodException $e)
{
  echo "Erreur : {$e->getMessage()} <br>";
  echo "Moyen de paiement concerné : {$e->getPaymentMethod()} <br>";
}