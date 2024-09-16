<?php
  session_start();

  require 'db/data.php';
  require 'lib/utils/functions.php';

  if(isset($_POST['email']) && isset($_POST['pwd'])){
    if(!empty($_POST['email']) && !empty($_POST['pwd'])){

    //   $email = strtolower($_POST['email']);
    //   $pwd = $_POST['pwd'];

    //   foreach($users as $user){

    //     if($email === $user['email'] && $pwd === $user['pwd']){

    //       unset($user['pwd']);
    //       $_SESSION['cem']['connected'] = $user;
    //       header('Location: admin/dashboard.php');
    //       exit;
    //     }

    //   }

    // }

    // header('Location: login.php');
    // exit;

      $result = userExist($users, $_POST);

      $result ? header('Location: admin/dashboard.php') : header('Location: login.php');

    }
  }

