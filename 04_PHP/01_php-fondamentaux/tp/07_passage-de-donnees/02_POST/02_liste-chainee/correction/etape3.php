<?php


  $title = 'Liste chainée E1';

  require_once 'functions/_helpers/tools.php';
  include 'inc/head.php';
  // include 'inc/navbar.php';

$datas = [
    ['letter' => 'a', 'goto' => 10], # 0
    ['letter' => 'e', 'goto' => -1], # 1
    ['letter' => 'e', 'goto' => 6],  # 2
    ['letter' => 'l', 'goto' => 1],  # 3
    ['letter' => 'p', 'goto' => 8],  # 4
    ['letter' => 'o', 'goto' => 11], # 5
    ['letter' => 'x', 'goto' => 12], # 6
    ['letter' => 'p', 'goto' => 3],  # 7
    ['letter' => 'r', 'goto' => 5],  # 8
    ['letter' => 'm', 'goto' => 7],  # 9
    ['letter' => 'b', 'goto' => 3],  # 10
    ['letter' => 'b', 'goto' => 0],  # 11
    ['letter' => 'a', 'goto' => 9]   # 12
];

  # exemple : $datas[3]['letter'] = 'l'
  # exemple : $datas[3]['goto'] = 1


  # Obejctif : 
    # récupérer les lettres et les concaténer pour en faire un mot

    # saisie utilisateur pour démarrer la lecture a un index du tableau qui va nous donner une lettre (la clé 'letter') et l'index suivant (la clé goto) auquel on doit se rendre pour récupérer l'élément suivant jusqu'à ce que le 'goto' soit égale à -1
    

  // ETAPE 3 - Transformer en fonction
  function wordGenerator(array $datas, int $index) : string {
    # variable qui va stocker les lettres récupérées
    $word = '';

    # tant que l'index est différent de -1 on boucle et éxécute les instructions
    while($index != -1){
      # On ajoute la lettre a stocker
      $word .= $datas[$index]['letter'];

      # On réccupère l'index suivant et on le stocke( on redéfini la valeur de $index) dans la variable $index
      $index =  $datas[$index]['goto'];
    }
    return $word;
  }


  if(isset($_POST['number'])){

    if(ctype_digit($_POST['number'])){

      $word = wordGenerator($datas, $_POST['number']);

    }else {
      $error = 'Saisissez un entier';
    }
  }
  
?>

<div class="container mt-5 pt-5">

  <h3>Veuillez saisir un index de départ (entre 0 et <?= count($datas) -1 ?>) : </h3>

  <?php if(isset($error))  : ?>
    <div class="alert alert-danger" role="alert">
      <?=  $error ?>
    </div>
    <?php elseif(isset($word)) : ?>
      <div class="alert alert-success" role="alert">
      <?=  $word ?>
    </div>
    <?php endif; ?>


  <form action="" class="row g-3" method="post" novalidate >

    <div class="col-auto">
      <input type="number" class="form-control" id="number" name="number" min="0" max="<?= count($datas)-1 ?>" >
    </div>
    
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3">Envoyer</button>
    </div>

  </form>




  <?= debug($word); ?>

</div>

<?php include 'inc/foot.php'; ?>