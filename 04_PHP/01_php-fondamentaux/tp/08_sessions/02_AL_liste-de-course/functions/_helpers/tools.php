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
