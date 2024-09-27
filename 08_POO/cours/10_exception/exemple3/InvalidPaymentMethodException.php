<?php


class InvalidPaymentMethodException extends Exception
{
  private $paymentMethod;

  public function __construct($paymentMethod)
  {

    $this->paymentMethod = $paymentMethod;
    $message = "Le moyen de paiement $paymentMethod est invalid.";
    parent::__construct($message);
  }


  public function getPaymentMethod()
  {
    return $this->paymentMethod;
  }
}
