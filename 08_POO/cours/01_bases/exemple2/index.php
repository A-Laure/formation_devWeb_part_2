<?php
  require 'Person.php';

  $paul = new Person('Paul', 22, 'Homme', 'es');
  echo $paul->getName();
  echo '<br>';
  echo $paul->speak();
  echo '<br>';  
  echo $paul->growOld();
  echo '<br>'; 
  echo $paul->growOld();
  echo '<br>'; 
  echo $paul->growOld();