<?php 


class Car{

  private string $registration;
  private string $brand;
  private string $color;


  public function __construct(array $datas)
  {
    
    foreach($datas as $key => $value )
    {

      // assigne par propriete
      // $this->$key = $value;

      // assigne par le setter
      $methodName = 'set'.ucfirst($key);
      if(method_exists($this, $methodName)){
        $this->$methodName($value);
        // $this->setRegistration($value);
        // $this->setBrand($value);
        // $this->setColor($value);
      }
      
    }


  }

  // Method magique toString
  public function __toString()
  {
    return "Immatriculation : {$this->registration}, <br>
            Marque : {$this->brand},<br> 
            Couleur : {$this->color} <br>";
  }


  // Methode pour afficher les détails
  public function displayDetails() : string {

    return "Immatriculation : {$this->registration}, <br>
            Marque : {$this->brand},<br> 
            Couleur : {$this->color} <br><br>";

  }


  // Getters 
  public function getRegistration() : string {
    return $this->registration;
  }

  public function getBrand() : string {
    return $this->brand;
  }

  public function getColor() : string {
    return $this->color;
  }


  // Setters 
  public function setRegistration(string $value){
    $this->registration = $value;
  }

  public function setBrand(string $value){
    $this->brand = $value;
  }

  public function setColor(string $value){
    $this->color = $value;
  }

}