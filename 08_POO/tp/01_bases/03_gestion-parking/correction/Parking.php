<?php 


class Parking {

  private array $cars;


  public function __construct(array $cars = []){
    $this->cars = $cars;
  }
  
  // Sans le spread operator on doit mettre les [] pour ajouter a la fin du tableau
  // public function addCar(Car $car){
  //   $this->cars[] = $car;
  // }



  // Avec le spread operator pas besoin de mettre les [] car $car en parametre sera un tableau meme si il n'y a qu'un seul élément
  public function addCar(Car ...$car){
    $this->cars = $car;
  }


  // Methode pour afficher les détails
  public function displayAllCars(){
    if(empty($this->cars)){
      echo "Le parking est vide.<br>";
    }else {
      foreach($this->cars as $car){
        echo $car->displayDetails();
      }
    }
  }

  // Methode pour rechercher une voiture par son immatriculation
  public function findOne(string $registration) : string{
   foreach($this->cars as $key => $car){
    if($car->getRegistration() === $registration){

      return $car->displayDetails();

    }
   }
   return "La voiture avec l'immatriculation {$registration} ne se trouve pas dans le parking.";
  }


  // Methode pour rechercher une voiture par son immatriculation
  public function deleteCar(string $registration) : string{
   foreach($this->cars as $key => $car){
    if($car->getRegistration() === $registration){
      unset($this->cars[$key]);
      return "La voiture avec l'immatriculation {$registration} a bien été supprimé du parking.";

    }
   }
   return "La voiture avec l'immatriculation {$registration} ne se trouve pas dans le parking.";
  }

}