<?php

// date() ->  formate un horodatage / attention ne gère pasles fuseaux horaires

// date('y') - récupère l'année
$date = date('y');
echo $date . PHP_EOL; // donne 24


// ddate('y', strtotime('1998-08-12')) - récupère l'année 
$date = date('y', strtotime('1998-08-12')); // donne 98
echo $date . PHP_EOL; // donne 24

// marche aussi pour m and co


// date('m') - récupère le mois, donne le chiffre
$date = date('m');
echo $date . PHP_EOL; // donne 06 pour juin


// date('M') - récupère le mois, donne les 1ères lettres
$date = date('M');
echo $date . PHP_EOL; // donne jun pour june


// date('F') - récupère le mois en entier
$date = date('F');
echo $date . PHP_EOL; // donne june pour june


// date('d') - récupère le jour en chiffre
$date = date('d');
echo $date . PHP_EOL; // donne 14 (car 14 juin jour exo)


// date('D') - récupère le jour en 3 lettres
$date = date('D');
echo $date . PHP_EOL; // donne fri pour friday


// date('i') - récupère les minutes
$date = date('i');
echo $date . PHP_EOL; // donne 


// date('s') - récupère secondes
$date = date('s');
echo $date . PHP_EOL; // donne 


// date('d-m-Y h:i:s') - récupère 14-06-2024 02:36:39
$date = date('d-m-Y h:i:s');
echo $date . PHP_EOL; // donne 





?>