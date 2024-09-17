<?php

# Exercice :
// 1. Créez une classe BankAccount avec une propriété privée solde.
// 2. Ajoutez des méthodes publiques pour deposer un montant et retirer un montant pour modifier le solde du compte.
// 3. Ajoutez une méthode afficher le solde pour afficher le solde actuel.
// 4. Instanciez un objet BankAccount, déposez et retirez de l'argent, puis affichez le solde.

class BankAccount
{

  // Propriété privée pour stocker le solde

  // on ne met pas ici la valeur par défaut car ds le constructeur, c'est l'un ou l'autre
  // private float $solde = 0;

  private float $solde;


  # Constructeur pour initialiser le solde
  public function __construct(float $solde = 0)
  {
    $this->solde = $solde;
  }

  # Méthode pour déposer un montant sur le compte = action utilisateur
  public function add(float $amount)
  {
    if ($amount > 0) {
      $this->solde += $amount;
    } else {
      echo 'Veuillez saisir un montant positif';
    }
  }

  # Méthode pour retirer un montant du compte = action utilisateur
  public function less(float $amount)
  {
    if ($amount > 0 && $amount <= $this->solde) {
      $this->solde -= $amount;
    } else {
      echo "Fonds insuffisants pour retirer $amount €.<br>";
    }
  }

  public function displaySolde()
  {

    echo 'Solde actuel : ' . $this->solde . '€';
    // OU 
    echo '<br>';
    echo 'ou';
    echo '<br>';
    echo 'Solde actuel : ' . $this->getSolde() . '€';
  }

  # GETTERS = AFFICHAGE
  public function getSolde()
  {
    return $this->solde;
  }


  # SETTERS / Modifie ou initialise une valeur, ce n'est pas une action.
  // Plutôt orienté BDD (ici fait doublon avec Add et Less, ce sont des actions enclenchées par l'utlisateur)
  public function setSolde($newValue)
  {
    return $this->solde = $newValue;
  }
}
