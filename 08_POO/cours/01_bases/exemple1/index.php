<?php 

  class Nain {

    # mots clés 
    # public : accessible depuis la classe elle meme ainsi que dans les classes dérivées et à travers les intances de classe
    # private : accessible uniquement depuis la classe elle meme
    # protected : accessible uniquement depuis la classe elle meme ainsi que dans les classes dérivées

    # Proprietés (équivaut aux variables en procédural)
    public string $name;
    public int $beard;

    public function __construct($name, $beard) {
      $this->name = $name;
      $this->beard = $beard;
    }

    public function greeting(){
      return "Bonjour $this->name";
    }

  }

  $gurdil = new Nain('Gurdil', 120);
  $gimly = new Nain('gimly', 300);

  echo $gurdil->greeting();
  echo $gimly->greeting();