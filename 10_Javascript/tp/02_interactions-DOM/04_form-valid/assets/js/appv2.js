/*

Version améliorée


Etapes : 

  1. Sélectionner les input et le form
  2. addEventListener sur le form
  3. On vérifie que chaque champs soit bien remplie ( 

    si champs vide :
        on affiche un message d'erreur + border rouge donc ajout de la class error
    sinon 
        succes donc ajout de la class success
  )

  4. Vérification syntaxe email (on le fait ensemble)




Bonus : 

  * Possibilité de voir le mot de passe 

*/


const form = document.querySelector('#form');
const username = document.querySelector('#username');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const password2 = document.querySelector('#password2');

const icon = document.querySelector('#icon');

// Gestion error => border rouge sur le champ + affichage message d'erreur
function showError(input, message) {

  input.parentElement.className = 'form-group error';
  const small = input.parentElement.querySelector('small')
  small.innerText = message
}

// Gestion le success => border vert sur le champ
function showSuccess(input) {
  input.parentElement.className = 'form-group success';
}

// Vérification compliqué avec une expression réguliere (regex) 
function checkEmail(email) {

  const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  if(regex.test(email.value.trim())){
    showSuccess(email)
  }else{
    showError(email, 'L\'email n\'est pas valid');
  }

}


// Verification des champs requis
function checkRequired(inputArr) {
  // on parcours le tableau des champs requis
  for (const input of inputArr) {
    // trim() permet de montrer le message d'erreur meme si l'utilisateur a mis un espace tout seul dans le champ
    if (input.value.trim() === '') {
      showError(input, 'Ce champs est requis')
    } else {
      showSuccess(input)
    }
  }

}

// Verification de la longueur d'une saisie
// function checkLength(input) {
//   if (input.value.length < 3) {

//     showError(input, 'trop petit');

//   } else if (input.value.length > 15) {

//     showError(input, 'trop long');

//   } else {
//     showSuccess(input);
//   }
// }
function checkLength(input, min, max) {
  if (input.value.length < min) {

    // showError(input, 'trop petit');
    showError(input, `${input.id === 'password' ? 'Votre mot de passe' : 'Votre nom ' } doit comporter au moins ${min} caractères`);

    // if(input.id === 'password'){

    //   const message = `Votre mot de passe doit comporter au moins ${min} caractères`;

    // }else{
    //   const message = `Votre nom doit comporter au moins ${min} caractères`;
    // }

    // showError(input, message);

  } else if (input.value.length > max) {

    showError(input, `${input.id === 'password' ? 'Votre mot de passe' : 'Votre nom '} doit comporter pas plus ${max} caractères`);


  } else {
    showSuccess(input);
  }
}

function checkPasswords(input1, input2){

  if( input1.value !== input2.value){
    showError(input2, 'Vos mots de passes ne sont pas identiques')
  }

}

function checkPassword(input) {
  // doit contenir au moins : 1chiffre, 1minuscule, 1majuscule et compris entre 8 et 32 caracteres
  const regex = /^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,32})/;

  // doit contenir au moins : 1chiffre, 1minuscule, 1majuscule, 1 caractere spécial en en excluant certain et compris entre 8 et 32 caracteres
  var strongRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,32}$/;

  if (strongRegex.test(input.value.trim())) {
    showSuccess(input)
  } else {
    showError(input, 'Le mdp n\'est pas valid');
  }

}


form.addEventListener('submit', (e) => {

  e.preventDefault();


  const inputsRequired = [username, email, password, password2];
  // on automatise la verification des champ requis pour ne pas avoir plein de  if else 
  checkRequired(inputsRequired);
  // checkLength(username)
  checkLength(username, 3, 15);
  // checkLength(password, 8, 25);
  checkEmail(email);
  // checkPasswords(password, password2)
  checkPassword(password)

})




// Affichage ou non du mot de passe 
function showPassword() {

  if (password.type === 'password') {
    password.type = 'text'
    icon.className = 'fas fa-eye-slash'
    password.focus()
  } else {
    password.type = 'password'
    icon.className = 'fas fa-eye'
    password.focus()
  }
}

icon.addEventListener('click', showPassword)



// creer function qui permet de vérifier la longueur du texte récuperer du champ username et de verifier si la longueur est comprise entre 3 et 15 caracteres


// 1. partie fonctionnel (pas de fonction ni de donnéés récuperer, seulement if else et de la donnée brut)

// const mot1 = 'oo';
// const mot2 = 'Joe';
// const mot3 = 'fzfffffffffffffff';

// // console.log(mot2.length);


// function checkLength(mot) {
//   if (mot.length < 3) {

//     console.log('trop petit');

//   } else if (mot.length > 15) {

//     console.log('trop long');

//   } else {
//     console.log('ok');
//   }
// }



// checkLength(mot1);
// checkLength(mot2);
// checkLength(mot3);


// if(mot3.length < 3){

//   console.log('trop petit');

// } else if (mot3.length > 15){

//   console.log('trop long');

// }else{
//   console.log('ok');
// }


