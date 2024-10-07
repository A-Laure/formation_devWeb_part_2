<?php

class Cabinet
{

  # Propriétés
  private int $idCab;
  private string $nameCab;
  private string $adr1Cab;
  private string $adr2Cab;
  private int $cpCab;
  private string $townCab;
  private string $countryCab;
  private string $lastMoveCab;

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

  public function getIdCab(): int
  {
    return $this->idCab;
  }

  public function getNameCab(): string
  {
    return $this->nameCab;
  }

  public function getAdr1Cab(): string
  {
    return $this->adr1Cab;
  }

  public function getAdr2Cab(): string
  {
    return $this->adr2Cab;
  }

  public function getCpCab(): int
  {
    return $this->cpCab;
  }

  public function getTownCab(): string
  {
    return $this->townCab;
  }

  public function getCountryCab(): string
  {
    return $this->countryCab;
  }

  public function getLastMoveCab(): string
  {
    return $this->lastMoveCab;
  }





  # SETTERS
  public function setIdCab(int $idCab): void
  {
    $this->idCab = $idCab;
  }

  public function setNameCab(string $nameCab): void
  {
    $this->nameCab = $nameCab;
  }

  public function setAdr1Cab(string $adr1Cab): void
  {
    $this->adr1Cab = $adr1Cab;
  }

  public function setAdr2Cab(string $adr2Cab): void
  {
    $this->adr2Cab = $adr2Cab;
  }

  public function setCpCab(int $cpCab): void
  {
    $this->cpCab = $cpCab;
  }

  public function setTownCab(string $townCab): void
  {
    $this->townCab = $townCab;
  }

  public function setCountryCab(string $countryCab): void
  {
    $this->countryCab = $countryCab;
  }

  public function setLastMoveCab(string $lastMoveCab): void
  {
    $this->lastMoveCab = $lastMoveCab;
  }
}
