<?php 

class Order 
{
  private $products = [];
  private $paymentMethod;

  public function addProduct($product, $quantity)
  {
    if($quantity > $product['stock'])
    {
      throw new ProductOutOfStockException($product['name'], $quantity);
    }

    $this->products[] = $product;

  }

  public function setPaymentMethod($method)
  {
    $validMethods = ['credit card', 'paypal'];
    if(!in_array($method, $validMethods))
    {
      throw new InvalidPaymentMethodException($method);
    }

    $this->paymentMethod[] = $method;

  }

  public function placeOrder()
  {
    echo "Commande passée avec succès avec le moyen de paiement : {$this->paymentMethod}.";
  }

}