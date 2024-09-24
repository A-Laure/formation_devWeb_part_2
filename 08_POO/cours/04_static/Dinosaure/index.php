<?php

require 'functions/_helpers/tools.php';
# Attention l'ordre d'appel est important on appelle toujours la class Mere/Parent en premier
require 'class/Dino.php';
require 'class/Trex.php';

$dino = new Dino();
$dino->getType();


Trex::getTooth();


// debug($parrot);