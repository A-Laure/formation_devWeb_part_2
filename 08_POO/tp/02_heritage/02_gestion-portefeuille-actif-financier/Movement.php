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

class Movement
{


    # Propriétés de la classe
    private int $deposit;
    private int $withdrawal;


    public function __construct(int $deposit, int $withdrawal)
    {
        $this->deposit = $deposit;
        $this->withdrawal = $withdrawal;
    }


    # Méthodes




    # GETTERS

    public function getDeposit(): int
    {
        return $this->deposit;
    }

    public function getWithdrawal(): int
    {
        return $this->withdrawal;
    }

    # SETTERS

    public function setDeposit(int $deposit): void
    {
        $this->deposit = $deposit;
    }

    public function setWithdrawal(int $withdrawal): void
    {
        $this->withdrawal = $withdrawal;
    }
}
