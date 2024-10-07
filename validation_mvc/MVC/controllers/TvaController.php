<?php

class TvaController
{

  # Affichage Formulaire CREATE Tva
  public function create()
  {
    include 'MVC/views/tva/tva_create.php';
  }

  # TRAITEMENT DU CREATE - Récupère le $_POST pour le transmettre au modèle et faire la redirection vers la liste des users
  public function store($request)
  {

    # FAIRE VERIF DES DONNEES : droits, hmtl char, géré par validate static
    # FAIRE ENCRYPTAGE MDP

    $model = new TvaModel;
    $id = $model->create($request);

    if ($id) {
      header('Location: ../views/dashboards/dashboard.php?ctrl=Dashboard&action=index&adduser=success');
    } else {

      header('Location: ../views/dashboards/dashboard.php?ctrl=Dashboard&action=index&adduser=error');
    }
  }
}
