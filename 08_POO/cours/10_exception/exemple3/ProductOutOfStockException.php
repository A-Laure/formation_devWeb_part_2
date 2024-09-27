<?php


class ProductOutOfStockException extends Exception
{
  private $productName;
  private $requestedQuantity;

  public function __construct($productName, $requestedQuantity)
  {
    $this->productName = $productName;
    $this->requestedQuantity = $requestedQuantity;
    $message = "Le produit $productName n'est pas disponible dans la quantité demandée: $requestedQuantity";
    parent::__construct($message);
  }

  public function getProductName()
  {
    return $this->productName;
  }

  public function getRequestedQuantity()
  {
    return $this->requestedQuantity;
  }
}
