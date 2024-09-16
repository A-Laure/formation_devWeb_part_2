<?php

/*
Écrire un programme qui demande un nombre compris entre 10 et 20, jusqu'à ce que la
réponse convienne. En cas de réponse supérieur à 20 affiche plus petit et en cas de réponse
inférieur à 10 affiche plus grand
*/

$num = (int) readline("Entrez un chiffre en 10 et 20 :");


if($num < 10)
{
  Echo "Votre chiffre est trop petit" . PHP_EOL;
}
elseif($num>20)
{
  Echo "Votre chiffre est trop grand" . PHP_EOL;
}
?>
