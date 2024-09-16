<?php

function debug($var)
{
  echo '<hr>';
  echo '<div class="container">';
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
  echo '</div>';
}


#CONNEXION A A LA BDD, les constantes définies via define dans admin/config/config.php
		// bonne prtaique de mettre les ":", protège du renvoi, sûr que ce sera ce que l'on souhaite
    function dbConnect(): PDO {
      try {
        $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $pdo;
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    }



?>
