<?php 

interface Vehicule 
{
  public function demarrer();
  public function accelerer($vitesse);
  public function stopper();
}