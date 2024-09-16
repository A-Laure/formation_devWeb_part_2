<?php

//! ATTENTION, normalement  à ne lancer qu'une fois, re soumet la requête dc si un enregistrement existe 

//!NE pas prendre en compte ce fichier

// DATA SOURCE NAME (DSN) / après root c'est le pwd (nous on en n'a pas)

$dsn = 'mysql:host=localhost;	dbname=espace_admin;	charset=utf8';
$userName = 'root';
$passWord = '';

// INSERTION CRUD

try {
	$pdo = new PDO($dsn, $userName,$passWord,[PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);

	// jeu de données qui arrivera de mon $POST du formulaire
$crud =[
	'crud_id' => 1,
	'crud_action' => 'Create',
];
[
	'crud_id' => 2,
	'crud_action' => 'Edit',
];
[
	'crud_id' => 3,
	'crud_action' => 'Delete',
];



	$query = "INSERT INTO crud (crud_id, crud_action) VALUES(:crud_id, :crud_action)";

	$stmt = $pdo->prepare($query);

 
 	$stmt->execute($crud); // car tt est aligné dc on met directement le tableau associatif




// INSERTION ADMIN


	// jeu de données qui arrivera de mon $POST du formulaire
$role =[
	'role_id' => 1,
	'role_role' => 'Super_Admin',
];

// on peut stocker dans une variable // marqueur dans VALUES peuv avoir n'importe quel nom mais mieux de mettre celui de la colonne
	$query = "INSERT INTO role (role_id, role_role) VALUES(:role_id, :role_role)";

	$stmt = $pdo->prepare($query);

 
 	$stmt->execute($role); // car tt est aligné dc on met directement le tableau associatif




// INSERTION MON PROFIL 


	// jeu de données qui arrivera de mon $POST du formulaire
$user =[
	'user_id' => 1,
	'user_name' => 'A_Laure',
	'role_id' => 1,
];

// on peut stocker dans une variable // marqueur dans VALUES peuv avoir n'importe quel nom mais mieux de mettre celui de la colonne
	$query = "INSERT INTO user (user_id, user_name, role_id ) VALUES(:user_id, :user_name, :role_id)";

	$stmt = $pdo->prepare($query);

 
 	$stmt->execute($user); // car tt est aligné dc on met directement le tableau associatif


} catch (PDOException $e) {
	echo 'Connexion échouée : ' .$e-> getMessage();		 
}
