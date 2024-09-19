<?php 


class Parrot extends Bird {

  private array $learnedWords = [];

  public function __construct($name, $age, $breed, $weight){
    parent::__construct($name, $age, $breed, $weight);
  }

  public function learnWord($word){
    if($this->knowedWord($word)){
      echo "{$this->getName()} connait déjà ce mot";
    }else{
      $this->learnedWords[] = $word;
    }  
  }


  public function knowedWord($word){
    return in_array($word, $this->learnedWords);
  }

}