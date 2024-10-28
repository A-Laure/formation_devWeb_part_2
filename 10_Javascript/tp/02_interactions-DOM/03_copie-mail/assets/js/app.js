const mail = document.querySelector('.mail')

mail.addEventListener('click', mailCopy)


// la fonction permet de copié l'adress mail au moment ou il clique sur le bouton
function mailCopy(e){

  e.preventDefault();

  const emailAdress = 'contact@objectif3w.com'

  // on ajoute un input dans le body afin de pouvoir recuperer l'adresse mail sans la laissé dans le html pour pas que les robots l'utilise
  const input = document.createElement('input')
  input.setAttribute('value', emailAdress)
  document.body.appendChild(input)
  // selectionne le text dans l'input 
  input.select()
  // execute un ctrl+c
  document.execCommand('copy')

  document.body.removeChild(input)

  mail.classList.add('copied')

  // permet de retirer la class copied 1.5 sec après avoir cliquer
  setTimeout(() => {
    mail.classList.remove('copied')
  }, 1500);

}