<?php 

  $title = 'Calculatrice';

  require_once 'functions/_helpers/tools.php';
  include 'inc/head.php';
  include 'inc/navbar.php';

  function calcul($num1, $num2, $operator) : float | string {
    if($num1 != '' && $num2 != '') {

      $num1 = str_replace(',', '.', $num1);
      $num2 = str_replace(',', '.', $num2);

      if(is_numeric($num1) && is_numeric($num2)){

        switch($operator){
          case '+':
            $result = $num1 + $num2;
            break;
          case '-':
            $result = $num1 - $num2;
            break;
          case '*':
            $result = $num1 * $num2;
            break;
          case '/':
              if($num2 == 0){
                $result = 'La division par 0 est impossible !';
              } else {
                $result = $num1 / $num2;
              }
            break;
        }

      } else {

        if(!is_numeric($num1) && !is_numeric($num2)){
          return '<p class="mb-2" >l\'élément du premier champ' . $num1 . 'doit être un nombre valable pour une opération!</p><p class="mb-2" >l\'élément du deuxieme champ' . $num2 . 'doit être un nombre valable pour une opération!</p>';
        }elseif(!is_numeric($num1)){
          return '<p class="mb-2" >l\'élément du premier champ' . $num1 . 'doit être un nombre valable pour une opération!</p>';

        }elseif(!is_numeric($num2)){
          return '<p class="mb-2" >l\'élément du deuxieme champ' . $num2 . 'doit être un nombre valable pour une opération!</p>';
        }

      }

    }else {

      if(empty($num1) && empty($num2)){
        return '<p class="mb-2" >Veuillez saisir une valeur pour le premier champ</p><p class="mb-2" >Veuillez saisir une valeur pour le deuxieme champ</p>';
      }elseif(empty($num1)){
        return '<p class="mb-2" >Veuillez saisir une valeur pour le premier champ</p>';

      }elseif(empty($num2)){
        return '<p class="mb-2" >Veuillez saisir une valeur pour le deuxieme champ</p>';
      }

    }

    
    return $result;
  }

  if(isset($_POST['number1']) && isset($_POST['number2']) && isset($_POST['operator'])){

    $num1 = trim($_POST['number1']);
    $num2 = trim($_POST['number2']);
    $operator = $_POST['operator'];
    $result = calcul($num1, $num2, $operator);
    $error = isset($result) && is_string($result) ? $result : '';
  }


?>

<div class="container mt-5 pt-5">
    <?php if(isset($error) && !empty($error)) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php endif ?>

    <form class="row g-3" method="post" novalidate>
        <div class="col">
            <input type="text"  class="form-control"  placeholder="<?= isset($num1) ? $num1 : '' ?>" name="number1">
        </div>
        <div class="col-auto">
            <select class="form-select" name="operator">
                <option  value="+" >+</option>
                <option  value="-">-</option>
                <option  value="*">x</option>
                <option  value="/">/</option>
            </select>
            </div>
        <div class="col">
            <input type="text" class="form-control"  placeholder="<?= isset($num2) ? $num2 : '' ?>" name="number2">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">=</button>
        </div>
        <div class="col">
          <input class="form-control" type="text" value="<?= isset($result) && is_numeric($result) ? $result : '' ?>" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="mb-3">
          <label for="historic" class="form-label">Historique</label> 
          <!--  

            ici on fait une double ternaire 

            (isset($result) ? $num1. ' ' . $operator . ' '. $num2 . ' = '. $result : '')
            la premiere : sert a afficher le dernier calcul demandé (ou si c'est la premiere fois qu'on arrive sur le formulaire on affiche rien)
            on concataine les 2 ensembles

            (isset($_POST['historic']) ? PHP_EOL . $_POST['historic'] : '')
            la deuxieme : sert a faire l'historique on reprend en sautant une ligne et en le plaçant a la fin la derniere valeur de $_POST['historic'] si il y en a une
        
          -->
          <textarea disabled readonly name="historic" id="historic" class="form-control" rows="10" ><?= (isset($result) && is_numeric($result) ? $num1. ' ' . $operator . ' '. $num2 . ' = '. $result : '') . (isset($_POST['historic']) ? PHP_EOL . $_POST['historic'] : '') ?></textarea>
        </div>

    </form>

    <?= debug($_POST); ?>

</div>

<?php include 'inc/foot.php'; ?>