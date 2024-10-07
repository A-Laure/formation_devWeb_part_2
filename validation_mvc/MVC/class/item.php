<?php

class Item
{

  # Propriétés

  private int $idItem;
  private string $labelItem;
  private string $ref;
  private float $puht;
  private float $cdt;
  private string $labelTva;
  private int $storeQty;
  private int $stockSecurity;
  private string $nameSppl;
  private string $contact;
  private string $phoneContact;
  private string $orderEmail;
  private string $adr1SpplAdr;
  private string $adr2SpplAdr;
  private string $cpSppladr;
  private string $townSppladr;
  private string $countrySppladr;
  private string $place;
  private string $labelStock;
  private string $lastMoveItem;

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


  # Getters
  public function getIdItem(): int
  {
    return $this->idItem;
  }

  public function getLabelItem(): string
  {
    return $this->labelItem;
  }

  public function getRef(): string
  {
    return $this->ref;
  }

  public function getPuht(): float
  {
    return $this->puht;
  }

  public function getCdt(): float
  {
    return $this->cdt;
  }

  public function getLabelTva(): string
  {
    return $this->labelTva;
  }

  public function getStoreQty(): int
  {
    return $this->storeQty;
  }

  public function getStockSecurity(): int
  {
    return $this->stockSecurity;
  }

  public function getNameSppl(): string
  {
    return $this->nameSppl;
  }

  public function getContact(): string
  {
    return $this->contact;
  }

  public function getPhoneContact(): string
  {
    return $this->phoneContact;
  }

  public function getOrderEmail(): string
  {
    return $this->orderEmail;
  }

  public function getAdr1SpplAdr(): string
  {
    return $this->adr1SpplAdr;
  }

  public function getAdr2SpplAdr(): string
  {
    return $this->adr2SpplAdr;
  }

  public function getCpSppladr(): string
  {
    return $this->cpSppladr;
  }

  public function getTownSppladr(): string
  {
    return $this->townSppladr;
  }

  public function getCountrySppladr(): string
  {
    return $this->countrySppladr;
  }

  public function getPlace(): string
  {
    return $this->place;
  }

  public function getLabelStock(): string
  {
    return $this->labelStock;
  }

  public function getLastMoveItem(): string
  {
    return $this->lastMoveItem;
  }



  # Setters

  public function setIdItem(int $idItem): void
  {
    $this->idItem = $idItem;
  }

  public function setLabelItem(string $labelItem): void
  {
    $this->labelItem = $labelItem;
  }

  public function setRef(string $ref): void
  {
    $this->ref = $ref;
  }

  public function setPuht(float $puht): void
  {
    $this->puht = $puht;
  }

  public function setCdt(float $cdt): void
  {
    $this->cdt = $cdt;
  }

  public function setLabelTva(string $labelTva): void
  {
    $this->labelTva = $labelTva;
  }

  public function setStoreQty(int $storeQty): void
  {
    $this->storeQty = $storeQty;
  }

  public function setStockSecurity(int $stockSecurity): void
  {
    $this->stockSecurity = $stockSecurity;
  }

  public function setNameSppl(string $nameSppl): void
  {
    $this->nameSppl = $nameSppl;
  }

  public function setContact(string $contact): void
  {
    $this->contact = $contact;
  }

  public function setPhoneContact(string $phoneContact): void
  {
    $this->phoneContact = $phoneContact;
  }

  public function setOrderEmail(string $orderEmail): void
  {
    $this->orderEmail = $orderEmail;
  }

  public function setAdr1SpplAdr(string $adr1SpplAdr): void
  {
    $this->adr1SpplAdr = $adr1SpplAdr;
  }

  public function setAdr2SpplAdr(string $adr2SpplAdr): void
  {
    $this->adr2SpplAdr = $adr2SpplAdr;
  }

  public function setCpSppladr(string $cpSppladr): void
  {
    $this->cpSppladr = $cpSppladr;
  }

  public function setTownSppladr(string $townSppladr): void
  {
    $this->townSppladr = $townSppladr;
  }

  public function setCountrySppladr(string $countrySppladr): void
  {
    $this->countrySppladr = $countrySppladr;
  }

  public function setPlace(string $place): void
  {
    $this->place = $place;
  }

  public function setLabelStock(string $labelStock): void
  {
    $this->labelStock = $labelStock;
  }

  public function setLastMoveItem(string $lastMoveItem): void
  {
    $this->lastMoveItem = $lastMoveItem;
  }
}
