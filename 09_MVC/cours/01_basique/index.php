<?php


require_once 'config/config.php';
require_once 'class/User.php';

require_once 'models/CoreModel.php';
require_once 'models/UserModel.php';

require_once 'controllers/UserController.php';

require 'inc/head.php';


// $ctrl = new UserController();
// $ctrl->index();

// $ctrl = new UserController();
// $ctrl->show(6);

# On est censé avoir ce genre d'url
# index.php?ctrl=user&action=index
# index.php?ctrl=user&action=show&id=6



#### ON AUTOMATISE L'INSTANCIATION D'UN CONTROLLER AVEC L'APPEL D'UNE DE SES METHODES GRACE AUX PARAMETRES PASSES EN URL

# On donne a $ctrl une valeur par default (pour la premier ou on arrive sur l'app)
$ctrl = 'UserController';
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

try {
  # On vérifie que la classe du controller existe (controlleur par défault ou récupéré du $_GET['ctrl'])
  if (class_exists($ctrl)) {
    # Si il existe on instancie la classe controlleur
    $controller = new $ctrl();

    # On gere la création ou la mise a jour d'un élément
    # Si on reçoit des données (POST) via un formulaire ( ici on aura create($_POST) ou update($_GET['id], $_POST) )
    if (!empty($_POST)) {

      if (method_exists($ctrl, $method)) {
        # On vérifie si on a un $_GET['id'] qu'il n'est pas vide et du type numérique
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
          # update($_GET['id], $_POST)
          $controller->$method($_GET['id'], $_POST);
        } else {
          # create($_POST)
          $controller->$method($_POST);
        }
      }
    } else {

      if (method_exists($ctrl, $method)) {
        # On vérifie si on a un $_GET['id'] qu'il n'est pas vide et du type numérique
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
          # show($_GET['id']) ou delete($_GET['id'])
          $controller->$method($_GET['id']);
        } else {
          # index()
          $controller->$method();
        }
      }
    }
  }
} catch (Exception $e) {
  die($e->getMessage());
}






require 'inc/foot.php';
