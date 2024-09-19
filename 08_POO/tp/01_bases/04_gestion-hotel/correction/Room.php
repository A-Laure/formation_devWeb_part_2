<?php


class Room
{

  private int $number;
  private string $type;
  private float $nightPrice;
  private string $client;

  public function __construct(int $number, string $type, float $nightPrice, string $client = '')
  {
    $this->number = $number;
    $this->type = $type;
    $this->nightPrice = $nightPrice;
    $this->client = $client;
  }


  // Affichage 
  // Method magique toString
  public function __toString()
  {
    return "Numéro : {$this->number}, <br>
            Type : {$this->type},<br> 
            Prix par nuit : {$this->nightPrice}, <br>;
            Réservé par : " . $this->client != '' ? $this->client : 'Libre'." <br>";
  }


  // Methode pour afficher les détails
  public function displayDetails(): string
  {

    return "Numéro : {$this->number}, <br>
            Type : {$this->type},<br> 
            Prix par nuit : {$this->nightPrice}, <br>
            Réservé par : " . ($this->client != '' ? $this->client : 'Libre')." <br>";
  }


  // Getters
  public function getNumber(): int
  {
    return $this->number;
  }

  public function getType(): string
  {
    return $this->type;
  }

  public function getNightPrice(): float
  {
    return $this->nightPrice;
  }

  public function getClient(): string
  {
    return $this->client;
  }



  // Setters
  public function setNumber(int $number): void
  {
    $this->number = $number;
  }

  public function setType(string $type): void
  {
    $this->type = $type;
  }

  public function setNightPrice(float $nightPrice): void
  {
    $this->nightPrice = $nightPrice;
  }

  public function setClient(string $client): void
  {
    $this->client = $client;
  }
}
