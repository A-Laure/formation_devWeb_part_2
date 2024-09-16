<?php

// DATA SOURCE NAME (DSN) / après root c'est le pwd (nous on en n'a pas)
$pdo = new PDO('mysql:host=127.0.0.1;	dbname=entreprise;	charset=utf8',	'root',	'');
// OU
$pdo = new PDO('mysql:host=localhost;	dbname=entreprise;	charset=utf8',	'root',	'');
$userName = 'root';
$passWord = '';
// Pour MAc
$passWord = 'root'; 


// VOIR PDO1.php pour commentaires 

// ---------- AVEC SELECT ----------------

// ----- METHOD fetchAll() :  récupère plusieurs résultats

try {
	$pdo = new PDO($dsn, $userName,$passWord,[PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);

	$query = "SELECT * FROM employe WHERE idEmploye";
	// autre
	//$stmt = $pdo->query($query); // pas besoin du execute, le fait directement mais ne vérifie rien ce que fait prepare

	$stmt = $pdo->prepare($query); 
 	$stmt->execute(); 

	// on veut stocker resultat de la requête ci-dessus
	//$result = $stmt-> fetchAll(PDO::FETCH_BOTH);  => donne tab par nom col + index et index et data dc 2 lignes par id
	$result = $stmt-> fetchAll(PDO::FETCH_ASSOC); //=> renvoi un tableau associatif 
	// le PDO::FETCH_ASSOC peut être mis dans les options en mettant PDO::ATTR_DEFAULT_FETCH_MODE
	echo '<pre>'; 
	print_r($results);
	echo '<pre>';

} catch (PDOException $e) {
	echo 'Connexion échouée : ' .$e-> getMessage();		 
}



// ----- METHOD fetch() :  RECUP 1 SEUL RESULTAT A LA FOIS

try {
	$pdo = new PDO($dsn, $userName,$passWord,[PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);

	$query = "SELECT * FROM employe WHERE idEmploye = 6";
	// autre
	//$stmt = $pdo->query($query); // pas besoin du execute, le fait directement mais ne vérifie rien ce que fait prepare

	$stmt = $pdo->prepare($query); 
 	$stmt->execute(); 

	// on veut stocker resultat de la requête ci-dessus
	//$result = $stmt-> fetchAll(PDO::FETCH_BOTH);  => donne tab par nom col + index et index et data dc 2 lignes par id
	$result = $stmt-> fetch(PDO::FETCH_ASSOC); //=> renvoi un tableau associatif 
	// le PDO::FETCH_ASSOC peut être mis dans les options en mettant PDO::ATTR_DEFAULT_FETCH_MODE
	echo '<pre>'; 
	print_r($results);
	echo '<pre>';

} catch (PDOException $e) {
	echo 'Connexion échouée : ' .$e-> getMessage();		 
}


