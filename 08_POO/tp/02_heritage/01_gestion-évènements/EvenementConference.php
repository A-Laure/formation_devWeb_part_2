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

class EvenementConf extends Evenement
{
  private Evenement $evenement;
  private string $orateur;
  private array $publicConference;

  public function __construct(Evenement $evenement, string $orateur, array $publicConference = [])
  {
    $this->evenement = $evenement;
    $this->orateur = strtolower($orateur);
    $this->publicConference = $publicConference;
  }

  public function displayEvenementConf()
  {
    echo 'Evènement Conférence : ';
    echo '<br>';
    echo '<br>';
    echo 'Concert de : ' . $this->evenement->getTitre() . '<br>';
    echo 'A la date de : ' . $this->evenement->getDate() . '<br>';
    echo 'Orateur : ' . $this->orateur . '<br>';
    echo '<br>';
    echo 'Public : ';
    echo '<br>';
    echo '<div class="container">';
    echo '<pre>';
    echo '<br>';
    var_dump($this->publicConference);
    echo '</pre>';
    echo '</div>';
    echo '<br><br>';
  }

  public function addPerson(string $nom)
  {
    $this->publicConference[] = $nom;
  }

  # Getters

  public function getOrateur()
  {
    return $this->orateur;
  }



  # Setters

  public function setOrateur($newValue)
  {
    return $this->orateur = $newValue;;
  }
}
