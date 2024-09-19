<?php 

require 'Parking.php';
require 'Car.php';

# Exercice :

/**
 * 
 * 1. Créez une classe Voiture avec les propriétés privées immatriculation, marque, et couleur.
 * 2. Ajoutez des méthodes pour définir et obtenir les valeurs de ces propriétés (setImmatriculation, setMarque, setCouleur, getImmatriculation, getMarque, getCouleur).
 * 3. Ajoutez une méthode afficherDetails() qui affiche les détails de la voiture.
 * 4. Créez une classe Parking qui contient une liste de voitures.
 * - Ajoutez une méthode pour ajouter une voiture au parking.
 * - Ajoutez une méthode pour afficher toutes les voitures dans le parking.
 * - Ajoutez une méthode pour rechercher une voiture par son immatriculation.
 * - Ajoutez une méthode pour supprimer une voiture du parking par son immatriculation.
 * 5. Instanciez des objets Voiture, ajoutez-les au parking, recherchez une voiture, supprimez une voiture, et affichez la liste des voitures après chaque opération.
 * 
 * 
 */

 $punto = [
  'registration' => 'HY-369-LP',
  'brand' => 'Fiat',
  'color' => 'Vert'
 ];

 $tesla = [
  'registration' => 'HY-369-RP',
  'brand' => 'Tesla',
  'color' => 'Blanc'
 ];

 $myPunto = new Car($punto);
 $myTesla = new Car($tesla);

// echo $myPunto->displayDetails();


$parking = new Parking();

$parking->addCar($myPunto, $myTesla);

$parking->displayAllCars();



echo $parking->findOne('HY-369-RP');
echo $parking->findOne('HY-369-LM');


echo $parking->deleteCar('HY-369-LP');
echo $parking->deleteCar('HY-369-LM');






