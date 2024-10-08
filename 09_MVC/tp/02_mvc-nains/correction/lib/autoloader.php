<?php 

  function loadController( string $controller)
  {
    if(file_exists('controllers/'.$controller.'.php'))
    {
      require_once 'controllers/'.$controller.'.php';
    }
  }

  spl_autoload_register('loadController');


  function loadModel(string $model)
  {
    if(file_exists('models/'.$model.'.php'))
    {
      require_once 'models/'.$model.'.php';
    }
  }

  spl_autoload_register('loadModel');


  function loadEntity(string $entity)
  {
    if(file_exists('entity/'.$entity.'.php'))
    {
      require_once 'entity/'.$entity.'.php';
    }
  }

  spl_autoload_register('loadEntity');