<?php 

 # MVC 

  ## MODEL ##
    # Le modèle (Model) récupère/contient les données à afficher 
    # C'est la partie qui gère les données, son rôle c'est d'aller récupérer les données dans la base de données, de les organiser et les assembler pour qu'elles puissent être traitées par le contrôleur. Donc en gros c'est la qu'on y trouve les requêtes SQL et du PHP.

  ## VIEW ##
    # La vue (View) contient l'affichage de l'interface graphique/utilsateur.
    # C'est la partie qui gère l'affichage, elle ne fait presque qu'aucune logique (sauf la logique d'affichage), elle se contente de récupérer les variables pour savoir ce qu'elle a à afficher. Donc on y retrouve essentiellement du HTML et un peu de PHP généralement des boucles et des conditions.
  
  ## CONTROLLER ##
    # Le contrôleur (Controller) contient la logique concernant les actions effectuées par l'utilisateur.
    # C'est la partie qui gère la logique du code donc c'est elle qui prend les décisions. C'est en quelque sorte le chef d'orchestre, le contrôleur va demander au modèle les données, les analyser,traiter, prendre des décision et appeler la vue correspondante.
    # Donc on y retrouve que du PHP.


  require_once "Model.php";
  require_once "Controller.php";

  $ctrl = new Controller();
  $ctrl->action();
