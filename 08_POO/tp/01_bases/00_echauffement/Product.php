<?php

// Exercice :

// 1. Crée une classe Product avec deux propriétés privées : name et price.
// 2. Ajoute des getters et setters pour chacune des propriétés, avec une validation dans le setter du prix (le prix doit être positif).
// 3. Créer un objet Product, définir ses valeurs via les setters, puis afficher les informations via les getters.

class Product
{

  // Propriété privée pour stocker le solde
  private string $name;
  private float $price;


  // Constructeur 
  public function __construct(string $name, float $price)
  {
    $this->name = $name;
    $this->price = $price;

    /* ou
  $this-> setName($name);
  $this-> setprice($price);
  */
  }

  # GETTERS = AFFICHAGE / This  = référence de l'objet en cours
  public function getName()
  {
    return $this->name;
  }
  public function getPrice()
  {
    return $this->price;
  }



  # SETTERS 
  public function setName(string $newValue)
  // ou (?string $value) poourle nullSafety
  {
    return $this->name = $newValue;
  }


  public function setPrice($newValue)
  {
    if ($newValue > 0) {
      $this->price = $newValue;
    } else {
      echo 'Le prix doit être positif';
    }
  }
}
