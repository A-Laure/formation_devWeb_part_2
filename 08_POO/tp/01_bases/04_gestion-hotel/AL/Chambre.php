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


# 1. Créez une classe Chambre avec les propriétés privées numero, type, et prixParNuit.

class Chamber{

# Propriétés de la classe

private int $number;
private string $type;
private float $nightPrice;

public function __construct(int $number, string $type, float $nightPrice)
{
    $this->number = $number;
    $this->type = trim(strtolower($type));
    $this->nightPrice = $nightPrice;
}

# 3. Ajoutez une méthode afficherDetails() qui affiche les détails de la chambre.

public function displayDetails(){
    return 'Chambre : ' . $this->number . ' , Type de Chambre : ' . $this->type . ' , Prix de la nuit : ' . $this->nightPrice . '€';
}

# 2. Ajoutez des méthodes pour définir et obtenir les valeurs de ces propriétés (setNumero, setType, setPrixParNuit, getNumero, getType, getPrixParNuit).

# Getters

public function getNumber() : int {
    return $this->number;
}
public function getType() : int {
    return $this->type;
}
public function getNightPrice() : int {
    return $this->nightPrice;
}

# Setters

public function setNumber() : int {
    return $this->number;
}
public function setType() : int {
    return $this->type;
}
public function setNightPrice() : int {
    return $this->nightPrice;
}



}




