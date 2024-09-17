<?php

  class Catalog{

    private array $products;


    public function __construct(array $products = [])
    {
      $this->products = $products;
    }

    // public function __construct(...$products)
    // {
    //   $this->products = $products;
    // }


    // Méthode pour ajouter un ou plusieurs produits
    // On a utilisé le spread operator (...) cela permet de mettre autant de parametre que l'on souhaite attention les parametres seront stockés dans un tableau ici $products
    public function addProduct(Product ...$products){
      $this->products = $products;
    }

    // Méthode pour afficher tous les produits
    public function displayCatalog(){
      foreach($this->products as $product){
          echo '<br>';
        echo '<hr>';
        echo $product->displayDetails() . '<br><br>';
        echo '<br>';
      }
    }

    // Méthode pour supprimer un produit
    public function deleteProduct($productName){
      foreach($this->products as $key => $product){
        if($product->getName() === strtolower($productName)){
          unset($this->products[$key]);
          echo "Produit {$productName} supprimé.<br><br>";
          $this->displayCatalog();
          return;
        }
      }

      echo "Produit {$productName} non trouvé.<br><br>";
    }


    // Méthode pour rechercher un produit
    public function searchProduct($search){
      foreach($this->products as $product){
        if($product->getName() === strtolower($search)){
          echo "Recherche :  <br>";
          echo $product->displayDetails();
          return;
        }
      }
      echo "Produit {$search} non trouvé.<br><br>";

    }

    // Getters 
    public function getProducts(){
      return $this->products;
    }

    // Setters 
    public function setProducts(array $value){
      $this->products = $value;
    }

  }