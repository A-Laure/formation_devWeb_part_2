<?php

function debug($var)
{
  echo '<div class="container col-auto">';
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
  echo '</div>';
}
