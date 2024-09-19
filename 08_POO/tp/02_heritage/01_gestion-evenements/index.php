<?php 

require 'Evenement.php';
require 'EvenementConcert.php';
require 'EvenementConference.php';

# Exercice

/**
 * 1. Créez une classe `Evenement` avec des propriétés `titre`, `date`, et une méthode `afficherDetails()` qui affiche les détails de l'événement.
 * 2. Créez une classe `EvenementConcert` qui hérite de `Evenement` et ajoute une propriété `artiste`, et redéfinit `afficherDetails()` pour inclure le nom de l'artiste.
 * 3. Créez une classe `EvenementConference` qui hérite de `Evenement` et ajoute une propriété `orateur`, et redéfinit `afficherDetails()` pour inclure le nom de l'orateur.
 * 4. Implémentez une méthode `ajouterParticipant($nom)` dans chaque classe pour gérer la liste des participants.
 * 5. Instanciez des événements de type concert et conférence, affichez leurs détails et ajoutez des participants.
 * 
 * 
 */



 $evnmt1 = new Evenement('Coldplay', '22/12/2025');

 $evnmt2 = new Evenement('Babar', '01/01/2027');


 $evnmtConcert1 = new EvenementConcert($evnmt1,'Chris Martin');

 $evnmtConcert1->addPerson('Pierrete');
 $evnmtConcert1->addPerson('Tom');
 $evnmtConcert1->addPerson('Zoe');



 $evnmtConf1 = new EvenementConf($evnmt1 ,'Napoléon');

 $evnmtConf1->addPerson('Zorro');
 $evnmtConf1->addPerson('Goldorak');
 $evnmtConf1->addPerson('Candy');

echo 'detailsDisplay';
echo '<br>';
echo '<br>';
echo $evnmt1->detailsDisplay();
echo '<br>';
echo '<hr>';
echo 'detailsDisplay';
echo '<br>';
echo '<br>';
echo $evnmt2->detailsDisplay();
echo '<br>';
echo '<hr>';

echo 'displayEvntConcert + public';
echo '<br>';
echo '<br>';
echo $evnmtConcert1-> displayEvntConcert();
echo '<br>';
echo '<hr>';

echo 'displayEvenementConf + public';
echo '<br>';
echo '<br>';
echo $evnmtConf1-> displayEvenementConf();
echo '<br>';
echo '<hr>';

