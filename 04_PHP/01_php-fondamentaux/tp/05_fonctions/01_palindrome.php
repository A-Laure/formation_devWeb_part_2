

<?php

/*
Créer une fonction qui vérifie si une chaîne de caractères est un palindrome
*/

// ---------- MOI -----------//
echo "SOL MOI" . PHP_EOL;
echo PHP_EOL;

function palindrome($word){
	$word = strtolower($word); // au cas où user tape des maj
  $word = trim($word); 
	// enlève des espaces ou caractères ou nouvelles lignes qui auraient pu s'ajouter
	$testWord = strrev($word);

if ($testWord != $word){ 
	return "$word n'est pas un palindrome";
	
}else{
	return "$word est un palindrome";
}
};

$word = readline("Entrer un mot : ") ;
echo palindrome($word);





?>