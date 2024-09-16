<?php 

  include 'functions/_helpers/tools.php';


  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $cpwd = $_POST['cpwd'];

  # double $ automatise le stockages des valeurs dans des varialbes avec comme nom de variable la clé du tableau 

  foreach($_POST as $key => $value){
    $$key = $value;
    // $'email' = 'kenbg34@gmail.com';
    // $email = 'kenbg34@gmail.com';
  }



?>



<?php debug($_POST); ?>
