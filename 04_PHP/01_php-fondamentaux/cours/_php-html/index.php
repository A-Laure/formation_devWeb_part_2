<?php
/*
- PHP interprete le html
- on passera par xampp pour voir
- lancer Xampp, lancer Apache et se mettre sur son local host el le chemin du fichier
- ds la barre de tâche : http://localhost/formation_WebDev/ et on ouvre le fichier
- on doit rafraîchir manuellement
- on aura des pbs de cache car le navigateur garde en mémoire pour ne pas recharger à chaque fois : ctrl + f5 pour vider
 - php exécuté côté serveur, non visible ds inspecter, ds inspecter on a que la donnée brute

 - on peut faire la même chose avec TAILWIND mais pas voia CDN car pose pb en production dc oui mais pas via CDN
 - TAILWIND plus compliqué car on peut faire plus de chose mais plus logique
*/

$users = [
  [
    'name' => 'Emma',
    'firstName' => 'Dalton',
    'portfolio' => 'paulPersonne.com',
    'linkedin' => 'https://www.linkedin.com',
    'bio' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, veritatis pariatur. Quia minima dignissimos blanditiis aperiam nesciunt commodi architecto ea? Velit, aperiam mollitia beatae dolorem minus architecto a quae sequi.',
    'img' => './img/cv.jpg',

  ],
  [
    'name' => 'Boule',
    'firstName' => 'et Bill',
    'portfolio' => 'tomPeres.com',
    'linkedin' => 'https://www.linkedin.com',
    'bio' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, veritatis pariatur. Quia minima dignissimos blanditiis aperiam nesciunt commodi architecto ea? Velit, aperiam mollitia beatae dolorem minus architecto a quae sequi.',
    'img' => './img/chien.jpg',

  ],
  [
    'name' => 'Alaure',
    'firstName' => 'Guillon',
    'portfolio' => 'alaure.com',
    'linkedin' => 'https://www.linkedin.com',
    'bio' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, veritatis pariatur. Quia minima dignissimos blanditiis aperiam nesciunt commodi architecto ea? Velit, aperiam mollitia beatae dolorem minus architecto a quae sequi.',
    'img' => './img/fleur.jpg',

  ],


];
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alumni</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <!-- top et bottom de 5 -->
  <section class="my-5">

    <div class=" container">

      <h1 class="my-5">L'équipe de Chocapic</h1>


      <div class="row gap-5 "> <!-- 1 row qui englobe ttes les card -->


        <!-- <div class=" card col"> -->

          <!-- <img src="./img/cv.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Voir le profil</a>
          </div>
        </div> -->

 <?php
 // METHODE BRUT

        //  foreach($users as $user){

        //   echo '<div class="card col">
        //           <img src="..." class="card-img-top" alt="...">
        //           <div class="card-body">
        //             <h5 class="card-title">'. $user['name'] . ' ' . $user['firstName'] .'</h5>
        //             <p class="card-text">'. $user['bio'] . '</p>
        //             <div class="card-body">
        //               <a href="'. $user['linkedin'] . '" class="card-link">Linkedin</a>
        //               <a href="'. $user['portfolio'] . '" class="card-link">Portfolio</a>
        //             </div>
        //           </div>
        //         </div>';
        //   }
?>


<!-- METHODE PROPRE   -->

        <?php foreach($users as $user) : ?>
          <div class="card col">
                  <img src="<?= $user['img']?>" class="card-img-top" alt="...">
                  <div class="card-body">
                   <h5 class="card-title"> <?php echo $user['name'] . ' ' .  $user['firstName'] ?> </h5>
                   <!-- On peut mettre le  < ? = à place de echo mais parfois pose problème-->
                   <p class="card-text"><?= $user['bio']?></p>
                   <div class="card-body">
                     <a href="<?= $user['linkedin']?>" class="card-link">Linkedin</a>
                     <a href="<?= $user['portfolio']?>" class="card-link">Portfolio</a>
                   </div>
                 </div>
               </div>';


        <?php endforeach ?>


  
      </div>
    </div>

  </section>







  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

