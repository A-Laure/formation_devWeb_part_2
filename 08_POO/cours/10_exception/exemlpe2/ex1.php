<?php 

  try{
    throw new Exception("Une erreur est survenue",404);
  }
  catch(Exception $e)
  {

    echo "Code : {$e->getCode()} <br>";
    echo "Message : {$e->getMessage()} <br>";
    echo "Fichier : {$e->getFile()} <br>";
    echo "Ligne : {$e->getLine()} <br>";

  }


