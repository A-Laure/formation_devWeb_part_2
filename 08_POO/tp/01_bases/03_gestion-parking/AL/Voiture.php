<?php 

# Exercice :

/**
 * 
 * 1. Création de la classe voiture
 * 2. Ajoutez des méthodes pour définir et obtenir les valeurs de ces propriétés (setImmatriculation, setMarque, setCouleur, getImmatriculation, getMarque, getCouleur).
 *  3. Ajoutez une méthode afficherDetails() qui affiche les détails de la voiture.
 
 * 4. Créez une classe Parking qui contient une liste de voitures.
 * - Ajoutez une méthode pour ajouter une voiture au parking.
 * - Ajoutez une méthode pour afficher toutes les voitures dans le parking.
 * - Ajoutez une méthode pour rechercher une voiture par son immatriculation.
 * - Ajoutez une méthode pour supprimer une voiture du parking par son immatriculation.
 * 5. Instanciez des objets Voiture, ajoutez-les au parking, recherchez une voiture, supprimez une voiture, et affichez la liste des voitures après chaque opération.
 * 
 * 
 */


# 1/ Création de la classe voiture

class Car {

# Propriétés de la classe

private string $immat;
private string $brand;
private string $color;


public function __construct(string $immat, string $brand, string $color)
{
    $this->immat = trim(strtolower($immat));
    $this->brand = strtolower($brand);
    $this->color = strtolower($color);
}

# 3. Ajoutez une méthode afficherDetails() qui affiche les détails de la voiture.

public function detailsDisplay (){
    return 'Marque : ' . $this->brand . '<br> Immatriculation : ' . $this->immat . '<br> Couleur : ' . $this->color;
}

# 2. Ajoutez des méthodes pour définir et obtenir les valeurs de ces propriétés (setImmatriculation, setMarque, setCouleur, getImmatriculation, getMarque, getCouleur).

# Getters

  public function getImmat() : string {
    return $this->immat;
  }

  public function getBrand() : string {
    return $this->brand;
  }

  public function getColor() : string {
    return $this->color;
  }


# Setters

public function setImmat($newValue) : string {
    return $this->immat = $newValue;
  }

  public function setBrand($newValue) : string {
    return $this->brand = $newValue;
  }

  public function setColor($newValue) : string {
    return $this->color = $newValue;
  }


}




