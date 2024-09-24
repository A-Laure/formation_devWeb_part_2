<?php 


class Android extends Cellphone
{

  # par default ce sera en public si on ne précise pas la portée
  function unlock()
  {
    echo 'Je dévérouille mon tel ...';
  }
  

}