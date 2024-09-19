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

class Portfolio
{

    # Propriétés de la classe
    private array $portfolio;

    

    public function __construct(array $portfolio = [])
    {
        $this->portfolio = $portfolio;
    }



    
    # GETTERS

    public function getPortfolio(): array
    {
        return $this->portfolio;
    }



    # SETTERS

    public function setPortfolio(array $portfolio): void
    {
        $this->portfolio = $portfolio;
    }
}
