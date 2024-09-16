<?php

session_start();
$title = "Admin Connexion";
##### ENONCE ####

//          Connexion espace membre
// v1.0
// ● Faire une page d'index avec un formulaire de connexion permettant de saisir un
// identifiant et un mot de passe : Le formulaire dirigera l'utilisateur vers une page sécurisée

/* ● Faire une page sécurisée accessible uniquement aux personnes connectées : 

- Stocker dans un tableau 3 utilisateurs Définition d'un utilisateur: un identifiant, un mot de passe, un nom, un prénom)
- Seuls les utilisateurs listés dans ce tableau peuvent voir la page en se connectant
- Si l'utilisateur n'est pas reconnu, il doit être renvoyé vers la page d'index sur laquelle doit s'afficher un message d'avertissement
- Si l'utilisateur est autorisé, la page sécurisée devra lui afficher un message de bienvenue et un menu de navigation avec plusieurs onglets.
- L'utilisateur doit rester connecté tant qu'il n'a pas cliqué sur un lien de déconnexion.
*/

// v1.1
// ● Ajouter un rôle aux utilisateurs (superadmin, admin ou invite)
// ● Selon le rôle, le menu de navigation affiché devra être différent

##### FIN ENONCE ####


include './inc/head.php';
// include './inc/navbar.php';
include './functions/_helpers/tools.php';
include './datas/datas.php';

# Si dans l'url j'ai ?newlist alors on efface la session $_SESSION['list'] et on redirige vers la page en cours(ce qui va évité d'avoir tout le temps ?newlist dasn l'url)
if (isset($_GET['newUser'])) { // bouton remise à zéro
	unset($_SESSION['ok']);
	// $_SERVER['PHP_SELF'] récupère le nom de la page en cours (pratique pour au cas ou le nom du fichier change plus tard)
	$page = $_SERVER['PHP_SELF'];
	header('Location: ' . $page);
	exit();
}


// VERIFICATION AVANT DE METTRE DANS LA SESSION DU MAIL ET PWD
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['pwd'])) {

	$email = htmlspecialchars($_POST['email']);
	$pwd = $_POST['pwd'];


	foreach ($users as $user) {

		if ($email != $user['email']) {
			$noGood = 'Votre identifiant est incorrect';
			break;
		} elseif ($email === $user['email'] && $pwd != $user['pwd']) {
			$noGood = 'Votre mot de passe est incorrect';
			break;
		} elseif ($email === $user['email'] && $pwd === $user['pwd']) {
			$_SESSION['ok'][] = [
				'email' => $email,
				'pwd' => $pwd,
				'statut' => $user['statut'],
			];
			header('Location: ./views/dashboard.php');
			exit;//quitte le script après la redirection			
		}
	}
}


?>

<!-- Bouton pour réinitialisé la liste -->
<a href="?newUser" class="btn btn-primary my-5">Nouvelle Liste</a>

<!-- Bouton pour aller au tableau -->
<a href="./views/tableau_user.php" class="btn btn-primary my-5">Tableau User</a>

<!-- Bouton pour aller securePage -->
<a href="./views/securePage.php" class="btn btn-primary my-5">securePage</a>

<div class='container'>

	<?php if (isset($noGood)) : ?>
		<div class="alert alert-<?= $noGood  ? 'warning' : '' ?>" role="alert">
			<?= $noGood ?>
		</div>
	<?php endif; ?>


	<form method="post">
		<div class="mb-3">
			<label for="email" class="form-label">Saisir un Email</label>
			<input type="email" name='email' class="form-control " id="email" aria-describedby="emailHelp">
		</div>

		<div class="mb-3">
			<label for="pwd" class="form-label">Saisir Password</label>
			<input type="password" name='pwd' class="form-control" id="pwd">
		</div>

		<div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input" id="exampleCheck1">
			<label class="form-check-label" for="exampleCheck1">Check me out</label>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>


<pre>
<?php if (!isset($_SESSION['ok'])) {
	echo "Liste vide";
} else {
	var_dump($_SESSION['ok']);
}
?>
</pre>

















<?php include './inc/foot.php'; ?>