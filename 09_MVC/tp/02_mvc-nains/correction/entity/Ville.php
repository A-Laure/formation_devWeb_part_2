<?php

class Ville extends CoreEntity
{
  private $_id;
  private $_nom;
  private $_superficie;

  public function getId()
  {
    return $this->_id;
  }

  public function getNom()
  {
    return $this->_nom;
  }

  public function getSuperficie()
  {
    return $this->_superficie;
  }


  public function setId($_id): void
  {
    $this->_id = $_id;
  }

  public function setNom($_nom): void
  {
    $this->_nom = $_nom;
  }

  public function setSuperficie($_superficie): void
  {
    $this->_superficie = $_superficie;
  }
}
