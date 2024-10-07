<?php


$title = "Creation Tva";
$currentPage = "tvaCreate";

?>

<h1 class="text-align-center title">Création d'une Tva</h1>


<section class="n-container m-l-45">

  <?php

  # BANNER MESSAGE ALERTE
  if (isset($msg)) {
    echo $msg;
  }
  ?>


  <form action="index.php?ctrl=Tva&action=store" method="post" class="formCreate ">

    <div class="mb-3 ">
      <label for="tvaLabel" class="form-label">Taux de TVA<span> *</span></label>
      <input type="text" name="tvaLabel" id="tvaLabel" class="form-control">
    </div>
    
    <button type="submit" class="n-btn btn-primary fs-3">Valider</button>

  </form>


</section>

