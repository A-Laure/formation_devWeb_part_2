<?php
session_start();

$title = 'Delete';
$currentPage = '';

include '../inc/head.php';
include '../inc/navbar.php';
include '../lib/_helpers/tools.php';

// JE RECUPERE L ID DE L URL VIA UNE VARIABLE (pas obligé)
$user_id = $_GET['id'];


// CONNEXION A LA BDD espace_admin 
$dsn = 'mysql:host=localhost;	dbname=espace_admin;	charset=utf8';
$userName = 'root';
$passWord = '';

try {
  $pdo = new PDO($dsn, $userName, $passWord, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  $query = "SELECT * FROM users";

  $stmt = $pdo->prepare($query);

  $stmt->execute();

  # Tableau associatif qui se crée (transparent pour nous)
  $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo 'Connexion échouée : ' . $e->getMessage();
}
?>


<section class="container pt-5">

  <h1>Attention, vous allez supprimer le profil suivant</h1>

  <?php foreach ($result as $user) :

    if ($user_id == $user['user_id']) : ?>

      <form action="../process_user_delete.php" class="card text-bg-white mt-5 mb-3 ms-5" style="max-width: 18rem" method ="post">

        <div class="card-header"><?= $user['user_name'] ?></div>

        <div class="card-body">
          <p><?= $user['user_email'] ?></p>

          <input type="hidden" name="id" value="<?=$user['user_id']?>">
          <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Delete</button>

          <a href="usersList.php" type="button" class="btn btn-success">Annuler</a>

    </form>
      <?php endif; ?>
    <?php endforeach; ?>
    </div>



</section>


<?php include '../inc/foot.php'; ?>