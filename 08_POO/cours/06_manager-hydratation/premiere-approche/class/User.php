<?php

class User
{
  private $_id;
  private $_login;
  private $_mdp;
  private $_role;
  private $_libelle;


  public function __construct($data)
  {
    $this->hydrate($data);
  }


  private function hydrate($data)
  {
    foreach($data as $key => $value)
    {
      # On vient stocker dans une variable la chaine de caractère qui correspondra au nom de la méthode des setter pour automatiser l'appel des setter pour enregister les données dans les proprietes
      # ici on prend le pattern 'set' et on le concatène le nom de la colonne moins le prefixe et la premier lettre en majuscule  
      $methodName = 'set'.ucfirst(substr($key, 4, strlen($key)-4));

      # au cas ou pas de prefixe sur les nom de colonne
      // $methodName = 'set'.ucfirst($key);

      if(method_exists($this, $methodName))
      {
        $this->$methodName($value);
        # ex : $this->setLogin($value)
      }
    }
  }



  public function getId()
  {
    return $this->_id;
  }

  public function getLogin()
  {
    return $this->_login;
  }

  public function getMdp()
  {
    return $this->_mdp;
  }

  public function getRole()
  {
    return $this->_role;
  }

  public function getLibelle()
  {
    return $this->_libelle;
  }

  public function setId($_id): void
  {
    $this->_id = $_id;
  }

  public function setLogin($_login): void
  {
    $this->_login = $_login;
  }

  public function setMdp($_mdp): void
  {
    $this->_mdp = $_mdp;
  }

  public function setRole($_role): void
  {
    $this->_role = $_role;
  }

  public function setLibelle($_libelle): void
  {
    $this->_libelle = $_libelle;
  }
}
