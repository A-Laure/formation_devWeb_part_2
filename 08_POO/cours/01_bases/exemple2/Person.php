<?php

  # Déclaration d'une classe nommée Person
  class Person {

    # Déclaration des données via les propriétés ( équivaut aux variables en procédural)
    # Chaque instance(objet que l'on va créer) de Person en possédera un copie
    
    # Ces mots clés définissent la portée des proprietes et des méthodes 
    # public : accessible depuis la classe elle meme ainsi que dans les classes dérivées et à travers les intances de classe
    # private : accessible uniquement depuis la classe elle meme
    # protected : accessible uniquement depuis la classe elle meme ainsi que dans les classes dérivées

    private string $name;
    private int $age;
    private string $sex;
    private string $nationality;

    # Méthodes magiques
    # Constructeur : méthode magique que se lance automatiquement lors de la création d'un objet (instanciation). Elle est chargée d'initialiser l'objet.
    public function __construct(string $name, int $age, string $sex, string $nationality){
      $this->name = $name;
      $this->age = $age;
      $this->sex = $sex;
      $this->nationality = $nationality;
    }

    # Destructeur : méthode magique que se lance automatiquement lors de la destruction d'un objet. Elle est chargée de libérer les ressources (espace mémoire) ou lancer une ou des actions finales avant que l'objet ne soit supprimé.
    public function __destruct()
    {
      echo 'Fin de vie pour '. $this->name;
      echo '<br>';
    }


    # Méthodes de Person 
    # Ce sont des actions disponibles pour chaque instance (objet de Person). Leur nom contient presque toujours un verbe

    public function speak(){
      switch($this->nationality){
        case 'fr':
          echo 'Bonjour';
          break;
        case 'es':
          echo 'Hola';
          break;
        case 'it':
          echo 'Ma qué';
          break;
        default:
          echo 'Hello';
          break;
      }
    }



    public function growOld(){
      $this->age++;
      echo $this->age;
    }




    # GETTERS & SETTERS

    # Méthodes qui permettent de lire/recupérer les données (les données enregistrées dans les propriétés par les setters).
    # Les getters (ou accesseurs) sont généralement de la forme getNomDonnee()
    public function getName(){
      return $this->name;
    }
    public function getAge(){
      return $this->age;
    }
    public function getSex(){
      return $this->sex;
    }
    public function getNationality(){
      return $this->nationality;
    }


    # Méthodes qui permettent de modifier les données.
    # Les setters (ou mutateurs) sont généralement de la forme setNomDonnee($nouvelleValeur)
    public function setName($value){
      $this->name = $value;
    }

    public function setAge($value){
      $this->age = $value;
    }

    public function setSexe($value){
      $this->sex = $value;
    }

    public function setNationality($value){
      $this->nationality = $value;
    }

  }
