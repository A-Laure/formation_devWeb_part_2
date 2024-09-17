<?php

# Exercice :

/**
 * 
 * 1. Créez une classe Product avec les propriétés privées nom, prix, et quantite.
 * 2. Ajoutez des méthodes pour définir et obtenir les valeurs de nom, prix, et quantite.
 * 3. Ajoutez une méthode afficherDetails() qui affiche les détails du produit.
 * 4. Créez une classe Catalogue qui contient une liste de produits.
 *  - Ajoutez une méthode pour ajouter un produit au catalogue.
 *  - Ajoutez une méthode pour afficher tous les produits du catalogue.
 *  - Ajoutez une méthode pour supprimer un produit par son nom.
 *  - Ajoutez une méthode rechercherProduit($nom) pour rechercher un produit par son nom.
 * 5. Instanciez des objets Produit, ajoutez-les au catalogue, affichez la liste complète des produits, recherchez un produit, puis       supprimez un produit et affichez à nouveau la liste.
 * 
 * 
 * 
 */


class Product
{

  // Propriété privée pour stocker
  private string $name;
  private float $price;
  private int $qte;


  // Constructeur 
  function __construct(string $name, float $price, $qte)
  {
    $this->name = strtolower($name);
    $this->price = $price;
    $this->qte = $qte;
  }

  // AFFICHER LE DETAIL

  public function detailsDisplay()
  {

    $product = [
      'name' => $this->name, // set product name
      'qte' => $this->qte, // set quantity
      'price' => $this->price
    ];

    // OU return 'Produit : ' . '$name' + etc....

    echo '</br>';
    echo 'Name: ' . $product['name'];
    echo '</br>';
    echo 'Price: ' . $product['price'] . '€';
    echo '</br>';
    echo 'Qte: ' . $product['qte'];
  }



  # GETTERS = AFFICHAGE
  public function getName()
  {
    return $this->name;
  }
  public function getPrice()
  {
    return $this->price;
  }

  public function getQte()
  {
    return $this->qte;
  }




  # SETTERS 
  public function setName($newValue)
  {
    return $this->name = $newValue;
  }


  public function setPrice($newValue)
  {
    if ($newValue > 0) {
      return $this->price = $newValue;
    } else {
      echo 'Le prix doit être positif';
    }
  }

  public function setQte($newValue)
  {
    return $this->qte = $newValue;
  }
}
