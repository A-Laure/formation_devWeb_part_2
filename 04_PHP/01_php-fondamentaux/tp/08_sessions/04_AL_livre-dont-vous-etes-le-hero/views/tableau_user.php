
<?php

session_start();

// session_start();
$title = "Tableau_User";

##### ENONCE ####

//          Connexion espace membre
// v1.0
/* ● Faire une page d'index avec un formulaire de connexion permettant de saisir un identifiant et un mot de passe : 
  
  - Le formulaire dirigera l'utilisateur vers une page sécurisée
*/

/* ● Faire une page sécurisée accessible uniquement aux personnes connectées : 

- Stocker dans un tableau 3 utilisateurs Définition d'un utilisateur: un identifiant, un mot de passe, un nom, un prénom
- Seuls les utilisateurs listés dans ce tableau peuvent voir la page en se connectant
- Si l'utilisateur n'est pas reconnu, il doit être renvoyé vers la page d'index sur laquelle doit s'afficher un message d'avertissement
- Si l'utilisateur est autorisé, la page sécurisée devra lui afficher un message de bienvenue
- et un menu de navigation avec plusieurs onglets.
- L'utilisateur doit rester connecté tant qu'il n'a pas cliqué sur un lien de déconnexion.
*/

// v1.1
// ● Ajouter un rôle aux utilisateurs (superadmin, admin ou invite)
// ● Selon le rôle, le menu de navigation affiché devra être différent

##### FIN ENONCE ####
 

  include '../inc/head.php';
  include '../inc/navbar.php';
  include_once '../functions/_helpers/tools.php';
  include '../datas/datas.php';


  // PHP POUR BOUTON LOGOUT

  if (isset($_GET['logOut'])) { 
    unset($_SESSION['ok']);
    header('Location: ../index.php');
			exit; 
  }
	

?>


<!-- BOUTON LOGOUT-->
<a href="?logOut" class="btn btn-primary my-5">LogOut</a>

<h1 class="mb-5 ">Bienvenue!!!</h1>
 




<?php debug($users); ?>



<?php include '../inc/foot.php'; ?>