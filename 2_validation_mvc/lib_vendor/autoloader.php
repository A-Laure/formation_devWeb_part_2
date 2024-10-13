<?php 

/* Cette fonction est un chargeur automatique de classes, conçu pour inclure automatiquement les fichiers PHP contenant la définition d'une classe chaque fois qu'une classe est utilisée sans avoir été préalablement incluse manuellement avec require ou include.
 */

 # AUTOLOAD CONTROLLER

 function loadController( string $controller)
 {
   if(file_exists('MVC/controllers/'.$controller.'.php'))
   {
     require_once 'MVC/controllers/'.$controller.'.php';
   }
 }

 spl_autoload_register('loadController');


  # AUTOLOAD MODEL

 function loadModel(string $model)
 {
   if(file_exists('MVC/models/'.$model.'.php'))
   {
     require_once 'MVC/models/'.$model.'.php';
   }
 }

 spl_autoload_register('loadModel');


  # AUTOLOAD CLASS
 function loadClass(string $class)
 {
   if(file_exists('MVC/class/'.$class.'.php'))
   {
     require_once 'MVC/class/'.$class.'.php';
   }
 }

 spl_autoload_register('loadClass');