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

function debugSession($sessionkeyName){
  if (!isset($session[$sessionkeyName])) {
    echo "Liste vide";
  } else {
    var_dump($session[$sessionkeyName]);
  }
  }
