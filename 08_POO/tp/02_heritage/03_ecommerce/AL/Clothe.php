<?php

# Exercice

/**
 * 
 * 1. Créez un catalogue de produits qui gère plusieurs catégories de produits avec des niveaux de stock.
 * 2. Utilisez l'héritage pour gérer les différents types de produits avec des propriétés spécifiques (par exemple, l'électronique a une garantie, les vêtements ont des tailles, etc.).
 * 3. Implémentez un système de notification automatique en cas de rupture de stock ou de promotion sur un produit.
 * 4. Intégrez plusieurs méthodes de paiement (carte bancaire, PayPal, etc.) avec des validations spécifiques à chaque type de paiement.
 * 5. Gérez les commandes avec différents statuts (validée, en attente, expédiée).
 * 
 * 
 * 
 */

class Clothe extends Item
{
  private Item $item;
  private string $taille;
  private int $qty;
  private string $color;
 

  public function __construct(Item $item, string $taille, int $qty, string $color)
  {
    $this->item = $item;
    $this->taille = $taille;
    $this->qty = $qty;
    $this->color = $color;
    }



  public function displayOrder(){
    echo '<div class="container">';
    echo '<pre>';
    echo '<br>';
    echo 'Article Commandé : ';
    echo $this->item->getLabel();
    echo '<br>';
    echo 'Qté Commandée : ';
    echo $this->getQty();
    echo '<br>';
    echo 'Prix : ';
    echo $this->item->getPrice();
    echo '<br>';
    echo 'Couleur : ';
    echo $this->color;
    echo '<br>';
    echo 'Taille : ';
    echo $this->taille;
    echo '</pre>';
    echo '</div>';
    echo '<br>';
    echo '<hr>';
  }


  # GETTERS



  public function getTaille(): string
  {
    return $this->taille;
  }

  public function getQty(): int
  {
    return $this->qty;
  }

  public function getColor(): string
  {
    return $this->color;
  }

  

  # SETTERS

  public function setTaille(string $taille): void
  {
    $this->taille = $taille;
  }

  public function setQty(int $qty): void
  {
    $this->qty = $qty;
  }

  public function setColor(string $color): void
  {
    $this->color = $color;
  }


}
