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
private array $parking;

public function __construct(array $parking = [])
{
    $this->parking = $parking;
}


#  Ajoutez une méthode pour ajouter une voiture au parking.
public function addCar($car)
{
  $this->parking[] = $car;
}

# Ajoutez une méthode pour afficher toutes les voitures dans le parking.

public function displayParking(){
  echo 'Composition Parking : ';
  echo '<br>';
  echo '<br>';
  foreach ($this->parking as $voiture) {
    echo $voiture->detailsDisplay() ;
    echo '<br><br>';
  }
}

 # Ajoutez une méthode pour rechercher une voiture par son immatriculation.

 public function searchCar($search){
  foreach($this->parking as $park){
    if($park->getImmat() === strtolower($search)){
      echo "Résultat de la recherche par immatriculation: "; 
      echo '<br>';
      echo '<br>';
      echo $park->detailsDisplay();
      echo '<br>';
      echo '<hr>';
      return;
    }
  }
  echo "Produit {$search} non trouvé.<br><br>";
 }

 # Ajoutez une méthode pour supprimer une voiture du parking par son immatriculation.

 public function deleteCar($deleteImmat){
foreach($this->parking  as $key => $value){
  if($value->getImmat() === trim(strtolower($deleteImmat))){
    unset($this->parking[$key]);
    echo "Produit {$deleteImmat} supprimé.<br><br>";
    $this->displayParking();
    return;
  }
}

echo "Produit {$deleteImmat} non trouvé.<br><br>";
}










}




