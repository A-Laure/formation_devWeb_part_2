<?php


class Nain extends CoreEntity
{

  private $_id;
  private $_nom;
  private $_barbe;
  private $_groupe;
  private $_ville;
  private $_natale;
  private $_taverneNom;
  private $_taverne;
  private $_debuttravail;
  private $_fintravail;
  private $_depart;
  private $_villedepart;
  private $_arrivee;
  private $_villearrivee;

  public function getId()
  {
    return $this->_id;
  }

  public function getNom()
  {
    return $this->_nom;
  }

  public function getBarbe()
  {
    return $this->_barbe;
  }

  public function getGroupe()
  {
    return $this->_groupe;
  }

  public function getNatale()
  {
    return $this->_natale;
  }

  public function getVille()
  {
    return $this->_ville;
  }

  public function getTaverneNom()
  {
    return $this->_taverneNom;
  }

  public function getTaverne()
  {
    return $this->_taverne;
  }

  public function getDebuttravail()
  {
    return $this->_debuttravail;
  }

  public function getFintravail()
  {
    return $this->_fintravail;
  }

  public function getDepart()
  {
    return $this->_depart;
  }

  public function getVilledepart()
  {
    return $this->_villedepart;
  }

  public function getArrivee()
  {
    return $this->_arrivee;
  }

  public function getVillearrivee()
  {
    return $this->_villearrivee;
  }

  public function setId($_id): void
  {
    $this->_id = $_id;
  }

  public function setNom($_nom): void
  {
    $this->_nom = $_nom;
  }

  public function setBarbe($_barbe): void
  {
    $this->_barbe = $_barbe;
  }

  public function setGroupe($_groupe): void
  {
    $this->_groupe = $_groupe;
  }

  public function setVille($_ville): void
  {
    $this->_ville = $_ville;
  }

  public function setNatale($_natale): void
  {
    $this->_natale = $_natale;
  }

  public function setTaverneNom($_taverneNom): void
  {
    $this->_taverneNom = $_taverneNom;
  }

  public function setTaverne($_taverne): void
  {
    $this->_taverne = $_taverne;
  }

  public function setDebuttravail($_debuttravail): void
  {
    $this->_debuttravail = $_debuttravail;
  }

  public function setFintravail($_fintravail): void
  {
    $this->_fintravail = $_fintravail;
  }

  public function setDepart($_depart): void
  {
    $this->_depart = $_depart;
  }

  public function setVilledepart($_villedepart): void
  {
    $this->_villedepart = $_villedepart;
  }

  public function setArrivee($_arrivee): void
  {
    $this->_arrivee = $_arrivee;
  }

  public function setVillearrivee($_villearrivee): void
  {
    $this->_villearrivee = $_villearrivee;
  }
}
