<?php 

require 'Voiture.php';
require 'Parking.php';

$voit1 = new Car('10 RG 34', 'Renault', 'Red');

$voit2 = new Car('3265 XY 48', 'Peugeot', 'Green');

echo 'detailsDisplay';
echo '<br>';
echo '<br>';
echo $voit1->detailsDisplay();
echo '<br>';
echo '<hr>';
echo 'detailsDisplay';
echo '<br>';
echo '<br>';
echo $voit2->detailsDisplay();
echo '<br>';
echo '<hr>';

$parking = new Park();

$parking->addCar($voit1);
$parking->addCar($voit2);

$parking-> displayParking();
echo '<hr>';

$parking-> searchCar('3265 XY 48');
echo '<hr>';

$parking-> deleteCar('3265 XY 48');
echo '<hr>';

