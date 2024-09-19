<?php

require 'functions/_helpers/tools.php';
# Attention l'ordre d'appel est important on appel toujours la class Mere/Parent en premier
require 'class/Animal.php';
require 'class/Dog.php';
require 'class/Cat.php';
require 'class/Bird.php';
require 'class/Parrot.php';




// $animal = new Animal('toto', 14, 'test', 52.3);

// debug($animal);

// $dog = new Dog('Stark', 3, 'cane corso', 65, 'Bringé');
// debug($dog);

// echo $dog->getName();
// echo '<br>';
// echo $dog->eat();
// echo '<br>';
// $dog->growOld();
// echo $dog->getAge();
// echo '<br>';
// echo $dog->eat();

// $cat = new Cat('Thrall', 2, 'faux maine coon', 8, 'Gris tigré');
// debug($cat);

// echo $cat->getName();
// echo '<br>';
// echo $cat->eat();
// echo '<br>';
// $cat->growOld();
// echo $cat->getAge();
// echo '<br>';
// echo $cat->eat();


$parrot = new Parrot('Coco', 2, 'Ara', 2, 'rouge');


echo $parrot->getName();
echo '<br>';
$parrot->growOld();
echo $parrot->getAge();
echo '<br>';
echo $parrot->eat();

$parrot->learnWord('cacahuete!');
$parrot->learnWord('pistache!');
$parrot->learnWord('pistache!');

debug($parrot);