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

class StockAction extends Movement
{
    private Movement $movement;
    private int $qty;
    private float $price;

    public function __construct(Movement $movement, int $qty, float $price)
    {
        $this->movement = $movement;
        $this->qty = $qty;
        $this->price = $price;
    }


    # GETTERS

    public function getMovement(): Movement
    {
        return $this->movement;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getPrice(): float
    {
        return $this->price;
    }





    # SETTERS 

    public function setMovement(Movement $movement): void
    {
        $this->movement = $movement;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
