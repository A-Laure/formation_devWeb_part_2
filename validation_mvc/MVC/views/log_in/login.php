<?php

$title='Login';

if (!empty($_GET['_err'])) {
    $error = htmlspecialchars($_GET['_err']);
    echo "<div class='error'>Erreur : {$error}</div>";
}

 //! OK MARCHE
/* dump($_POST); */
?>


<!-- <nav class="navBar n-d-flex flex-column flex-shrink-0 p-3 text-white " style="width: 280px;">

LOGO
  <div class=" logo m-b-5">
    <a href="../dashboards/dashboard.php"><img src="../../../img/logo.png" alt=""></a>
  </div>

  <hr class="m-t-5">     

</nav>  -->

<section class="n-container m-l-36">

<h1 class="title ms-0 m-t-5">Bienvenue Sur Notre Plateforme</h1>   

<!-- Bouton pour réinitialisé la liste A ENLEVER A LA FIN -->
<a href="?reset" class="btn btn-primary my-5">Nouvelle Liste</a>


<!-- REDIRECTION QD APPUI SUR CONNEXION -->

  <form action="index.php?ctrl=Login&action=login" method="post" class="formCreate m-t-5 "> 
  <!-- index.php?ctrl=Login&action=login -->

    <div class="mb-3 ">

      <div class="mb-3 ">
        <label for="email" class="form-label">Email<span> *</span></label>
        <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp">
      </div>

      <div class="mb-3 ">
        <label for="pwd" class="form-label">Mot de Passe<span> *</span></label>
        <input type="password" name="pwd" id="pwd" class="form-control">
        <!-- <a href="" class="fs-5 text-right">Mot de passe oublié</a> -->
      </div>

      <div class="mb-3 ">
        <button type="submit" class="n-btn btn-primary fs-3">Connexion</button>
        <a href="index.php?ctrl=User&action=create" class="fs-5 text-end ">Non Inscrit? Cliquez Ici</a>
      </div>

    </div>
  </form>
</section>
