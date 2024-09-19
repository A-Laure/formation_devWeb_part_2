<?php 

class Hotel {

  private array $rooms = [];

  public function __construct(){

  }


  public function addRoom(Room $room){
    $this->rooms[] = $room;
  }

  public function displayFreeRoom() : void {
    if(empty($this->rooms)){
      echo "Il n'y a pas de chambres disponible.";
    }else{
      foreach($this->rooms as $room){
        echo $room->displayDetails();
      }
    }
  }

  public function bookRoom(int $number, string $client) : Room {
    if(empty($this->rooms)){
      echo "Il n'y a pas de chambres disponible.";
    }else{
      foreach($this->rooms as $key => $room){
        if($room->getNumber() === $number ){
          unset($this->rooms[$key]);
          $room->setClient($client);
          echo "La chambre n°$number a bien été réservée.";
          return $room;
        }
        
      }
    }
  }

  public function totalCost(Room $room, int $totalNight) : string{

    $totalCost = $room->getNightPrice() * $totalNight;
    return "Le coût total pour $totalNight nuits dans la chambre numéro {$room->getNumber()} est de $totalCost ";

  }





}