<?php

# Exercice

/**
 * 
 * 1. Créez un système de portefeuilles d'investissement où les utilisateurs peuvent détenir des types d'actifs variés.
 * 2. Implémentez des classes d'actifs comme Actions et Obligations avec des comportements différents pour les gains et les pertes.
 * 3. Utilisez l'héritage pour définir des comportements communs (comme les dépôts et retraits) et des comportements spécifiques à chaque type d'actif.
 * 4. Implémentez un système de transactions financières pour transférer des fonds entre les portefeuilles des utilisateurs, avec des vérifications pour éviter des découvertes.
 * 
 * 
 * 
 */

class Actif
{


  # Propriétés de la classe
  private string $label;
  private int $qty;
  private float $price;
  private array $actif;


  public function __construct(string $label, int $qty, float $price, array $actif)
  {
    $this->label = $label;
    $this->qty = $qty;
    $this->price = $price;
    $this->actif = $actif;
  }



  # Méthodes

  public function addActif(array $stockOption)
  {
    $this->actif[] = $stockOption;
  }


  # GETTERS

  public function getLabel(): string
  {
    return $this->label;
  }

  public function getQty(): int
  {
    return $this->qty;
  }

  public function getPrice(): float
  {
    return $this->price;
  }

  public function getActif(): array
  {
    return $this->actif;
  }


  # SETTERS

  public function setLabel(string $label): void
  {
    $this->label = $label;
  }

  public function setQty(int $qty): void
  {
    $this->qty = $qty;
  }

  public function setPrice(float $price): void
  {
    $this->price = $price;
  }

  public function setActif(array $actif): void
  {
    $this->actif = $actif;
  }
}
