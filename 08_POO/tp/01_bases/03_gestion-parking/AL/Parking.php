<?php 

# Exercice :

/**
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


 # 4. Créez une classe Parking qui contient une liste de voitures.

class Park {

# Propriétés de la classe
private array $cars;
// ou et ne pas le dénir ds le construct
// private array $parking = [];

public function __construct(array $cars = [])
{
    $this->cars = $cars;
}


#  Ajoutez une méthode pour ajouter une voiture au cars.
public function addCar($car)
{
  $this->cars[] = $car;
}

# Ajoutez une méthode pour afficher toutes les voitures dans le cars.

public function displayCars(){
  echo 'Composition Parking : ';
  echo '<br>';
  echo '<br>';
  foreach ($this->cars as $car) {
    echo $car->detailsDisplay() ;
    echo '<br><br>';
  }
}

 # Ajoutez une méthode pour rechercher une voiture par son immatriculation.

 public function searchCar($search){
  foreach($this->cars as $car){
    if($car->getImmat() === strtolower($search)){
      echo "Résultat de la recherche par immatriculation: "; 
      echo '<br>';
      echo '<br>';
      echo $car->detailsDisplay();
      echo '<br>';
      echo '<hr>';
      return;
    }
  }
  echo "Produit {$search} non trouvé.<br><br>";
 }

 # Ajoutez une méthode pour supprimer une voiture du parking par son immatriculation.

 public function deleteCar($deleteImmat){
foreach($this->cars  as $key => $value){
  if($value->getImmat() === trim(strtolower($deleteImmat))){
    unset($this->cars[$key]);
    echo "Produit {$deleteImmat} supprimé.<br><br>";
    $this->displayCars();
    return;
  }
}

echo "Produit {$deleteImmat} non trouvé.<br><br>";
}










}




