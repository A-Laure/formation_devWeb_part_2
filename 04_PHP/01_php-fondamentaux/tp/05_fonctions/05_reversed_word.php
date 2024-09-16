<?php
/*
Créez une fonction qui prend une chaîne de caractères en tant que paramètre et renvoie la
chaîne avec l'ordre des mots inversés. Chaque mot dans la chaîne doit rester inchangé, mais
l'ordre des mots doit être inversé. Testez la fonction avec différentes chaînes de caractères.
(pensez à regarder la doc PHP une ou plusieurs fonction(s) pourrait vous servir)
*/

/* ----DAMIEN ------ */
declare(strict_types=1); // pour activer le typage

function invertedWord(string $text) : string{

  // sépare les mots en utilisant l'espace comme délimiteur
  $words = explode(" ",$text); // marche pour chaîne de caractères et tableaux

  $invertedWords = array_reverse($words);

return implode(' ', $invertedWords);
}

$text1 = "Salut Tom";
$text2 = "La programmation c'est génial";

echo "'$text1' inversé"  . " " . invertedWord($text1) .PHP_EOL;
echo "'$text2'  inversé" . " " . invertedWord($text2) .PHP_EOL;

/* ----- MOI ------ */

function reverseWord($sentence)
{

  $delimiters = " \n\t";
  $list = [];

  $wordByWord = strtok($sentence, $delimiters); // Coupe une chaîne en segments
  print_r($wordByWord);
  $list[] = $wordByWord;

  while ($wordByWord !== false) {
    echo "Word = $wordByWord\n";
    $wordByWord = strtok($delimiters);
    $list[] = $wordByWord;
  };

  print_r($list);
  $count = count($list);
  echo "Il y a $count mots dans la phrase." . PHP_EOL;

  for ($i = $count - 1; $i >= 0; $i--) {
    echo $list[$i] . ' ';
  };
}

$sentence = readline("Saisissez une phrase : ");

echo reverseWord($sentence);
