<?php 

  function nextQuestion(int $totalQuestions, int &$currentQuestion){

    if($currentQuestion < $totalQuestions){
      $currentQuestion++;
    }

  }