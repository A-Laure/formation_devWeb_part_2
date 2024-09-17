<?php

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


# 4. Créez une classe Hotel qui contient une liste de chambres disponibles.

class Hotel
{

    # Propriétés de la classe

    private array $hotel;

    public function __construct(array $hotel = [])
    {
        $this->hotel = $hotel;
    }

    # Ajoutez une méthode pour ajouter une chambre à l'hôtel.

    public function addRoom($room)
    {
        $this->hotel[] = $room;
    }

    # * - Ajoutez une méthode pour afficher toutes les chambres disponibles dans l'hôtel.

    public function displayHotel()
    {
        echo 'Composition Hotel : ';
        echo '<br>';
        echo '<br>';
        foreach ($this->hotel as $room) {
            echo $room->displayDetails();
            echo '<br><br>';
        }
    }

    # Ajoutez une méthode pour réserver une chambre en fonction du numéro (la chambre réservée est retirée des chambres disponibles).

    public function roomReservation(int $num)
    {
        foreach ($this->hotel as $key => $room) {
            if ($room->getNumber() == $num) {
                unset($this->hotel[$key]);
                echo "Chambre {$num} bien réservée.";
                echo '<br>';
                echo '<br>';
                $this->displayHotel();
                return $room->getNightPrice();
            }
        }
        echo "Chambre {$num} non disponible.<br><br>";
    }

    # Ajoutez une méthode pour calculer le coût total d'une réservation en fonction du nombre de nuits.

    public function totalStay(int $num, int $nigths)
    {
        $reservation = $this->roomReservation($num);

        if ($reservation !== null) {
            $totalStay = $reservation * $nigths;
            echo "Le coût de la réservation est de {$totalStay}€.";
            return;
        } else {
            echo "Veuillez saisir un numéro de chambre disponble";
        }
    }
}
