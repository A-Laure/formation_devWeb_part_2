<?php 

  class Voiture implements Vehicule, Volant
  {
    public function demarrer()
    {
      echo "Démarer la voiture";
    }
    public function accelerer($vitesse)
    {
      echo "La voiture roule a {$vitesse} km/h;";
    }
    public function stopper()
    {
      echo "Arreter la voiture";
    }
    public function tournerVolant()
    {
      echo "tourner le volant";
    }
  }