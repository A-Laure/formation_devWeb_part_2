<?php

/*
Classe  existante que l'on modifie et utilise
BDD Entreprise

Connexion à MySql :
$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
data base handle (dbh)
*/

/* 
le fait de mettre new devant est "creation d'une instance de classe" => on crée un objet de la classe, on va en créer autant que l'on veut
ex : une appli qui se connecte à 2 bdd 
Constructeur = méthode qui s'éxecute au moment de l'instanciation de la classe, il attend des paramètres :
- le dsn : 'mysql:host=localhost;dbname=test;charset=utf8''
- nos variables
*/

// DATA SOURCE NAME (DSN) / après root c'est le pwd (nous on en n'a pas)
$pdo = new PDO('mysql:host=127.0.0.1;	dbname=entreprise;	charset=utf8',	'root',	'');
// OU
$pdo = new PDO('mysql:host=localhost;	dbname=entreprise;	charset=utf8',	'root',	'');
$userName = 'root';
$passWord = '';
// Pour MAc
$passWord = 'root'; 


// connexion sans gestion d'erreur (attention si erreur cela affiche en clais les infos de connexion de la BDD)

// correct
$pdo = new PDO('mysql:host=localhost;	dbname=entreprise;	charset=utf8',	'root',	'');
// avec erreur (manque le r dans entreprise)
$pdo = new PDO('mysql:host=localhost;	dbname=enteprise;	charset=utf8',	'root',	'');


// --------- AFFICHAGE DES ERREURS liées à la connexion  ------

// "essaye et si ne marche pas, attrape l'erreur et renvoie moi l'info, le bon message selon erreur"


