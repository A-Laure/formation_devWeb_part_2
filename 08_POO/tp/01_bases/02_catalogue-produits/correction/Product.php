<?php 

class Product {

  private string $name;
  private float $price;
  private int $quantity;


  public function __construct(string $name, float $price, int $quantity){

    $this->name = strtolower($name);
    $this->price = $price;
    $this->quantity = $quantity;

  }

  // Méthode afficher le détail du produit
  public function displayDetails(){

    return 'Produit : ' . $this->name . ', <br>Prix : ' . $this->price . '€, <br>Quantité : ' . $this->quantity;

  }

  // Getters
  public function getName() : string{

    return $this->name;

  }

  public function getPrice() : float{

    return $this->price;

  }

  public function getQuantity() : int{

    return $this->quantity;

  }


  // Setters
  public function setName(string $value){

    $this->name =$value;

  }

  public function setPrice(float $value){
    if($value > 0){
      $this->price = $value;
    }else {
      echo 'Veuillez saisir un prix positif';
    }
    
  }

  public function setQuantity(int $value){
    if($value > 0){
      $this->quantity = $value;
    }else {
      echo 'Veuillez saisir un entier positif';
    }
    
  }



}