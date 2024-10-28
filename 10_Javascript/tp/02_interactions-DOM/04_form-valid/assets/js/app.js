/*

Version simplifiée


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



// 1. Sélectionner les input et le form
const form = document.querySelector('#form')
const username = document.querySelector('#username')
const email = document.querySelector('#email')
const password = document.querySelector('#password')
const password2 = document.querySelector('#password2')

const icon = document.querySelector('#icon')

// console.log(form)

// 2. addEventListener sur le form
// form.addEventListener('submit', function(e){

// })

function showError(input, message) {

  input.parentElement.className = 'form-group error';
  // on selectionne le small du parent de l'input donc la div
  const small = input.parentElement.querySelector('small')
  // on injecte dans le small le message passé en parametre de la fonction
  small.innerText = message
}


function showSuccess(input) {
  // on remplace les class de la div par 
  input.parentElement.className = 'form-group success';

  // const formGroup = input.parentElement
  // formGroup.className = 'form-group success';
}

// Vérification compliqué avec une expression réguliere (regex) 
function isValidEmail(email) {
  
  const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  return regex.test(String(email).toLowerCase())

}



// version simplifié pour l'écriture de la fonction : fonction fléchée
form.addEventListener('submit', (e) => {

  // Empeche le comportement par défault donc ça empeche la redirection vers le send.php
  e.preventDefault()

  // console.log(e.target)

  // alert('Formulaire soumis')

  // 3. On vérifie que chaque champs soit bien remplie
  console.log(username.value)

  if(username.value === ''){
    // alert('attention champ vide')
    // on cible la div parent
    // username.parentElement.classList.add('error')

    showError(username, 'Votre nom est requis')
    // showError(input, message)
    // input que tu veux ciblé et message que tu veux écrire dans small

  } else{

    // on automatise la gestion du succes
    showSuccess(username)
    // email.parentElement.classList.add('success')
  }


  if(email.value === ''){
 
    showError(email, 'Votre email est requis')

  } else if(!isValidEmail(email.value)){
    showError(email, 'Votre email n\'est pas valide')
  }
  else{

    showSuccess(email)
  }

  if(password.value === ''){
 
    showError(password, 'Votre password est requis')

  } else{

    showSuccess(password)
  }

  if(password2.value === ''){
 
    showError(password2, 'Votre password2 est requis')

  } else{

    showSuccess(password2)
  }

})



// Affichage ou non du mot de passe 
function showPassword() {

  if(password.type === 'password'){
    password.type = 'text'
    icon.className = 'fas fa-eye-slash'
    // sert à récupérer le focus/saisie active sur le champ
    password.focus()
  } else {
    password.type = 'password'
    icon.className = 'fas fa-eye'
    password.focus()
  }
}

icon.addEventListener('click', showPassword)