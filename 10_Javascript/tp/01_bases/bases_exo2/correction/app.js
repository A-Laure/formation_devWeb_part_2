


function isNumber(n){
  return !isNaN(parseFloat(n));
}


function gradeAverage(grades){

  var average;

  for(let i = 0; i < grades.length; i++){

    if(isNumber(grades[i]) && grades[i] >= 0 && grades[i] <= 20){

      average = ( typeof average !== 'undefined' ? average : 0 );
      average = average + parseFloat(grades[i]);

    }else {
      alert(`La note ${grades[i]} à l'emplacement ${i+1} n'est pas valable. Elle doit être numérique et coimprise entre 0 et 20`);
      average = undefined;
      break;
    }

  }

  average = average / grades.length;
  return average;

}

var toto = [];

do {
  var enter = prompt('Saisissez une note :');
  if(enter !== null){
    toto.push(enter);
  }
}while (enter !== null);




console.log(gradeAverage(toto).toFixed(1));