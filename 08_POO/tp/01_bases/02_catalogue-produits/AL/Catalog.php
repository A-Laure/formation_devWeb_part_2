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

class Catalog
{

  // Propriété privée pour stocker
  private array $catalog;

  // Méthode pour ajouter un produit au catalogue

  public function _construct(array $catalog = [])
  {
    $this->catalog = $catalog;
  }

  /* OU spread operator 
  public function _construct(...$catalog )
  {
    $this->catalog = $catalog;
  }
*/

# Méthode pour ajouter un produit au catalogue ... = spread operator, permet de rajouter un ou ++ produit en une fois
  public function addProduct(Product ...$product)
  {

    //AVEC spread operator
    $this->catalog = $product;
    //sans spread operator
    // $this->catalog[] = $product;
  }

  # Méthode pour afficher tous les produits
  public function displayCatalog()
  {
    if (empty($this->product)) {
      echo "Le catalogue est vide";
    } else {
      foreach ($this->catalog as $product) {
        echo  $product->displayCatalog();
      }
    }
  }


# Méthode pour supprimer un produit par son nom
  public function deleteProduct($productName)
  {
    foreach ($this->catalog as $key => $product) {
      if ($product->getName() === strtolower($productName)) {
        unset($this->catalog[$key]);
        echo "Produit {$productName} supprimé du catalogue.";
        // pas obligatoire
        $this->displayCatalog();
        return; // casse la boucle
      }
    }
    echo "Produit {$productName} non trouvé dans le catalogue.";
  }

# Méthode pour rechercher un produit par le nom
  public function searchName($search)
  {
    foreach ($this->catalog as $key => $product) {
      if ($product->getName() === strtolower($search)) {
        echo "Produit trouvé";
      } else {
        echo "try again";
      }
    }
  }


  # GETTERS = AFFICHAGE
  public function getProducts()
  {
    return $this->catalog;
  }


  # SETTERS 
  public function setProducts($newValue)
  {
    return $this->catalog = $newValue;
  }
}
