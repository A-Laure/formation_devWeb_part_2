<?php

require 'functions/_helpers/tools.php';
# Attention l'ordre d'appel est important on appelle toujours la class Mere/Parent en premier
require 'class/Cellphone.php';
require 'class/Android.php';
require 'class/Ios.php';


// $cellphone = new Cellphone();
// $cellphone->turnOn();


$android = new Android();
$android->unlock();

echo '<br>';
echo '<br>';

$ios = new Ios();
$ios->unlock();


// debug($parrot);