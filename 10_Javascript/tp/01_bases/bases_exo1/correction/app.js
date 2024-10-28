
// DATA
var toto;
toto = [15,14,16,12,18];
// toto = [150,14,16,12,18];
// toto = [15,14,160,12,18];
// toto = ['15',14,16,12,18];
// toto = [15,14,'16',12,18];
// toto = [null,14,16,12,18];
// toto = [15,14,null,12,18];
// toto = [false,14,16,12,18];
// toto = [15,14,false,12,18];
// toto = [undefined,14,16,12,18];
// toto = [15,14,undefined,12,18];


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
      alert(`La note ${grades[i]} à l'emplacement ${i+1} n'est pas valable. Elle doit être numérique et comprise entre 0 et 20`);
      average = undefined;
      break;
    }

  }

  average = average / grades.length;
  return average;

}

console.log(gradeAverage(toto));