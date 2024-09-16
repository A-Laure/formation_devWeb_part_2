<?php 
session_start();
$title = 'Users List';
$currentPage = 'userList';
require 'config/config.php';
require 'functions/helpers.php';
require 'inc/head.php';
require 'inc/navbar.php';


try{

  # Connexion a la base 
  $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if(($request = $pdo->query('SELECT use_id, use_login, use_role, rol_libelle, rol_pouvoir
  FROM user 
  JOIN role ON use_role = rol_id')) !== false ){
      # on execute la requête
      if($request->execute()){
        # On récupère et stocke le jeu de résultats au format tableau associatif
        $users = $request->fetchAll(PDO::FETCH_ASSOC);

        # on termine le traitement de la requete
        $request->closeCursor();
      }
  } 
} catch(PDOException $e){

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());

}

?>


<h1 class="display-1 text-center my-5">Liste des utilisateurs</h1>
<div class="container w-50">
  <?php 
    if(isset($_GET['_err'])){
        switch($_GET['_err']){

            case '401':
                echo '<div class="alert alert-warning" role="alert">Vous devez vous connecter!</div>';
                break;
            case '403':
                echo '<div class="alert alert-warning" role="alert">Vous n\'avez pas les droits nécessaires !</div>';
                break;
            case '404':
                echo '<div class="alert alert-warning" role="alert">Page non trouvé !</div>';
                break;
            case 'delete':
                echo '<div class="alert alert-warning" role="alert">Suppression échouée</div>';
                break;
            case 'edit':
                echo '<div class="alert alert-warning" role="alert">Modification échouée</div>';
                break;
            case 'empty':
                switch($_GET['field']){
                    case 'login':
                        echo '<div class="alert alert-warning" role="alert">Vous devez saisir un login !</div>';
                        break;    
                    case 'pwd':
                        echo '<div class="alert alert-warning" role="alert">Vous devez saisir un mot de passe !</div>';
                        break;    
                    default:
                        echo '<div class="alert alert-warning" role="alert">Vous devez remplir tous les champs !</div>';
                        break;    
                }
                break;    
            case 'connect':
                echo '<div class="alert alert-warning" role="alert">Mauvais login ou mot de passe</div>';
                break;
        }
       
    }
    if(isset($_GET['success'])){
      switch($_GET['success']){

        case 'edit':
            echo '<div class="alert alert-success" role="alert">Modification effectuée</div>';
            break;
        case 'delete':
            echo '<div class="alert alert-success" role="alert">Suppression effectuée</div>';
            break;
      }
    }
  ?>



  <a href="userCreate.php" class="btn btn-primary mb-3">Ajouter un utilisateur</a>
  <div class="card p-4 border-0 shadow-sm">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Login</th>
          <th scope="col">Role</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user) : ?>
          <tr>
            <th role="row"><?= $user['use_id']?></th>
            <td ><?= $user['use_login']?></td>
            <td ><?= $user['rol_libelle']?></td>
            <td>
              <a href="userView.php?id=<?= $user['use_id']?>" class="me-3"><i class="bi bi-eye-fill"></i></a>
            <?php 
              if( ($_SESSION[APP_TAG]['connected']['rol_pouvoir'] == 1) || $user['rol_pouvoir'] >= $_SESSION[APP_TAG]['connected']['rol_pouvoir'] ):
              ?>

              <?php if(in_array(3, $_SESSION[APP_TAG]['connected']['autorisations']) || $user['use_id'] == $_SESSION[APP_TAG]['connected']['use_id'] ): ?>
                <a href="userEdit.php?id=<?= $user['use_id']?>" class="me-3"><i class="bi bi-pencil-square"></i></a>
              <?php endif; ?> 
              <?php if(in_array(5, $_SESSION[APP_TAG]['connected']['autorisations']) || $user['use_id'] == $_SESSION[APP_TAG]['connected']['use_id'] ): ?>
                <a href="userDelete.php?id=<?= $user['use_id']?>" class="me-3"><i class="bi bi-trash-fill text-danger"></i></a>
              <?php endif; ?> 
            </td>
            <?php endif; ?>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>

<?php require 'inc/foot.php' ?>