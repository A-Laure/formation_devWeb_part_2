<?php

class Taverne extends CoreEntity
{

  private $_id;
  private $_nom;
  private $_chamebres;
  private $_chamebresLibres;
  private $_blonde;
  private $_brune;
  private $_rousse;
  private $_ville;

  public function getId()
  {
    return $this->_id;
  }

  public function getNom()
  {
    return $this->_nom;
  }

  public function getChamebres()
  {
    return $this->_chamebres;
  }

  public function getChamebresLibres()
  {
    return $this->_chamebresLibres;
  }

  public function getBlonde()
  {
    return $this->_blonde;
  }

  public function getBrune()
  {
    return $this->_brune;
  }

  public function getRousse()
  {
    return $this->_rousse;
  }

  public function getVille()
  {
    return $this->_ville;
  }


  public function setId($_id): void
  {
    $this->_id = $_id;
  }

  public function setNom($_nom): void
  {
    $this->_nom = $_nom;
  }

  public function setChamebres($_chamebres): void
  {
    $this->_chamebres = $_chamebres;
  }

  public function setChamebresLibres($_chamebresLibres): void
  {
    $this->_chamebresLibres = $_chamebresLibres;
  }

  public function setBlonde($_blonde): void
  {
    $this->_blonde = $_blonde;
  }

  public function setBrune($_brune): void
  {
    $this->_brune = $_brune;
  }

  public function setRousse($_rousse): void
  {
    $this->_rousse = $_rousse;
  }

  public function setVille($_ville): void
  {
    $this->_ville = $_ville;
  }
}
