<?php


class StockModel
{

  # Propriétés

  private int $stockId;
  private string $stockLabel;
  private string $stockPlace;

  # Constructeur

  public function __construct(array $data)
  {
    $this->hydrate($data);
  }


  private function hydrate(array $data): void
  {
    foreach ($data as $key => $value) {
      // si vous gardez le prefixage dans la requete SQL des model
      // $methodName = 'set' . ucfirst(substr($key, 2, strlen($key) - 2));

      # On peut faire comme ça car dans toute les requetes on alias tous les noms de colonnes
      $methodName = 'set' . ucfirst($key);

      if (method_exists($this, $methodName)) {
        $this->$methodName($value);
      }
    }
  }

  # GETTERS
  public function getStockId(): int
  {
    return $this->stockId;
  }

  public function getStockLabel(): string
  {
    return $this->stockLabel;
  }

  public function getStockPlace(): string
  {
    return $this->stockPlace;
  }


  # SETTERS
  public function setStockId(int $stockId): void
  {
    $this->stockId = $stockId;
  }

  public function setStockLabel(string $stockLabel): void
  {
    $this->stockLabel = $stockLabel;
  }

  public function setStockPlace(string $stockPlace): void
  {
    $this->stockPlace = $stockPlace;
  }
}
