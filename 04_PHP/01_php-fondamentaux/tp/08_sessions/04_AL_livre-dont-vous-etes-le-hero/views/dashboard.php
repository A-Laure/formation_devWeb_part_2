
<?php

session_start();

// session_start();
$title = "dashboard";

##### ENONCE ####
/*
Le livre dont vous êtes le héro
Le livre dont vous êtes le héro est un concept bien connu dans lequel il existe plusieurs points
d'arrêt où un choix vous est proposé. Ce choix influence la suite de votre parcours dans
l'histoire.
Dans cet exercice, le fichier story.php contenant les différents morceaux de l'histoire vous est
mis à disposition.
Il vous est demandé :
● de créer une fonction pour afficher le chapitre n
● mettre en place un formulaire proposant les choix possibles à chaque décision à
prendre
● faire en sorte d'ajouter une persistance des données pour ne pas perdre le cours de
l'histoire
*/
##### FIN ENONCE ####
 

  include '../inc/head.php';
  include '../inc/navbar.php';
  // include '../functions/_helpers/tools.php';
  // include '../datas/datas.php';


  // PHP POUR BOUTON LOGOUT

  if (isset($_GET['logOut'])) { 
    unset($_SESSION['ok']);
    header('Location: ../index.php');
			exit; 
  }
	

?>

<div class='container'>
<!-- BOUTON LOGOUT-->
<a href="?logOut" class="btn btn-primary my-5 justify-content-center">LogOut</a>









<?php include '../inc/foot.php'; ?>