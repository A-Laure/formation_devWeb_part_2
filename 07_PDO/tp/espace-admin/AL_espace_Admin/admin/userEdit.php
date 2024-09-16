<?php
session_start();

$title = 'Create_User';
$currentPage = '';

include '../inc/head.php';
include '../inc/navbar.php';
include '../lib/_helpers/tools.php';

$user_id = $_GET['id'];

// SI AU DESSUS OK, CONNEXION A LA BDD espace_admin 
$dsn = 'mysql:host=localhost;dbname=espace_admin;charset=utf8';
$userName = 'root';
$passWord = '';


# ------- 1/ ON SE CONNECTE D'ABORD A LA BDD POUR RECUPERER LE TABLEAU ASSOICTAIF DES ROLES ------

try {
  $pdo = new PDO($dsn, $userName, $passWord, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  
  $query = " SELECT role_id, role_role FROM roles ";

  $stmt = $pdo->prepare($query);


  $stmt->execute();

  $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo 'Connexion échouée : ' . $e->getMessage();
  exit; // Arrêter le script en cas d'erreur de connexion
}


# 2/ ------ ON VERIFIE SI LE POST EXISTE ET SI IL Y A DES DONNEES ET SI OUI ON FAIT UN INSERT DANS LA BDD USERS

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo 'salut1';

  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['role'])) {
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_pwd = $_POST['pwd'];
    $user_role = $_POST['role'];

   echo 'salut';

    try {
    
      $sql = "UPDATE users SET user_name = :user_name , user_email = :user_email, user_pwd = :user_pwd , role_id = :user_role WHERE user_id = :user_id";

     
      // requête SQL pour une exécution future de manière sécurisée et efficace, en utilisant l'objet PDO pour interagir avec la base de données.
      $stmt = $pdo->prepare($sql);

      // Association des valeurs aux marqueurs de la requête préparée (empêche les injections SQL)
      $stmt->bindValue(':user_id', $user_id);
      $stmt->bindValue(':user_name', $user_name);
      $stmt->bindValue(':user_email', $user_email);
      $stmt->bindValue(':user_pwd', $user_pwd);
      $stmt->bindValue(':user_role', $user_role, PDO::PARAM_INT);

      $stmt->execute();

      
      $_SESSION['user_create']['success'] = 'Utilisateur créé avec succès';
      header('Location: dashboard.php');

    } catch (PDOException $e) {
      echo 'Erreur lors de la création de l\'utilisateur : ' . $e->getMessage();
    }
  }
}

// Gestion du cas où POST est vide
if (empty($_POST)) {
  $_SESSION['user_create']['error'] = 'Saisir une donnée ou annuler';
}

?>

<section class="container pt-5">


  <form action="" method="POST">

    <div class="mb-3">
      <label for="name" class="form-label">Nom</label>
      <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="<?= $_SESSION['cem']['connected']['user']['user_name'] ?>">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="email" aria-describedby="email" placeholder="<?= $_SESSION['cem']['connected']['user']['user_email'] ?>">
    </div>

    <div class="mb-3">
      <label for="pwd" class="form-label">Password</label>
      <input type="password" name="pwd" class="form-control" id="pwd" >
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <!-- ATTENTION DE BIEN METTRE LE NAME DANS LE SELECT -->
      <select class="form-select" name="role" aria-label="Default select example">
        <?php foreach ($roles as $role): ?>
          <option value="<?= $role['role_id'] ?>"><?= $role['role_role'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>

  </form>

  <?php
  echo '<pre>';
  echo debug($_POST);
  echo "post_Create";
  echo '<pre>';

  // VERIFIE LE NOMBRE DE LIGNES INSEREES
  // $affectedRows = $stmt->rowCount();
  // if ($affectedRows > 0) {
  //   echo "L'utilisateur a été inséré avec succès.";
  // } else {
  //   echo "Aucune ligne insérée. Vérifiez les données.";
  // }

  ?>

</section>

<?php include '../inc/foot.php'; ?>