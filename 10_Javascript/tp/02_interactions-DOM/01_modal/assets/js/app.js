const btnOpen = document.getElementById('open')
const btnClose = document.getElementById('close')
const ctnModal = document.querySelector('.modal-container')

console.log(btnOpen)
console.log(ctnModal)

// btnOpen.addEventListener('click', function () {

//   // avec une class
//   ctnModal.classList.add('show')
//   // on injecte direct dans l'attribut html style
//   // ctnModal.style.visibility = 'visible'
  
// })

// methode avec fonction exterieur
// function showModal() {
//   ctnModal.classList.add('show')
// }
// btnOpen.addEventListener('click', showModal)


btnOpen.addEventListener('click', () => {
  ctnModal.classList.add('show')
})

btnClose.addEventListener('click', () => {
  ctnModal.classList.remove('show')
})

window.addEventListener('click', (e) => {

  if(e.target == ctnModal){
    ctnModal.classList.remove('show')
  }

})
