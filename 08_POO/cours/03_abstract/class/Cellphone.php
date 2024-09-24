<?php 

# abstract de class : interdit l'instanciation de la classe
abstract class Cellphone
{
  
  # abstract de methode : on crée une methode sans sa logique (on la nomme) et oblige que cette méthode soit définie dans toutes les classes enfants/dérivées
  abstract public function unlock();

  # par default ce sera en public si on ne précise pas la portée 
  function turnOn()
  {
    echo 'Hold power button ...';
  }

}