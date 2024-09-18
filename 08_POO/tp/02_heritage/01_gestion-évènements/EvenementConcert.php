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

class EvenementConcert extends Evenement
{
  private Evenement $evenement;
  private string $artist;
  private array $publicConcert = [];


  public function __construct(Evenement $evenement, string $artist, array $publicConcert = [])
  {
    $this->evenement = $evenement;
    $this->artist = strtolower($artist);
    $this->publicConcert = $publicConcert;
  }


  public function displayEvntConcert()
  {
    echo 'Evènement Concert : ';
    echo '<br>';
    echo '<br>';
    echo 'Chanteur : ' . $this->artist . '<br>';
    echo 'Groupe : ' . $this->evenement->getTitre() . '<br>';
    echo 'A la date de : ' . $this->evenement->getDate() . '<br>';
    echo '<br>';
    echo 'Public : ';
    echo '<br>';
    echo '<div class="container">';
    echo '<pre>';
    echo '<br>';
    var_dump($this->publicConcert);
    echo '</pre>';
    echo '</div>';
    echo '<br><br>';
  }

  public function addPerson(string $nom)
  {
    $this->publicConcert[] = $nom;
  }

  # Getters

  public function getArtist()
  {
    return $this->artist;
  }


  # Setters

  public function setArtist($newValue)
  {
    return $this->artist = $newValue;
  }

}
