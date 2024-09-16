<?php

function sanitizeData($data){
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}


function sanitizePost($key, $filter = FILTER_SANITIZE_SPECIAL_CHARS){

  if(isset($_POST[$key])){

    $data = trim($_POST[$key]);

    $data = filter_var($data, $filter);

    return $data;

  }
  return null;

}


function email($data){
  filter_var($data, FILTER_SANITIZE_EMAIL);
}


/**
 *  isNotConnected - Redirige vers le login si l'utilisateur n'est pas connecter 
 * 
 * Si pas de $_SESSION on redirige vers login.php ( au cas ou un petit malin taperait directement l'url pour essayer d'acceder a la partie admin)
 * 
 * @return void
 * 
 */

function isNotConnected() : void {
    if(!isset($_SESSION[APP_TAG]['connected'])){
      header('Location: ../login.php?_err=401');
      exit;
    }
}


/**
 * redirectNotAllowed - Redirige vers la page liste utilisateur
 * 
 * @param array $userAuthorization 
 * @param int $authorization 
 * @return void
 */
function redirectNotAllowed(array $userAuthorization, int $authorization) : void{

  if(!in_array($authorization, $userAuthorization)){
    header('Location: userList.php?_err=403');
    exit;
  }

}


/**
 * hasPower - Vérifie si l'utilisateur a le pouvoir d'utiliser ce role
 * 
 * @param PDO $pdo
 * @param int $role
 * @param int $userPower
 * @return bool
 * 
*/
function hasPower(PDO $pdo,int $role,int $userPower) : bool{

  if(($request = $pdo->prepare('SELECT rol_pouvoir FROM role WHERE rol_id = :role')) !== false){

    if($request->bindValue(':role', $role)){

      if($request->execute()){

        if(($result = $request->fetch(PDO::FETCH_ASSOC)) !== false){

          if($result['rol_pouvoir'] >= $userPower || $userPower == 1){
            return true;
          }
        }
      }
    }
  }
  return false;
}


/**
 * getRole - Récupère le role de l'utilisateur passé en paramètre
 *  @param PDO $pdo
 *  @param int $user
 *  @return int
 */
function getRole(PDO $pdo, int $user) : int{

  if(($request = $pdo->prepare('SELECT use_role FROM user WHERE use_id = :id')) !== false){

    if($request->bindValue(':id', $user)){

      if($request->execute()){

        if(($result = $request->fetch(PDO::FETCH_ASSOC)) !== false){

          return $result['use_role'];

        }

      }

    }

  }
  return 0; // false
 
}









// tools
/**
 * debug - Affiche les données avec un var_dump de façon esthétique
 * @param mixed $var
 * 
 */
function debug(mixed $var) : void
{
  echo '<hr>';
  echo '<div class="container">';
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
  echo '</div>';
}


