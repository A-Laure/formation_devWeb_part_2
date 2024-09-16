<?php



/* ---- DAMIEN ------ */

/**  POUR DOC
 *
* @param string $text
* @return string 
*
*/

declare(strict_types=1); // pour activer le typage

function countVowels1(string $text) : int { // : string est le typage du retour, on peut mettre 2 typage string|int, au delà on met mixed  ou ?string, le null safety, pas obligé de lui renseigner ce paramètre là

  $vowels1 = ['a','e','i','o','u','é','è','à','ê','â','ù','û', 'ô'];
  $vowelsCount = 0;

  for($i = 0; $i < mb_strlen($text); $i++) {

    if(in_array(strtolower($text[$i]), $vowels1)){

      $vowelsCount ++;
    }
  }
  return $vowelsCount;
}

$text1 = "Bonjour Anne-Laure";
$text2 = "Le chat est mort ce soir";

$result1 =countVowels1($text1);
$result2 =countVowels1($text2);

echo "Le nombre de voyelles dans '$text1' est de : $result1 \n ";
echo "Le nombre de voyelles dans '$text2' est de : $result2 \n ";


/* ---------- MOI ------------- */

function countVowels($string){
	$vowels = array('a','e','i','o','u','y');

$count = 0;

for ($i=0; $i < strlen($string); $i++){ // strlen compte le nombre d'octet (pas de caractère)
	if(in_array(strtolower($string[$i]), $vowels)){ // strtolower : converti en minuscule
		$count++;
	}
}
	echo "Le mot $string comporte $count voyelles.";
}

$string = readline("Taper un mot : ");

echo countVowels($string);
?>