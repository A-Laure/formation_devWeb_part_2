<?php 
session_start();

 $title = 'Dashboard';
 $currentPage = 'dashboard';

 include '../inc/head.php';
 include '../inc/navbar.php';
 include '../lib/_helpers/tools.php';

?>

  <div class="container">

    <h1 class="my-5" > Bienvenue <?= $_SESSION['cem']['connected']['user']['user_name'] ?></h1>

    

    <?php     
    debug($_SESSION['cem']['connected']) ?>
    </div>


<?php include '../inc/foot.php'; ?>
