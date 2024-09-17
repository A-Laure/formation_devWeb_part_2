<?php 

require 'Chambre.php';
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

$hotel = new Hotel();

 $chambre1 = new Chamber(1, 'Simple', 32,56);
 $chambre2 = new Chamber(2, 'Double', 60);

 $hotel->addRoom($chambre1);
 $hotel->addRoom($chambre2);

 echo 'detailsDisplay';
 echo '<br>';
 echo '<br>';
 echo $chambre1->displayDetails();
 echo '<br>';
 echo '<hr>';
 echo 'detailsDisplay';
 echo '<br>';
 echo '<br>';
 echo $chambre2->displayDetails();
 echo '<br>';
 echo '<hr>'; 
  echo $hotel->displayHotel();
 echo '<hr>';
 echo 'Réservation :';
 echo '<br>';
 echo '<br>';
 echo $hotel->roomReservation(1);
 echo '<hr>';
 echo '<br>';
 echo '<br>';
 echo $hotel->totalStay(2,2);
 echo '<hr>';

 






