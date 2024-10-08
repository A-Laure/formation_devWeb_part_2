<?php 


  abstract class CoreEntity
  {

    public function __construct(array $data)
    {
      $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
      foreach($data as $key=>$value)
      {
        $key = substr($key, 2);

        if(substr($key, -3) == '_fk')
        {
          $key = substr($key, 0, -3);
        }

        $method = 'set'.ucfirst($key);

        if(method_exists($this, $method))
        {
          $this->$method($value);
        }
      }
    }

  }