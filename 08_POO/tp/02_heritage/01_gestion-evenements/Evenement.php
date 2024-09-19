<?php

# Exercice

/**
 * 1. Créez une classe `Evenement` avec des propriétés `titre`, `date`, et une méthode `afficherDetails()` qui affiche les détails de l'événement.
 * 2. Créez une classe `EvenementConcert` qui hérite de `Evenement` et ajoute une propriété `artiste`, et redéfinit `afficherDetails()` pour inclure le nom de l'artiste.
 * 3. Créez une classe `EvenementConference` qui hérite de `Evenement` et ajoute une propriété `orateur`, et redéfinit `afficherDetails()` pour inclure le nom de l'orateur.
 * 4. Implémentez une méthode `ajouterParticipant($nom)` dans chaque classe pour gérer la liste des participants.
 * 5. Instanciez des événements de type concert et conférence, affichez leurs détails et ajoutez des participants.
 * 
 * 
 */

// 1 classe peut avoir une infinité d'enfant
// 1 enfant hérite des propriétés et des méthodes de la mère
// les methodes de l'enfant (si même nom) sont prioritaires
class Evenement
{

  // Propriété privée pour stocker
  //seul le getX dans l'enfant permettra de l'appeler
  // si on veut l'appeller dans l'enfant par $this-> name, il faut mettre la propriété en protected
  private string $titre;
  private string $date;


  public function __construct(string $titre, string $date)
  {
    $this->titre = trim(strtolower($titre));
    $this->date = $date;
  }


  public function detailsDisplay()
  {
    return 'L évènement : ' .  $this->titre .    ' aura lieu le ' . $this->date;
  }


  # Getters

  public function getTitre()
  {
    return $this->titre;
  }

  public function getDate()
  {
    return $this->date;
  }

  # Setters

  public function setTitre($newValue)
  {
    return $this->titre = $newValue;
  }

  public function setDate($newValue)
  {
    return $this->date = $newValue;;
  }
}
