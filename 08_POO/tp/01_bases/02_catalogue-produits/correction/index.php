<?php 

  require 'Catalog.php';
  require 'Product.php';

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
 * 5. Instanciez des objets Produit, ajoutez-les au catalogue, affichez la liste complète des produits, recherchez un produit, puis supprimez un produit et affichez à nouveau la liste.
 * 
 * 
 * 
 */


 $carrot = new Product('carotte', 1.5, 4);
 $lemon = new Product('citron', 1.75, 2);
 $apple = new Product('pomme', 0.5, 3);
 $endive = new Product('endive', 0.75, 1);
//  echo $product->displayDetails();

//  $catalog = new Catalog(['carotte',1.5,4], ['courgette',1.5,4]);
//  var_dump($catalog);

$catalog = new Catalog();
$catalog->addProduct($carrot,$lemon,$apple,$endive);
$catalog->displayCatalog();
$catalog->deleteProduct('pomme');


$catalog->searchProduct('citron');