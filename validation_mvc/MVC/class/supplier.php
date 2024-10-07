<?php


class Supplier
{

  # Propriétés

  private int $spplId;
  private string $spplName;
  private string $spplContact;
  private string $spplPhoneContact;
  private string $spplOrderMail;
  private string $spplLastMove;
  private int $spplAdrId;
  private string $spplAdr1;
  private string $spplAdr2;
  private string $spplCp;
  private string $spplTown;
  private string $sppCountry;
  private string $spplAdrLastMove;


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
  public function getSpplId(): int
  {
    return $this->spplId;
  }

  public function getSpplName(): string
  {
    return $this->spplName;
  }

  public function getSpplContact(): string
  {
    return $this->spplContact;
  }

  public function getSpplPhoneContact(): string
  {
    return $this->spplPhoneContact;
  }

  public function getSpplOrderMail(): string
  {
    return $this->spplOrderMail;
  }

  public function getSpplLastMove(): string
  {
    return $this->spplLastMove;
  }

  public function getSpplAdrId(): int
  {
    return $this->spplAdrId;
  }

  public function getSpplAdr1(): string
  {
    return $this->spplAdr1;
  }

  public function getSpplAdr2(): string
  {
    return $this->spplAdr2;
  }

  public function getSpplCp(): string
  {
    return $this->spplCp;
  }

  public function getSpplTown(): string
  {
    return $this->spplTown;
  }

  public function getSppCountry(): string
  {
    return $this->sppCountry;
  }

  public function getSpplAdrLastMove(): string
  {
    return $this->spplAdrLastMove;
  }




  # SETTERS

  public function setSpplId(int $spplId): void
  {
    $this->spplId = $spplId;
  }

  public function setSpplName(string $spplName): void
  {
    $this->spplName = $spplName;
  }

  public function setSpplContact(string $spplContact): void
  {
    $this->spplContact = $spplContact;
  }

  public function setSpplPhoneContact(string $spplPhoneContact): void
  {
    $this->spplPhoneContact = $spplPhoneContact;
  }

  public function setSpplOrderMail(string $spplOrderMail): void
  {
    $this->spplOrderMail = $spplOrderMail;
  }

  public function setSpplLastMove(string $spplLastMove): void
  {
    $this->spplLastMove = $spplLastMove;
  }

  public function setSpplAdrId(int $spplAdrId): void
  {
    $this->spplAdrId = $spplAdrId;
  }

  public function setSpplAdr1(string $spplAdr1): void
  {
    $this->spplAdr1 = $spplAdr1;
  }

  public function setSpplAdr2(string $spplAdr2): void
  {
    $this->spplAdr2 = $spplAdr2;
  }

  public function setSpplCp(string $spplCp): void
  {
    $this->spplCp = $spplCp;
  }

  public function setSpplTown(string $spplTown): void
  {
    $this->spplTown = $spplTown;
  }

  public function setSppCountry(string $sppCountry): void
  {
    $this->sppCountry = $sppCountry;
  }

  public function setSpplAdrLastMove(string $spplAdrLastMove): void
  {
    $this->spplAdrLastMove = $spplAdrLastMove;
  }
}
