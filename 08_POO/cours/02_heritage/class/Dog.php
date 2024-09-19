<?php


class Dog extends Animal
{

  private string $coat;

  public function __construct($name, $age, $breed, $weight, $coat)
  {
    parent::__construct($name, $age, $breed, $weight);
    $this->coat = $coat;
  }

  public function eat()
  {
    // echo "Le chien {$this->getName()} mange ses croquettes";
    echo "Le chien {$this->name} mange ses croquettes";
  }


  public function getCoat(): string
  {
    return $this->coat;
  }
  public function setCoat(string $coat): void
  {
    $this->coat = $coat;
  }

  public function bark(){
    echo 'wouf';
  }

}
