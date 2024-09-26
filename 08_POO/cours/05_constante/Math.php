<?php 

class Math 
{

  public const PI = 3.14;


  public function calcul($a, $b)
  {
    return ($a*$b) + self::PI;
  }


}

$math = new Math();
echo $math->calcul(2,1);