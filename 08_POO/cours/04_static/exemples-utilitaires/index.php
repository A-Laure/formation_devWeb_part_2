<?php

require 'functions/_helpers/tools.php';
require 'class/Form.php';

include 'inc/head.php';
// debug($parrot);


$test = [

  2 => "test",
  4 => "test",
  3 => "test",
];

var_dump($test[2]);

?>


<div class="container w-50 mt-5">

  <div class="card p-4 border-0 shadow-sm">
    <form action="" method="">
      <div class="mb-3">
        <?= Form::label('name', 'Nom') ?>
        <?= 
         // value:'Toto' -> parametre nommé permettant de ne pas forcément renseigné tout les parametres ou dans l'odre. Attention valable qu'a partir de PHP 8
          // Form::input('text', 'name', value:'Toto') 
          Form::input('text', 'name', 'Toto') 
        ?>
      </div>
      <div class="mb-3">
        <?= Form::label('firstname', 'Prénom') ?>
        <?= Form::input('text', 'firstname') ?>
      </div>
      <div class="mb-3">
        <?= Form::label('country', 'Sélectionner un pays') ?>
        <?= Form::select('country', ['France', 'Belgique', 'Maroc', 'Suisse', 'Allemagne']) ?>
      </div>
      <div class="mb-3">
        <?= Form::button('submit','Envoyer', 'btn btn-dark') ?>
        
      </div>
    </form>
  </div>

</div>



<?php include 'inc/foot.php'; ?>