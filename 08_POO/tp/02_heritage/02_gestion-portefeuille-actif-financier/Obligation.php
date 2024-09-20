<?php

# Exercice

/**
 * 
 * 1. Créez un système de portefeuilles d'investissement où les utilisateurs peuvent détenir des types d'actifs variés.
 * 2. Implémentez des classes d'actifs comme Obligations et Obligations avec des comportements différents pour les gains et les pertes.
 * 3. Utilisez l'héritage pour définir des comportements communs (comme les dépôts et retraits) et des comportements spécifiques à chaque type d'actif.
 * 4. Implémentez un système de transactions financières pour transférer des fonds entre les portefeuilles des utilisateurs, avec des vérifications pour éviter des découvertes.
 * 
 * 
 * 
 */

class Obligation extends Actif
{
  private Actif $actif;
  private float $interest;


  public function __construct(Actif $actif, float $interest)
  {
    $this->actif = $actif;
    $this->interest = $interest;
  }

public function display(){
  echo 'Action :  ';
  echo '<br>';
  echo '<br>';
  echo 'Label : ' . $this->actif->getLabel() . '<br>';
  echo 'Qty : ' . $this->actif->getQty() . '<br>';
  echo 'Price : ' . $this->actif->getPrice() . '<br>';
  // echo 'Taux Intérêt : ' . $this->interest->getInterest() . '<br>';
  echo '<br>';
  echo '<br>';
  echo '<div class="container">';
  echo '<pre>';
  echo '<br>';
  // var_dump($this->obligation);
  echo '</pre>';
  echo '</div>';
  echo '<br><br>';

}


  # GETTERS


  public function getInterest(): float
  {
    return $this->interest;
  }


  # SETTERS 
 
  public function setInterest(float $interest): void
  {
    $this->interest = $interest;
  }
}
