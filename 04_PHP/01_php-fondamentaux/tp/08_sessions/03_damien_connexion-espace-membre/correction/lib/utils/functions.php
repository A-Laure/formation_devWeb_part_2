<?php 

function isNotConnected(){

  if(!isset($_SESSION['cem']['connected'])){
    header('Location: ../login.php');
    exit;
  }

}


function userExist(array $users, array $searchedUser) : bool {

  $email = strtolower($searchedUser['email']);
  $pwd = $searchedUser['pwd'];

  foreach($users as $user){

    if($email === $user['email'] && $pwd === $user['pwd']){

      unset($user['pwd']);
      $_SESSION['cem']['connected'] = $user;
      return true;
    }

  }

  $_SESSION['cem']['error'] = 'Mauvais identifiant / mot de passe';
  return false;

}