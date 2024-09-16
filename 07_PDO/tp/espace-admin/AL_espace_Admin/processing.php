<?php
session_start();
//! SESSION SEULEMENT POUR LE USER CONNECTE, les autres on fera un foreach

// require 'db/data.php';
require 'lib/utils/functions.php';



// JE VERIFIE D'ABORD QUE LES CONDITIONS SONT OK AVANT D'INTERROGER LA BDD CE QUI EVITE DE PRENDRE DES RESSOURCES POUR RIEN CAR FORMULAIRE MAL REMPLI.


if (isset($_POST['email']) && isset($_POST['pwd'])) {
  if (!empty($_POST['email']) && !empty($_POST['pwd'])) {

    $email = strtolower($_POST['email']);
    $pwd = $_POST['pwd'];


    // SI AU DESSUS OK, CONNEXION A LA BDD espace_admin 
    $dsn = 'mysql:host=localhost;	dbname=espace_admin;	charset=utf8';
    $userName = 'root';
    $passWord = '';

    try {
      $pdo = new PDO($dsn, $userName, $passWord, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

      echo '<pre>';
      echo 'Connexion réussie';
      echo '<pre>';

      /*  Requête : tu vérifies dans la table users si tu as l'email AND le pwd, pour faire le test, on lui affecte des marqueurs
       - on affecte un marqueur (le ":email") à user_mail.
       - on affecte un marqueur (le ":pwd") à user_pwd.
      */
      $query = "SELECT * FROM users WHERE user_email = :email AND user_pwd = :pwd";

      $stmt = $pdo->prepare($query);

      // association du marqueur à la variable
      $stmt->bindValue(':email',$email); // on "associe" le marqueur à la variable)
      $stmt->bindValue(':pwd',$pwd); // on "associe" le marqueur à la variable)
      
      $stmt->execute();

      # Tableau associatif qui se crée (transparent pour nous)
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      // Suppression du mot de passe du tableau
          unset($result['user_pwd']);
      
      // $result = [
      //   'user_id' => 1,
      //   'user_name' => 'A_Laure',
      //   'user_email' => 'alaure@gmail.com',
      //   'user_pwd' => 'toto',
      //   'role_id' => 1
      // ];


        // toutes les infos du user stocker dans :
        // Mais il faut pas reprendre le pwd

      $_SESSION['cem']['connected']['user'] = $result;
     

      echo '<pre>';
      print_r($result);
      echo '<pre>';


      $_SESSION['cem']['error'] = 'Mauvais identifiant / mot de passe';
      // pas de RETURN , un RETURN vaut pour une fonction et arrête le scriptt

    } catch (PDOException $e) {
      echo 'Connexion échouée : ' . $e->getMessage();
    }

    $result ? header('Location: admin/dashboard.php') : header('Location: login.php');

  } 
}

?>