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

class Electronc extends Item
{
  private Item $item;
  private int $warranty;

  public function __construct(Item $item, int $warranty)
  {
    $this->item = $item;
    $this->warranty = $warranty;
  }




  # GETTERS

  

  public function getWarranty(): int
  {
    return $this->warranty;
  }




  # SETTERS


  public function setWarranty(int $warranty): void
  {
    $this->warranty = $warranty;
  }
}
