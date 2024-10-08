<?php 

require 'Room.php';
require 'Hotel.php';

# Exercice :

/**
 * 
 * 1. Créez une classe Chambre avec les propriétés privées numero, type, et prixParNuit.
 * 2. Ajoutez des méthodes pour définir et obtenir les valeurs de ces propriétés (setNumero, setType, setPrixParNuit, getNumero, getType, getPrixParNuit).
 * 3. Ajoutez une méthode afficherDetails() qui affiche les détails de la chambre.
 * 4. Créez une classe Hotel qui contient une liste de chambres disponibles.
 * - Ajoutez une méthode pour ajouter une chambre à l'hôtel.
 * - Ajoutez une méthode pour afficher toutes les chambres disponibles dans l'hôtel.
 * - Ajoutez une méthode pour réserver une chambre en fonction du numéro (la chambre réservée est retirée des chambres disponibles).
 * - Ajoutez une méthode pour calculer le coût total d'une réservation en fonction du nombre de nuits.
 * 5. Instanciez des objets Chambre, ajoutez-les à l'hôtel, réservez une chambre, et affichez le coût total d'une réservation.
 * 
 * 
 */


$room101 = new Room(101, 'Simple', 60);
$room102 = new Room(102, 'Suite', 120);
$room103 = new Room(103, 'Double', 90);


echo $room101->displayDetails();


$hotel = new Hotel();
$hotel->addRoom($room101);

$bookedRoom = $hotel->bookRoom(101, 'Jean-Pierre'); 
echo $bookedRoom->displayDetails();

echo $hotel->totalCost($bookedRoom, 3);

