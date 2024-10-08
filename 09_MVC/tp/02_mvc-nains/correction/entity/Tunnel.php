<?php

class Tunnel extends CoreEntity
{

  private $_id;
  private $_progres;
  private $_villedepart;
  private $_villearrivee;

  public function getId()
  {
    return $this->_id;
  }

  public function getProgres()
  {
    return $this->_progres;
  }

  public function getVilledepart()
  {
    return $this->_villedepart;
  }

  public function getVillearrivee()
  {
    return $this->_villearrivee;
  }

  public function setId($_id): void
  {
    $this->_id = $_id;
  }

  public function setProgres($_progres): void
  {
    $this->_progres = $_progres;
  }

  public function setVilledepart($_villedepart): void
  {
    $this->_villedepart = $_villedepart;
  }

  public function setVillearrivee($_villearrivee): void
  {
    $this->_villearrivee = $_villearrivee;
  }
}
