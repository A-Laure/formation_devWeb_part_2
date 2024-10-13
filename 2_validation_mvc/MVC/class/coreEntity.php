<?php

class CoreEntity {

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

}