// Pour version antérieure PHP 8 on active erreur de code et requête avec l'option [PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION] (sur dernière version -PHP 8- plus la peine de le mettre), conseillé de le mettre par défaut

	try {
    $pdo = new PDO($dsn, $userName,$passWord,[PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);
		echo 'Connexion réussie';

} catch (PDOException $e) {
		echo 'Connexion échouée : ' .$e-> getMessage();
		  //getMessage, on récupère le message d'erreur en clair
}



//------------------ON A DC REUSSI A SE CONNECTER A LA BDD ..... ----------


//---------- AVEC REQUETE D'INSERTION SIMPLE, INFO EN DUR ------

	try {
    $pdo = new PDO($dsn, $userName,$passWord,[PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);

 //default pour l'id qui est généré
 $pdo->prepare("INSERT INTO employe VALUES(DEFAULT,3 , 'Tarzan', 'Bob', 'M', 3200, '2024-08-08' )");

 //----- OU ----------

// on peut stocker dans une variable
		$query = "INSERT INTO employe VALUES(DEFAULT,3 , 'Tarzan', 'Bob', 'M', 3200, '2024-08-08' )";

//	$statement, $stmt, $request  les différents noms que l'on peut voir
// 		On peut découper, on prépare la requête ...
		$stmt = $pdo->prepare($query);
		$stmt->execute();

// ----- OU direct MAIS.... dc plutôt séparer----------

		$pdo->prepare($query)->execute(); // nous renvoie un objet	


} catch (PDOException $e) {
		echo 'Connexion échouée : ' .$e-> getMessage();		 
}




// ----------INSERTION AVEC DES MARQUEURS  ------------
// Nous on va récup les infos pas en dur comme ci-desssus mais via un formulaire et des marqueurss


// ---------MARQUEUR "?" ------------

try {
	$pdo = new PDO($dsn, $userName,$passWord,[PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);

	//jeu de données qui arrivera de mon $POST du formulaire
$employe =[
	'idService' => 2,
	'nom' => 'Tarzan',
	'prenom' => 'Bob',
	'sexe' => 'M',
	'salaire' => 2400,
	'dateContrat' => '2024-08-08'
];

// on peut stocker dans une variable // autant de ? que de marqueur
	$query = "INSERT INTO employe (idService, nom, prenom, sexe, salaire, dateContrat) VALUES(?,?,?,?,?,?)";

	$stmt = $pdo->prepare($query);

 	//pour chaque "?" on lui attribue sa valeur, on peut typer la valeur (1,2 etc...) que l'on passe : PDO::PARAM_INT => force en INT
 	//si typage déjà fait en amont pas besoin
 $stmt->bindValue(1, $employe['idService'], PDO::PARAM_INT);
 $stmt->bindValue(2, $employe['nom'], PDO::PARAM_STR);
 $stmt->bindValue(3, $employe['prenom'], PDO::PARAM_STR);
 $stmt->bindValue(4, $employe['sexe'], PDO::PARAM_STR);
 $stmt->bindValue(5, $employe['salaire'], PDO::PARAM_INT);
 $stmt->bindValue(6, $employe['dateContrat'], PDO::PARAM_STR);

	//Diff entre bindValue et bindParam : bindParam, la valeur est en référence
  $stmt->bindParam(6, $employe['dateContrat']); 
 

	$stmt->execute();


} catch (PDOException $e) {
	echo 'Connexion échouée : ' .$e-> getMessage();		 
}


// -------- MARQUEUR NOMMES ---------------

try {
	$pdo = new PDO($dsn, $userName,$passWord,[PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);

	//jeu de données qui arrivera de mon $POST du formulaire
$employe =[
	'idService' => 2,
	'nom' => 'Tarzan',
	'prenom' => 'Bob',
	'sexe' => 'M',
	'salaire' => 2400,
	'dateContrat' => '2024-08-08'
];

// on peut stocker dans une variable // marqueur dans VALUES peuv avoir n'importe quel nom mais mieux de mettre celui de la colonne
	$query = "INSERT INTO employe (idService, nom, prenom, sexe, salaire, dateContrat) VALUES(:idService, :nom, :prenom, :sexe, :salaire, :dateContrat)";

	$stmt = $pdo->prepare($query);

 //	on peut typer la valeur que l'on passe : PDO::PARAM_INT => force en INT
 //	si typage déjà fait en amont pas besoin
 $stmt->bindValue(':idService', $employe['idService'], PDO::PARAM_INT);
 $stmt->bindValue(':nom', $employe['nom'], PDO::PARAM_STR);
 $stmt->bindValue(':prenom', $employe['prenom'], PDO::PARAM_STR);
 $stmt->bindValue(':sexe', $employe['sexe'], PDO::PARAM_STR);
 $stmt->bindValue(':salaire', $employe['salaire'], PDO::PARAM_INT);
 $stmt->bindValue(':dateContrat', $employe['dateContrat'], PDO::PARAM_STR);

  //Diff entre bindValue et bindParam : bindParam, la valeur est en référence
	//bindParam on se protège au cas où ref change en cours de route
  $stmt->bindParam(6, $employe['dateContrat']); 
 

	$stmt->execute();


} catch (PDOException $e) {
	echo 'Connexion échouée : ' .$e-> getMessage();		 
}


// --------SI CLE ONT MEME NOM QUE MARQUEUR DS LA REQUETE ---------------


try {
	$pdo = new PDO($dsn, $userName,$passWord,[PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);

	// jeu de données qui arrivera de mon $POST du formulaire
$employe =[
	'idService' => 2,
	'nom' => 'Tarzan',
	'prenom' => 'Bob',
	'sexe' => 'M',
	'salaire' => 2400,
	'dateContrat' => '2024-08-08'
];

// on peut stocker dans une variable // marqueur dans VALUES peuv avoir n'importe quel nom mais mieux de mettre celui de la colonne
	$query = "INSERT INTO employe (idService, nom, prenom, sexe, salaire, dateContrat) VALUES(:idService, :nom, :prenom, :sexe, :salaire, :dateContrat)";

	$stmt = $pdo->prepare($query);

 
 	$stmt->execute($employe); // car tt est aligné dc on met directement le tableau associatif


} catch (PDOException $e) {
	echo 'Connexion échouée : ' .$e-> getMessage();		 
}



?>