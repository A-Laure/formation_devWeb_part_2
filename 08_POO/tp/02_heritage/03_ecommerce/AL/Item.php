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

class Item
{

  private string $label;
  private int $StockQty;
  private float $price;



  public function __construct(string $label, int $stockQty, float $price,)
  {
    $this->label = $label;
    $this->StockQty = $stockQty;
    $this->price = $price;
  }

  

  public function itemOrder($order)
  {
    // foreach ()
    // if($order['label'] === Item['label'] && $stockQty<= $order['qty']){
    //   $stockQty -= $order['qty'];
    //   return  $stockQty;
    // }
    // $this->item[] -= $data;
  }

  public function displayItem()
  {
    echo '<div class="container">';
    echo '<pre>';
    echo '<br>';
    echo 'Article : ';
    echo '<br>';
    echo 'Modèle : ';
    echo $this->getLabel();
    echo '<br>';
    echo 'Qté en stock : ';
    echo $this->getStockQty();
    echo '<br>';
    echo 'Prix : ';
    echo $this->getPrice();
    echo '</pre>';
    echo '</div>';
    echo '<br>';
    echo '<hr>';
  }

  # GETTERS

  public function getLabel(): string
  {
    return $this->label;
  }

  public function getStockQty(): int
  {
    return $this->StockQty;
  }

  public function getPrice(): float
  {
    return $this->price;
  }


  # SETTERS

  public function setLabel(string $label): void
  {
    $this->label = $label;
  }

  public function setStockQty(int $StockQty): void
  {
    $this->StockQty = $StockQty;
  }

  public function setPrice(float $price): void
  {
    $this->price = $price;
  }
}
