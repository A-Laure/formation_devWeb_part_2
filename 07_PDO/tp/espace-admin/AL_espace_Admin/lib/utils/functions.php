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

    if($email === $user['user_email'] && $pwd === $user['user_pwd']){

      unset($user['user_pwd']);
      $_SESSION['cem']['connected'] = $user;
      return true;
    }

  }

  $_SESSION['cem']['error'] = 'Mauvais identifiant / mot de passe';
  return false;

}