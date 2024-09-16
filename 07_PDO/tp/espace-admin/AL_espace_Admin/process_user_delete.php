<?php
session_start();
//! SESSION SEULEMENT POUR LE USER CONNECTE, les autres on fera un foreach

require 'lib/utils/functions.php';


// Validation et nettoyage de l'ID utilisateur
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $user_id = intval($_GET['id']);
} else {
  echo 'ID utilisateur non valide.';
  exit;
}

  // CONNEXION A LA BDD espace_admin 
  $dsn = 'mysql:host=localhost;	dbname=espace_admin;	charset=utf8';
  $userName = 'root';
  $passWord = '';


  try {
    $pdo = new PDO($dsn, $userName, $passWord, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      
    $sql = "DELETE FROM users WHERE user_id = :user_id";

    // requête SQL pour une exécution future de manière sécurisée et efficace, en utilisant l'objet PDO pour interagir avec la base de données.
    $stmt = $pdo->prepare($sql);

    // Association des valeurs aux marqueurs de la requête préparée (empêche les injections SQL)
    $stmt->bindValue(':user_id', $user_id);
  
    $stmt->execute();

    
    // header('Location: usersList.php');

  } catch (PDOException $e) {
    echo 'Erreur lors de la suppression : ' . $e->getMessage();
  }
  
?> 