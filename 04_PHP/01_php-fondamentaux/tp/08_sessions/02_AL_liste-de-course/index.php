<?php

session_start();


##### ENONCE ####
    /**
         *Créer une application pour gérer une liste de courses. Les utilisateurs pourront ajouter des  articles avec leur quantité, afficher la liste des courses et supprimer les articles sélectionnés ou toute la liste.

    */
##### FIN ENONCE ####

  $title = 'Liste Des Courses | Session';


  include 'inc/head.php';
  include 'inc/navbar.php';
  include 'functions/_helpers/tools.php';
  include 'functions/functions.php';

  # Si dans l'url j'ai ?newlist alors on efface la session $_SESSION['list'] et on redirige vers la page en cours(ce qui va évité d'avoir tout le temps ?newlist dasn l'url)
  if(isset($_GET['newList'])){
    unset($_SESSION['list']);
    // $_SERVER['PHP_SELF'] récupère le nom de la page en cours (pratique pour au cas ou le nom du fichier change plus tard)
    $page = $_SERVER['PHP_SELF'];
    header('Location: '. $page);
    exit();
  }



  # On vérifie si $_SESSION['list'] n'existe pas alors on la crée 
  // if (!isset($_SESSION['list']) || !is_array($_SESSION['list'])) {
  //   $_SESSION['list']=[];
     // }
  
// Handle form submission to add a new item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item']) && isset($_POST['qty'])) {
  $item = htmlspecialchars($_POST['item']);
  $qty = intval($_POST['qty']);


    $_SESSION['list'][] = [
        'article' => $item,
        'quantité' => $qty,
    ];
}

// Handle item removal
if (isset($_GET['removeItem'])) {
    $index = intval($_GET['removeItem']);
    if (isset($_SESSION['list'][$index])) {
        array_splice($_SESSION['list'], $index, 1);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

?>

  <!-- Bouton pour réinitialisé la liste -->
  <a href="?newList" class="btn btn-primary my-5">Nouvelle Liste</a>

<div class="container">
<form method="post">
  <div class="mb-3">
    <label for="item" class="form-label">Article</label>
    <input type="text" name="item" class="form-control" id="item" aria-describedby="itemm">
  </div>

  <div class="mb-3">
    <label for="qty" class="form-label">Quantité</label>
    <input type="number" name="qty" class="form-control" id="qty">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<div class="container mt-5">
    <h2>Liste des courses</h2>
    <ul class="list-group">
        <?php if (!empty($_SESSION['list'])): ?>
            <?php foreach ($_SESSION['list'] as $index => $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($item['article']) . ' - ' . htmlspecialchars($item['quantité']); ?>
                    <a href="?removeItem=<?php echo $index; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="list-group-item">Votre liste est vide.</li>
        <?php endif; ?>
    </ul>
</div>

<pre><?php var_dump($_SESSION['list']) ?></pre>


<?php include 'inc/foot.php'; ?>
