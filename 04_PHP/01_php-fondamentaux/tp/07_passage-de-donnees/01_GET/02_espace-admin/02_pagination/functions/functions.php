<?php
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

