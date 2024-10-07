<?php

class User
{

  # Propriétés
  private int $idUser;
  private string $firstName;
  private string $lastName;
  private string $email;
  private string $pwd;
  private string $roleId;
  private string $rolelabel;
  private int $rolepower;
  // private string $lastMove;

  # Constructeur
  public function __construct($data)
  {
    $this->hydrate($data);
  }


  private function hydrate($data)
  {
    foreach ($data as $key => $value) {
      # On vient stocker dans une variable la chaine de caractère qui correspondra au nom de la méthode des setter pour automatiser l'appel des setter pour enregister les données dans les proprietes
      # ici on prend le pattern 'set' et on le concatène le nom de la colonne moins le préfixe et la premier lettre en majuscule  
      $methodName = 'set' . ucfirst(substr($key, 5, strlen($key) - 5));

      # au cas ou pas de prefixe sur les nom de colonne
      // $methodName = 'set'.ucfirst($key);

      if (method_exists($this, $methodName)) {
        $this->$methodName($value);
        # ex : $this->setLogin($value)
      }
    }
  }

  # Getters

  public function getIdUser(): int
  {
    return $this->idUser;
  }

  public function getFirstName(): string
  {
    return $this->firstName;
  }

  public function getLastName(): string
  {
    return $this->lastName;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function getPwd(): string
  {
    return $this->pwd;
  }

  public function getRoleId(): string
  {
    return $this->roleId;
  }

  public function getRolelabel(): string
  {
    return $this->rolelabel;
  }

  public function getRolepower(): int
  {
    return $this->rolepower;
  }

  // public function getLastMove(): string
  // {
  //   return $this->lastMove;
  // }








  # Setters

  public function setIdUser(int $idUser): void
  {
    $this->idUser = $idUser;
  }

  public function setFirstName(string $firstName): void
  {
    $this->firstName = $firstName;
  }

  public function setLastName(string $lastName): void
  {
    $this->lastName = $lastName;
  }

  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  public function setPwd(string $pwd): void
  {
    $this->pwd = $pwd;
  }

  public function setRoleId(string $roleId): void
  {
    $this->roleId = $roleId;
  }

  public function setRolelabel(string $rolelabel): void
  {
    $this->rolelabel = $rolelabel;
  }

  public function setRolepower(int $rolepower): void
  {
    $this->rolepower = $rolepower;
  }

  // public function setLastMove(string $lastMove): void
  // {
  //   $this->lastMove = $lastMove;
  // }
}
