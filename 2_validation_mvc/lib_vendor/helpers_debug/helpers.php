<?php

function debug($var) : void
{
  echo '<div class="container col-auto">';
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
  echo '</div>';
}

function dump($element, $textLog = '') : void {
  echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;background-color: #fff;'>";
  echo "<strong>Type:</strong> " . gettype($element) . "<br>";
  echo "<strong>Etape du Log:</strong> " . $textLog . "<br>";
  echo "<strong>Content:</strong> <pre>";
  
  if (is_array($element) || is_object($element)) {
      echo htmlspecialchars(print_r($element, true));
  } else {
      echo htmlspecialchars(var_export($element, true));
  }
  
  echo "</pre></div>";
}

 /** sanitizeData - "nettoie" les données au "bon" format"
 * @param mixed $data
 * @return $data
 */
function sanitizeData($data){
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

