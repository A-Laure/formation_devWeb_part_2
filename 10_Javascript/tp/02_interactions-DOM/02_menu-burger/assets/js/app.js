const burger = document.getElementById('burger');
const body = document.body;
// selection de l'ancre 2 pour l'étape 1
const anchor2 = document.getElementById('s2')
// selection de tous les a du menu
const anchors = document.querySelectorAll('.menu li a')

console.log(anchors);
// console.log(anchors[0]);

for (let i = 0; i < anchors.length; i++) {
  
  console.log(anchors[i]);
  
}



// burger.addEventListener('click', () => {
//   // alert('click sur le burger')
//   // console.log(burger.classList)

//   // ajouter la class open
//   // burger.classList.add('open')
//   // supprimer la class open
//   // burger.classList.remove('open')

//   // on verifie si la classList contient open
//   // burger.classList.contains('open')
//   // ça nous renvoie true ou false

//   // if (burger.classList.contains('open')) {
//   //   burger.classList.remove('open')
//   // } else {
//   //   burger.classList.add('open')
//   // }

//   // permet d'ajouter ou supprimer la class open
//   burger.classList.toggle('open');

//   // ici le overflow : hidden ou la class no-scroll nous permet de ne plus avoir la scrollbar quand le menu est ouvert
//   // document.body.style.overflow = "hidden"
//   body.classList.toggle('no-scroll');

//   // on y va en étape 
//   // 1. on veut fermer le burger au click du lien 2
//   // anchor2.addEventListener('click', () => {
//   //   burger.classList.remove('open')
//   //   body.classList.remove('no-scroll');
//   // })

//   // 2. on veut automatiser le fait de cliquer sur n'importe quel lien du menu et de supprimer les class open et no-scroll

//   // on parcours le tableau des ancres (anchors) et on attribut a chaque tour a l'ancre en question un ecouteur d'évènement
//   for (let i = 0; i < anchors.length; i++) {
//     anchors[i].addEventListener('click', () => {
//       burger.classList.remove('open')
//       body.classList.remove('no-scroll');
//     })
//   }

// });


burger.addEventListener('click', () => {

  burger.classList.toggle('open');
  body.classList.toggle('no-scroll');

  for (let i = 0; i < anchors.length; i++) {
    anchors[i].addEventListener('click', () => {
      burger.classList.remove('open')
      body.classList.remove('no-scroll');
    })
  }

});
