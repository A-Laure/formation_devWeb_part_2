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
function speAlumni(array $alumnis): array
{

  $classOption = [];

  foreach ($alumnis as $alumni) {
    $classOption[] = $alumni['classOption'];
  }

  return array_count_values($classOption);
}

// 4. Calculer le pourcentage d'alumnis en poste et l'afficher.
function statAlumnisJob(array $alumnis): float
{

  $inJobCounter = 0;
  foreach ($alumnis as $alumni) {

    // Si le nom de la company n'est pas vide on increment le compteur
    if (!empty($alumni['currentCompany']['name'])) {

      $inJobCounter++;
    }
    // if($alumni['currentCompany']['name'] != ''){
    //   $inJobCounter++;
    // }
  }
  return round($inJobCounter / count($alumnis) * 100, 1);
}


// 5. (Bonus) Calculer le pourcentage d'alumnis en poste par spécialité et l'afficher.
function statSpeJob(array $alumnis): array
{

  // Appel la fontion speAlumni pour avoir toutes les spécialité et le nombre de personne par spé
  $specialities = speAlumni($alumnis);
  $emlpoyedInSpe = [];

  foreach ($specialities as $speciality => $count) {

    // initialise un tableau associatif qui va créer a chaque la clé de la spé parcourru
    // ex : $employedInSpe ['Développeur web et mobile'] = 0;
    $emlpoyedInSpe[$speciality] = 0;



    foreach ($alumnis as $alumni) {
      // si le nom de la company ET la spé de l'alumnis parcourru est égale a la spé parcourru alor on incremente la spé parcourru
      if ((!empty($alumni['currentCompany']['name']) && $alumni['classOption'] === $speciality)) {
        $emlpoyedInSpe[$speciality]++;
      }
    }

    // on réasigne la valeur de la spé par son pourcentage de personne en poste dans cette spé par rapport au nombre total de personne dans la spé
    $emlpoyedInSpe[$speciality] = round($emlpoyedInSpe[$speciality] / $count * 100, 1);
  }

  return $emlpoyedInSpe;
}

function debug($var)
{

  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}



?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alumnis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-body-tertiary">

  <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Alumnis</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" aria-disabled="true">Le center</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
      </div>
    </div>
  </nav>


  <div class="container mt-5">

    <h1 class="mt-3">Liste des Alumnis</h1>

    <h2 class="mt-5 mb-3">Nombre d'alumnis par spécialité</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4 ">

      <?php foreach (speAlumni($alumnis) as $spe => $num) : ?>
        <div class="col">
          <div class="card text-bg-light mb-3  text-center">

            <div class="card-body">
              <h5 class="card-title "><?= $num ?></h5>
            </div>
            <div class="card-footer"><?= $spe ?></div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <h2 class="mt-5 mb-3">Taux d'alumnis en poste</h2>
    <div class="progress " role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
      <div class="progress-bar bg-success" style="width: <?= statAlumnisJob($alumnis) ?>%"><?= statAlumnisJob($alumnis) ?>%</div>
    </div>

    <h2 class="mt-5 mb-3">Taux d'alumnis en poste par spe</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php foreach (statSpeJob($alumnis) as $speciality => $percent) : ?>
        <div class="col">
          <div class="card shadow-sm mb-4" data-bs-theme="dark">
            <div class="card-body text-center p-4 p-xxl-5">
              <h3 class="display-4 fw-bold mb-2"><?= $percent ?>%</h3>
              <p class="fs-5 mb-0 text-secondary mt-auto"><?= $speciality ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


    <table class="table table-striped mt-5">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Prénom</th>
          <th scope="col">Nom</th>
          <th scope="col">Email</th>
          <th scope="col">Titre</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($alumnis as $alumni) : ?>
          <tr>
            <th scope="row"><?= $alumni['id'] ?></th>
            <td><?= $alumni['firstname'] ?></td>
            <td><?= $alumni['lastname'] ?></td>
            <td><?= $alumni['email'] ?></td>
            <td><?= $alumni['title'] ?></td>
            <td><button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#profil-card<?= $alumni['id'] ?>" aria-controls="offcanvasRight">Voir profil</button></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

  <!-- OffCanvas (barre latérale droite) -->
  <?php foreach ($alumnis as $alumni) : ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="profil-card<?= $alumni['id'] ?>" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel"><?= $alumni['firstname'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <p><?= $alumni['title'] ?></p>
        <p><?= $alumni['description'] ?></p>
        <p><?= $alumni['classOption'] ?></p>
      </div>
    </div>
  <?php endforeach; ?>


  <hr>
  <?php debug(statSpeJob($alumnis)); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>