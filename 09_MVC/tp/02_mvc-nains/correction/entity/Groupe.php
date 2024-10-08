<?php

class Groupe extends CoreEntity
{
  private $_id;
  private $_debutravail;
  private $_fintravail;
  private $_taverne;
  private $_tunnel;

  public function getId()
  {
    return $this->_id;
  }

  public function getDebutravail()
  {
    return $this->_debutravail;
  }

  public function getFintravail()
  {
    return $this->_fintravail;
  }

  public function getTaverne()
  {
    return $this->_taverne;
  }

  public function getTunnel()
  {
    return $this->_tunnel;
  }


  public function setId($_id): void
  {
    $this->_id = $_id;
  }

  public function setDebutravail($_debutravail): void
  {
    $this->_debutravail = $_debutravail;
  }

  public function setFintravail($_fintravail): void
  {
    $this->_fintravail = $_fintravail;
  }

  public function setTaverne($_taverne): void
  {
    $this->_taverne = $_taverne;
  }

  public function setTunnel($_tunnel): void
  {
    $this->_tunnel = $_tunnel;
  }
}
