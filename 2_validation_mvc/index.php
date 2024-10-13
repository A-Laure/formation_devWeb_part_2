<?php


require 'lib_vendor/helpers_debug/helpers.php';
require_once 'admin/config/config.php';
require_once 'lib_vendor/autoloader.php';

// dump($_POST);
require 'inc/header.php';
/* require 'inc/navbar.php';  */

# On aura ce genre d'url
# index.php?ctrl=user&action=index
# index.php?ctrl=user&action=show&id=6

/* dump($_POST, 'Récup du Post de Connexion'); */


#### ON AUTOMATISE L'INSTANCIATION D'UN CONTROLLER AVEC L'APPEL D'UNE DE SES METHODES GRACE AUX PARAMETRES PASSES EN URL


// !---  VALEURS PAR DEFAUT POUR ALLER SUR PAGE CONNEXION AU LANCEMENT APP ----------- 

# On donne a $ctrl une valeur par default (pour la premier ou on arrive sur l'app)
// $ctrl = 'HomeController';
$ctrl = 'LoginController';
/* $ctrl = 'LoginController'; */
# Si on a un $_GET['ctrl'] (c'est a dire si on a dans l'url: index.php?ctrl=nomDuControleur&action=nomDeMethode )
if (isset($_GET['ctrl'])) {
  # Alors on stock la valeur du $_GET['ctrl'] et on la passe en minuscule (strtolower) puis on met une majuscule a la premier lettre (ucfirst) puis on la concatene avec le mot 'Controller' ( ex : si on a dans l'url index.php?ctrl=role&action=index alors on aura $ctrl = 'RoleController') 
  $ctrl = ucfirst(strtolower($_GET['ctrl'])) . 'Controller';
}


# On donne a $method une valeur par default (pour la premier ou on arrive sur l'app)
$method = 'index';
if (isset($_GET['action'])) {
  # Alors on stock la valeur du $_GET['action'] dans $method' ( ex : si on a dans l'url index.php?ctrl=role&action=index alors on aura $method = 'index') 
  $method = $_GET['action'];
}

/* echo '<br>J ai parcouru le code qui met ctrl et method par défaut<br><hr>';
echo '<br>$ctrl = ' . $ctrl  . '</br>';
echo '<br>$ctrl = ' . $method  . '</br>'; */

// !---  FIN CODE VALEURS PAR DEFAUT POUR ALLER SUR PAGE CONNEXION AU LANCEMENT APP ----------- 

try {

  /* echo '<br>Début vérif si le contrôleur spécifié existe<br><hr>'; */
  #  # Vérification si le contrôleur spécifié existe (contrôleur par défault ou récupéré du $_GET['ctrl'])
  if(class_exists($ctrl)) {
     # Si oui, on instancie la classe contrôleur
    $controller = new $ctrl();
 /*    echo'<br>Je suis là</br><hr>'; */
    // dump($controller) ;

     # Gestion des requêtes POST pour la création ou la mise à jour d'un élément


    # Si on reçoit des données (POST) via un formulaire ( ici on aura create($_POST) ou update($_GET['id], $_POST) )
    /* dump($_POST, 'Je suis dans index ds verif class $ctrl, Recup $_POST tjs ok'); */
    
    if (!empty($_POST)) {
      
      
       # Vérification si la méthode à appeler existe dans le contrôleur
      if (method_exists($ctrl, $method)) {
      /*   echo '<br>Je suis dans index,  vérif si la methode existe dans le controleur<br><hr>'; */
          # Si un ID est passé dans l'URL via $_GET['id'] et qu'il est un entier valide
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            # Si c'est le cas, on effectue une mise à jour : update($_GET['id'], $_POST)
          $controller->$method($_GET['id'], $_POST);
        } else {
           # Sinon, on crée un nouvel élément : create($_POST)
          $controller->$method($_POST);
        }
        /* echo '<br>je suis dans index, jai fini de vérifier si la méthode existe dans le contrôleur.<br><hr>'; */
      }
    } else {
         # Si on ne reçoit pas de données POST, cela signifie qu'on est en lecture (GET)
         /* echo "<br>No POST data received donc on est en GET.<br><hr>"; */
         # Vérification si la méthode à appeler existe dans le contrôleur
      if (method_exists($ctrl, $method)) {
         # Si un ID est passé dans l'URL via $_GET['id'] et qu'il est un entier valide
       /*  echo "<br>Test du Get existe.<br><hr>";  */
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
          # Si c'est le cas, on appelle une méthode de lecture ou de suppression : show($_GET['id']) ou delete($_GET['id'])
          $controller->$method($_GET['id']);
        } else {
           # Sinon, on affiche la liste des éléments ou la page d'accueil : index()
          $controller->$method();
        
        }
      }
    }
  }
} catch (Exception $e) {
  die($e->getMessage());
}



require 'inc/footer.php';
