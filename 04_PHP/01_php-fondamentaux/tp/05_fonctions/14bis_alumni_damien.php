
<?php

/* 

  Vous devez développer un système de gestion d'alumnis pour un centre de formation.
  Dans cet exercice vous aurez les éléments suivants à réaliser :
  1. Remplir le tableau de plusieurs alumnis de différentes promo et spécialité.
  2. Afficher les alumnis (vous devez afficher en html/css/php avec ou non si vous le
  souhaitez un framework css).
  3. Calculer le nombre d'alumnis par spécialité et l'afficher.
  4. Calculer le pourcentage d'alumnis en poste et l'afficher.
  5. (Bonus) Calculer le pourcentage d'alumnis en poste par spécialité et l'afficher.

*/

  $alumnis = [
    [
      'id' => 1,
      'firstname' => 'Jean-Pierre',
      'lastname' => 'Amar',
      'email' => 'jp-amare@gmail.com',
      'title' => 'Dev BackEnd',
      'description' => 'Farceur de la classe, toujours là pour épater la galerie. Dresseur de pokemon à ses heures perdues',
      'classOption' => 'Développeur web et mobile',
      'classYear' => '2024',
      'inSearch' => false,
      'currentCompany' => [
        'name' => 'Google',
        'linkedin' => 'https://www.linkedin.com/company/google/',
      ],
      'location' => 'Bourg Palette',
      'skills' => ['php', 'bootstrap', 'farceur', 'require/include'],
      'socialLinks' => ['https://www.linkedin.com/in/amar-jp/', 'gitjpamar.io']
    ],

    [
      'id' => 2,
      'firstname' => 'Ken',
      'lastname' => 'Roche',
      'email' => 'ken.roche@gmail.com',
      'title' => 'Dev web',
      'description' => 'Developpeur web et mobile, ami des animaux de la forêt (végétarien)',
      'classOption' => 'Développeur mobile',
      'classYear' => '2024',
      'inSearch' => true,
      'currentCompany' => [
        'name' => 'Kaliop',
        'linkedin' => 'https://www.linkedin.com/company/kaliop/',
      ],
      'location' => 'Montpellier',
      'skills' => ['darth', 'flutter', 'php', 'SQL'],
      'socialLinks' => ['https://www.linkedin.com/in/ken-roche/']
    ],

    [
      'id' => 3,
      'firstname' => 'Sébastien',
      'lastname' => 'Trullu',
      'email' => 'sebastien.trullu@gmai.com',
      'title' => 'Développeur web fullstack',
      'description' => 'Mon crédo : faire en fonction de ma flemme. #Labelleblondedelaclasse',
      'classOption' => 'Développeur web et mobile',
      'classYear' => '2024',
      'inSearch' => true,
      'currentCompany' => [
        'name' => '',
        'linkedin' => '',
      ],
      'location' => 'Montpellier',
      'skills' => ['php', 'print_r', 'html/css', 'winner at bombparty'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
    [
      'id' => 4,
      'firstname' => 'Anne-Laure',
      'lastname' => ' Pioupiou',
      'email' => 'nom.prenom@gmail.com',
      'title' => 'Concepteur Designer UI',
      'description' => 'La programmation ça pue ! Dart c\'est nul, php c\'est nul - ma doc pref : Damien',
      'classOption' => 'Développeur mobile',
      'classYear' => '2022',
      'inSearch' => false,
      'currentCompany' => [
        'name' => 'TotalEnergies',
        'linkedin' => 'https://linkedin.com/company/totalenergies/',
      ],
      'location' => 'Montpellier',
      'skills' => ['Illustrator', 'InDesign', 'html/css', 'Photoshop'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
    [
      'id' => 5,
      'firstname' => 'Najib',
      'lastname' => 'Bakara',
      'email' => 'nom.prenom@gmail.com',
      'title' => 'Développeur web fullstack',
      'description' => 'J\'adore passer du coq à l\'âne',
      'classOption' => 'Développeur jeux vidéo',
      'classYear' => '2024',
      'inSearch' => true,
      'currentCompany' => [
        'name' => 'CGI',
        'linkedin' => '',
      ],
      'location' => 'Montpellier',
      'skills' => ['php', 'html/css', 'winner at boogybomb'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
    [
      'id' => 6,
      'firstname' => 'Nahdgy',
      'lastname' => 'Biodore',
      'email' => 'nom.prenom@gmail.com',
      'title' => 'Développeur web fullstack',
      'description' => 'Guadeloupéen discret, sa sagesse est proportionnel a taille',
      'classOption' => 'Développeur web et mobile',
      'classYear' => '2024',
      'inSearch' => false,
      'currentCompany' => [
        'name' => 'Teads',
        'linkedin' => 'https://www.linkedin.com/company/teads/',
      ],
      'location' => 'Montpellier',
      'skills' => ['php', 'C#', 'html/css', 'Figma', 'SQL'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
    [
      'id' => 7,
      'firstname' => 'Julie',
      'lastname' => 'Farré',
      'email' => 'nom.prenom@gmail.com',
      'title' => 'Développeur web fullstack',
      'description' => 'Le code c\'est bien, le design c\'est mieux',
      'classOption' => 'Concepteur Designer UI',
      'classYear' => '2021',
      'inSearch' => true,
      'currentCompany' => [
        'name' => '',
        'linkedin' => '',
      ],
      'location' => 'Montpellier',
      'skills' => ['php', 'Figma', 'html/css', 'buveuse de bouteille de vin'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
    [
      'id' => 8,
      'firstname' => 'Paul',
      'lastname' => 'Peron',
      'email' => 'nom.prenom@gmail.com',
      'title' => 'Développeur jeux vidéo',
      'description' => 'Tricheur professsionnel, tant que visuellement ça marche c\'est que c\'est bon. (PS : Quelqu\'un à 2e pour que je rentre à Poussan ?)',
      'classOption' => 'Développeur jeux vidéo',
      'classYear' => '2024',
      'inSearch' => true,
      'currentCompany' => [
        'name' => '',
        'linkedin' => '',
      ],
      'location' => 'Montpellier',
      'skills' => ['php', 'print_r', 'html/css'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
    [
      'id' => 9,
      'firstname' => 'Florent',
      'lastname' => 'Frappier',
      'email' => 'nom.prenom@gmail.com',
      'title' => 'Développeur web fullstack',
      'description' => 'Best player au roi du silence',
      'classOption' => 'Développeur web et mobile',
      'classYear' => '2024',
      'inSearch' => true,
      'currentCompany' => [
        'name' => '',
        'linkedin' => '',
      ],
      'location' => 'Montpellier',
      'skills' => ['php', 'mode silencieux', 'html/css'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
    [
      'id' => 10,
      'firstname' => 'Daris',
      'lastname' => 'Kenouche',
      'email' => 'nom.prenom@gmail.com',
      'title' => 'Développeur web fullstack',
      'description' => 'Je suis peut être le plus jeune mais pas le plus bête de la classe ! ',
      'classOption' => 'Concepteur Designer UI',
      'classYear' => '2021',
      'inSearch' => true,
      'currentCompany' => [
        'name' => '',
        'linkedin' => '',
      ],
      'location' => 'Montpellier',
      'skills' => ['php', 'print_r', 'html/css'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
    [
      'id' => 11,
      'firstname' => 'Emmeline',
      'lastname' => 'Eveline',
      'email' => 'nom.prenom@gmail.com',
      'title' => 'Développeur web fullstack',
      'description' => 'Pas alcoolique, juste solidaire',
      'classOption' => 'Concepteur Designer UI',
      'classYear' => '2021',
      'inSearch' => true,
      'currentCompany' => [
        'name' => '',
        'linkedin' => '',
      ],
      'location' => 'Montpellier',
      'skills' => ['php', 'print_r', 'html/css'],
      'socialLinks' => ['https://www.linkedin.com/in/s%C3%A9bastien-trullu/']
    ],
  ];

  // 3. Calculer le nombre d'alumnis par spécialité et l'afficher.
  function speAlumni(array $alumnis) : array {

    $classOption = [];

    foreach($alumnis as $alumni){
      $classOption[] = $alumni['classOption'];
    }

   return array_count_values($classOption);

  }

  // 4. Calculer le pourcentage d'alumnis en poste et l'afficher.
  function statAlumnisJob(array $alumnis) : float{

    $inJobCounter = 0;
    foreach($alumnis as $alumni){

      // Si le nom de la company n'est pas vide on increment le compteur
      if(!empty($alumni['currentCompany']['name'])){

        $inJobCounter++;
      }
      // if($alumni['currentCompany']['name'] != ''){
      //   $inJobCounter++;
      // }
    }
    return round($inJobCounter / count($alumnis) * 100, 1);
  }


  // 5. (Bonus) Calculer le pourcentage d'alumnis en poste par spécialité et l'afficher.
  function statSpeJob(array $alumnis) : array{

    // Appel la fontion speAlumni pour avoir toutes les spécialité et le nombre de personne par spé
    $specialities = speAlumni($alumnis);
    $emlpoyedInSpe = [];

    foreach($specialities as $speciality => $count){

      // initialise un tableau associatif qui va créer a chaque la clé de la spé parcourru
      // ex : $employedInSpe ['Développeur web et mobile'] = 0;
      $emlpoyedInSpe[$speciality] = 0 ;



      foreach($alumnis as $alumni){
        // si le nom de la company ET la spé de l'alumnis parcourru est égale a la spé parcourru alor on incremente la spé parcourru
        if((!empty($alumni['currentCompany']['name']) && $alumni['classOption'] === $speciality)){
          $emlpoyedInSpe[$speciality]++; 
        }
      }
    
      // on réasigne la valeur de la spé par son pourcentage de personne en poste dans cette spé par rapport au nombre total de personne dans la spé
      $emlpoyedInSpe[$speciality] = round($emlpoyedInSpe[$speciality] / $count * 100, 1);
      
    }

    return $emlpoyedInSpe;
  }

  function debug($var){

    echo '<pre>';
    var_dump($var);
    echo '</pre>';

  }

  print_r(speAlumni($alumnis));
  print_r(statSpeJob($alumnis));
  debug(statSpeJob($alumnis));

?>


<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumnis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>

    <div class="container">

      <h1>Liste des Alumnis</h1>

      <h2 class="mt-5 mb-3">Nombre d'alumnis par spécialité</h2>
      <div class="row row-cols-1 row-cols-md-4 g-4 ">
        
        <?php foreach(speAlumni($alumnis) as $spe => $num) :?>
          <div class="col">
            <div class="card text-bg-light mb-3  text-center">
              
              <div class="card-body">
                <h5 class="card-title "><?= $num ?></h5>
              </div>
              <div class="card-footer"><?= $spe ?></div>
            </div>
          </div>
        <?php endforeach;?>

      </div>

      <h2 class="mt-5 mb-3">Taux d'alumnis en poste</h2>
      <div class="progress " role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-success" style="width: <?= statAlumnisJob($alumnis) ?>%"><?= statAlumnisJob($alumnis) ?>%</div>
      </div>

      <h2 class="mt-5 mb-3">Taux d'alumnis en poste par spe</h2>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php foreach(statSpeJob($alumnis) as $speciality => $percent) :?>
          <div class="col">
            <div class="card shadow-sm mb-4" data-bs-theme="dark">
              <div class="card-body text-center p-4 p-xxl-5">
                <h3 class="display-4 fw-bold mb-2"><?=  $percent ?>%</h3>
                <p class="fs-5 mb-0 text-secondary mt-auto"><?= $speciality ?></p>
              </div>
            </div>
          </div>
        <?php endforeach;?>
      </div>
    

      <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">

        <?php foreach($alumnis as $alumni) :?>
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><?= $alumni['firstname'] . ' ' . $alumni['lastname'] ?></h5>
                <p class="card-text"><?= $alumni['description'] ?></p>
                <button class="btn btn-primary" data-bs-target="#profil-card<?= $alumni['id'] ?>" data-bs-toggle="modal" >Voir profil</button>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary"><?= $alumni['title'] ?></small>
              </div>
            </div>
          </div>
        <?php endforeach;?>
      </div>



    </div>





    <!-- Modal -->
    <?php foreach($alumnis as $alumni) :?>
      <div class="modal fade" id="profil-card<?= $alumni['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $alumni['firstname'] ?></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
              <button type="button" class="btn btn-primary">Sauvegarder</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach;?> 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

</html>


