<?php


class Sppladr
{


  # Propriétés
  private int $id;
  private string $adr1;
  private string $adr2;
  private int $cp;
  private string $town;
  private string $country;
  private string $lastMove;



  # Constructeur

  public function __construct(array $data)
  {
    $this->hydrate($data);
  }


  private function hydrate(array $data): void
  {
    foreach ($data as $key => $value) {
      // si vous gardez le prefixage dans la requete SQL des model
      $methodName = 'set' . ucfirst(substr($key, 5, strlen($key) - 5));

      # On peut faire comme ça car dans toute les requetes on alias tous les noms de colonnes
      // $methodName = 'set' . ucfirst($key);

      if (method_exists($this, $methodName)) {
        $this->$methodName($value);
      }
    }
  }


  # GETTERS

  public function getId(): int
  {
    return $this->id;
  }

  public function getAdr1(): string
  {
    return $this->adr1;
  }

  public function getAdr2(): string
  {
    return $this->adr2;
  }

  public function getCp(): int
  {
    return $this->cp;
  }

  public function getTown(): string
  {
    return $this->town;
  }

  public function getCountry(): string
  {
    return $this->country;
  }

  public function getLastMove(): string
  {
    return $this->lastMove;
  }




  # SETTERS
  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function setAdr1(string $adr1): void
  {
    $this->adr1 = $adr1;
  }

  public function setAdr2(string $adr2): void
  {
    $this->adr2 = $adr2;
  }

  public function setCp(int $cp): void
  {
    $this->cp = $cp;
  }

  public function setTown(string $town): void
  {
    $this->town = $town;
  }

  public function setCountry(string $country): void
  {
    $this->country = $country;
  }

  public function setLastMove(string $lastMove): void
  {
    $this->lastMove = $lastMove;
  }
}
