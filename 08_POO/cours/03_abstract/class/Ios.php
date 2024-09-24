<?php 


class Ios extends Cellphone
{


  # par default ce sera en public si on ne précise pas la portée
  function unlock()
  {
    $tel = 'Iphone';
    echo "Je dévérouille mon $tel";
  }

  

}