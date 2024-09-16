<?php
declare(strict_types=1); // pour activer le typage
/*
Créez une fonction qui prend une chaîne de caractères en tant que paramètre et supprime les
voyelles d’une chaîne de caractères puis renvoie la chaîne modifiée.
(pensez à regarder la doc PHP une ou plusieurs fonction(s) pourrait vous servir
*/

/* ----- FACON DAMIEN QUI SERVIRA ----- */


/* ---- DAMIEN ------ */

function deleteVowels(string $text) : string { // : string est le typage du retour
  $vowels1 = ['a','e','i','o','u','é','è','à','ê','â','ù','û', 'ô'];
  $result = '';

  for($i = 0; $i< mb_strlen($text); $i++){ // strlen attention les accents comptent 2 caractères, du coup on met mb devant
    
    if(!in_array(strtolower($text[$i]), $vowels1)){   // le ! : tout ce qui est après, comprend le à l'inverse, si lettre pas ds vowels alors tu rentres dans la condition. si ce n'est pas une voyelle....
    // echo "$text[$i] n'est pas une voyelle" . PHP_EOL;  // car on a mis le "!" sinon "est pas une voyelle"
    // $result = $result.$text[$i];
    $result .= "$text[$i]";
  // }else{
  //   // echo "$text[$i] est une consonne" . PHP_EOL;
  // }
}
}
return $result;
}

$text = 'Bonjour Anne-Laure';

echo deleteVowels($text);


/* ---- MOI -----*/

function supVoy($string){

	$vowels = ['a','e','i','o','u','é','è','à','ê','â','ù','û', 'ô'];

  return	strtolower(str_replace($vowels,"", $string));
}

$string = readline("Saisissez un mot avec des voyelles et des consonnes : ");
echo supVoy($string);

?>