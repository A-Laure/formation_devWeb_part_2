<?php


class Animal
{

  protected string $name;
  private int $age;
  private string $breed;
  private float $weight;

  public function __construct(string $name, int $age, string $breed, float $weight)
  {
    $this->name = $name;
    $this->age = $age;
    $this->breed = $breed;
    $this->weight = $weight;
  }

  public function growOld(){
    $this->age++;
  }

  public function eat(){
    echo "l'animal mange ...";
  }


  // Getters
  public function getName(): string
  {
    return $this->name;
  }

  public function getAge(): int
  {
    return $this->age;
  }

  public function getBreed(): string
  {
    return $this->breed;
  }

  public function getWeight(): float
  {
    return $this->weight;
  }


  // Setters
  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function setAge(int $age): void
  {
    $this->age = $age;
  }

  public function setBreed(string $breed): void
  {
    $this->breed = $breed;
  }

  public function setWeight(float $weight): void
  {
    $this->weight = $weight;
  }
}
