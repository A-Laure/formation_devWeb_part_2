<?php

/*
Les codes ERREURS les plus courants sont :
200 : succès de la requête ;
301 et 302 : redirection, respectivement permanente et temporaire ;
401 : utilisateur non authentifié ;
402 : pour paiement;
403 : accès refusé ;
404 : ressource non trouvée ;
408 : trop de temps;
500, 502 et 503 : erreurs serveur ;
504 : le serveur n'a pas répondu.
*/

// UTILISé DANS NAVBAR / pas besoin de return car void
function isNotConnected(): void
{
  if (!isset($_SESSION[APP_TAG]['connected'])) {
    //err=401 s'affichera ds l'url
    header('Location: ../views/login.php?_err=401');
    exit;
  }
}





// ATTENTION, PEUT POSER PB, VOIR user_edit de Damien et rajouter le if qui est avant la fonction
/** redirectNotAllowed - N'est pas autorisé à modifier un autre utilisateur que lui, donc redirection vers la page user_list
 * 
 * @param array $userAuthorization
 * @param int $authorization (l'id ds la table autorisation)
 * @return void
 */

function redirectNotAllowed(array $userAuthorization, int $authorization): void
{
  if (!in_array($authorization, $userAuthorization)) { // in_array,si je n'ai pas ds le tableau, redirection 
    // il aurait été mieux en terme de sécu de refaire appel à la BDD au cas où il y ait eu un changement de pouvoir en parallèle et non de prendre le pouvoir récupéré lors de la connexion qui a pu changer depuis la connexion
    header('Location: ../views/user_list.php?_err=403'); // pas les droits necessaires
  }
}


/** type pdo: est un objet
 * hasPower - vérifie si l'utilisateur a le pouvoir d'utiliser ce rôle, on récupère tous ces povoir / 
 * 
 * @param PDO $pdo // on veut se connecter à la base
 * @param int $role
 * @param int $userPower
 * @return bool
 */

function hasPower(PDO $pdo, int $role, $userPower): bool
{
  // pour qu'il ne continue pas dès ce if et n'execute pas le reste
  // on met !== false au cas où le résultat du fecth renvoi 0 ou null qui sont interprétés comme false dans un if = faux false

  $query = 'SELECT role_power from roles where role_Id = :role_Id';

  if (($request = $pdo->prepare($query)) !== false) {
    // les if ne sont pas obligatoires
    if ($request->bindvalue(':role_Id', $role, PDO::PARAM_INT)) {

      if ($request->execute()) {

        if (($result = $request->fetch(PDO::FETCH_ASSOC)) !== false) {

        // echo '<pre>';
        // echo 'LOG Function hasPower   ';
        // var_dump($result);
        // echo '<pre>';


          if ($result['role_power'] >= $userPower || $userPower == 1) {
            return true;
          }
        }
      }
    }
  }
  return false;
}



/** getRole - on récupère le rôle de l'utlisateur passé en paramètre qui permettra de voir si il a les droits ou non pour une 'action'
 * 
 * @param PDO $pdo // on veut se connecter à la base
 * @param int $user
 * @return int
 */

// je récupère l'id de la personne connectée pour voir son rôle
// on va appeller dans la page voulue :  getRole($pdo, $_GET['id])
function getRole(PDO $pdo, int $user): int
{
  if (($request = $pdo->prepare('SELECT user_role from users where user_Id = :id')) !== false) {

    if ($request->bindvalue(':id', $user)) {

      if ($request->execute()) {

        if (($result = $request->fetch(PDO::FETCH_ASSOC)) !== false) {

          return $result['user_role'];
        }
      }
    }
  }
  return 0; // 0 = false
}










# A REVALIDER OU SUPPRIMER

// CALCUL ENTREE/SORTIE STOCK

function newSTock($oldStock, $plus, $less)
{
  $newStock = $oldStock + $plus - $less;
  return $newStock;
}
