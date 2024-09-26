<?php

class Message
{

  private $_id;
  private $_date;
  private $_hour;
  private $_author;
  private $_message;


  public function __construct(array $data)
  {
    $this->hydrate($data);
  }


  private function hydrate(array $data) :void
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
  public function getId() : int
  {
    return $this->_id;
  }

  public function getDate() : string
  {
    return $this->_date;
  }

  public function getHour() : string
  {
    return $this->_hour;
  }

  public function getAuthor() : string
  {
    return $this->_author;
  }

  public function getMessage() : string
  {
    return $this->_message;
  }


  # SETTERS
  public function setId(int $_id): void
  {
    $this->_id = $_id;
  }

  public function setDate(string $_date): void
  {
    $this->_date = $_date;
  }

  public function setHour(string $_hour): void
  {
    $this->_hour = $_hour;
  }

  public function setAuthor(string $_author): void
  {
    $this->_author = $_author;
  }

  public function setMessage(string $_message): void
  {
    $this->_message = $_message;
  }

  
}
