<?php 

class Cat extends Animal {

  private string $coat;

  public function __construct($name, $age, $breed, $weight, $coat)
  {
    parent::__construct($name, $age, $breed, $weight);
    $this->coat = $coat;
  }

  public function eat()
  {
    echo "Le Chat {$this->name} mange dans ton assiette.";
  }


  public function getCoat(): string
  {
    return $this->coat;
  }
  public function setCoat(string $coat): void
  {
    $this->coat = $coat;
  }

  public function meow() {
    echo 'Miaou';
  }

}