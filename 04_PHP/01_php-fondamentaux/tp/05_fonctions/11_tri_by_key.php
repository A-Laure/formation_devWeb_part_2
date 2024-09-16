<?php

declare(strict_types=1); // pour activer le typage

/*
Créez un tableau de la structure suivante :
$movies = [
[
'title': 'titre du film',
'year': 1994,
'actors': ['acteur1', 'acteur2']
],
];
Écrivez un programme qui permet de filtrer les films en fonction de leur année de sortie.
( vous devez faire 2 fonctions une qui tri avant 2000 et une après 2000
*/

$movies = [
  [
    'title' => 'ALien',
    'year' => 1994,
    'actors' => ['acteur1', 'acteur2']
  ],
  [
    'title' => 'Terminator',
    'year' => 2001,
    'actors' => ['acteur1', 'acteur2']
  ],
  [
    'title' => 'ET',
    'year' => 2002,
    'actors' => ['acteur1', 'acteur2']
  ],
  [
    'title' => 'Grease',
    'year' => 1972,
    'actors' => ['acteur1', 'acteur2']
  ],
  [
    'title' => 'Candy',
    'year' => 2000,
    'actors' => ['acteur1', 'acteur2']
  ],
];



/* ------ DAMIEN ------ */

function displayMovies(array $movies, $year){

  // 1ère boucle pour parcourir chaque livre
  foreach($movies as $index => $movie){  // on a déjà l'index ds le tableau dc pas la peine de faire un $i
    echo "Movie n°" . $movie['title'] . ' ' . $movie['year'] .PHP_EOL;
    // 2ème boucle pour afficher info du livre
    foreach ($movie['actors'] as $actor){ 

        echo ' - ' . $actor . PHP_EOL;
    } 
    // on saute une ligne entre chaque livre

    echo PHP_EOL;
  }
}

function filterByOld(array $movies, int $year) : array{
$oldMovies = [];

foreach($movies as $movie){
  if ($movie['year'] < $year){
    $oldMovies[] = $movie;
  }
}
return $oldMovies;
}

$oldMovies = filterByOld($movies, $year);


function filterRecent(array $movies, int $year) : array{
$recentMovies = [];

foreach($movies as $movie){
  if ($movie['year'] > $year){
    $oldMovies[] = $movie;
  }
}
return $oldMovies;
}

$userInput = readline('Choisissez une année :');

$oldMovies = filterByOld($movies, $year);
$recent = filterRecent($movies, $year);

echo "Films avant les années $userInput: \n";
echo "Films zprès les années $userInput: \n";

displayMovies($movies, $userInput);
displayMovies($oldMovies, $userInput);
displayMovies($recent, $userInput);




/* ------ MOI ------ */

function tri2001($movies)
{
  // echo "Log 1" . PHP_EOL;

  foreach ($movies as $value) {
    echo "Log 2" . PHP_EOL;

    if ($value['year'] >= 2000) {
      $tab[] =  $value;

      // return arrête le script et renvoi la valeur
    }
  }

  return $tab;
}

print_r(tri2001($movies));




function tri1999($movies)
{


  foreach ($movies as $value) {


    if ($value['year'] < 2000) {
      $tab[] =  $value;

      // return arrête le script et renvoi la valeur
    }
  }

  return $tab;
}

print_r(tri1999($movies));
