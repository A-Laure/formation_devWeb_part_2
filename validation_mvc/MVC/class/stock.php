<?php


class Stock
{

  # Propriétés

  private int $id;
  private string $label;
  private string $place;


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

  public function getLabel(): string
  {
    return $this->label;
  }

  public function getPlace(): string
  {
    return $this->place;
  }





  # SETTERS
  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function setLabel(string $label): void
  {
    $this->label = $label;
  }

  public function setPlace(string $place): void
  {
    $this->place = $place;
  }
}