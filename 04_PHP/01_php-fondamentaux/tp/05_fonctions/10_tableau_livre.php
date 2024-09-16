<?php

/*
Créez un tableau de la structure suivante :
Remplissez un tableau de 6 livres.
Écrivez un programme qui permet de filtrer les livres en fonction de l’auteur demandé parl’utilisateur
*/
declare(strict_types=1); // pour activer le typage


$books = [
  [
    'name' => 'Tom',
    'author' => 'nom de l auteur1',
    'releaseYear' => 2023,
    'purchaseUrl' => 'http://exemple.com',
  ],
  [
    'name' => 'Sam',
    'author' => 'nom de l auteur2',
    'releaseYear' => 2023,
    'purchaseUrl' => 'http://exemple.com',
  ],
  [
    'name' => 'John',
    'author' => 'nom de l auteur3',
    'releaseYear' => 2023,
    'purchaseUrl' => 'http://exemple.com',
  ],
  [
    'name' => 'Jane',
    'author' => 'nom de l auteur4',
    'releaseYear' => 2023,
    'purchaseUrl' => 'http://exemple.com',
  ],
  [
    'name' => 'Paul',
    'author' => 'nom de l auteur5',
    'releaseYear' => 2023,
    'purchaseUrl' => 'http://exemple.com',
  ],
  [
    'name' => 'jim',
    'author' => 'nom de l auteur6',
    'releaseYear' => 2023,
    'purchaseUrl' => 'http://exemple.com',
  ]
];


// ----------- DAMIEN ------ //

function displayBooks(array $books){

  // 1ère boucle pour parcourir chaque livre
  foreach($books as $index => $book){  // on a déjà l'index ds le tableau dc pas la peine de faire un $i
    echo "Livre n°" .  $index+1 . PHP_EOL;
    // 2ème boucle pour afficher info du livre
    foreach ($book as $key => $value){ 

        echo ' - ' . $key . ' - ' . $value . PHP_EOL;
    } 
    // on saute une ligne entre chaque livre

    echo PHP_EOL;
  }
}

displayBooks($books);


function sortAuthor(array $books, string $auteur) : array{

$filteredBooks = [];

  foreach($books as $book){

    if(($book['author'] === $auteur) === strtolower($auteur)){ // type et contenu vérifié qd ===
    $filteredBooks[] = $book;
    }
  }

return $filteredBooks;

}

$userInput = 'nom de l auteur6';
$filteredBooks = sortAuthor($books, $userInput);

displayBooks($filteredBooks);



// ----------- MOI ------ //

function tri($books, $inputUser)
{

  foreach ($books as $datas) {

    if ($datas['name'] === $inputUser) {
      return $datas;
    } else {
      return "error";
    }
  }
}

$inputUser = readline("Choisissez un author : ");

print_r(tri($books, $inputUser));
