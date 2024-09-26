<?php 

  class Moto implements Vehicule
  {
    public function demarrer()
    {
      echo "Démarer la moto";
    }
    public function accelerer($vitesse)
    {
      echo "La moto roule a {$vitesse} km/h;";
    }
    public function stopper()
    {
      echo "Arreter la moto";
    }

  }