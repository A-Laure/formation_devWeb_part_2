function ajouter() {
  const liste = document.getElementById('liste');

  const input = document.getElementById('item');

  console.log(input);
  console.log(input.value);

  // on vérifie que input.value contient bien une valeur avant de l'ajouter dans l'ul
  if (input.value) {
    const li = document.createElement('li');

    // input.value nous donne acces au contenu de l'attribut value et correspond a la saisie de l'utilisateur via l'input
    li.innerText = input.value;

    //3.
    // li.setAttribute('onclick', 'deleteItem(this)');
    li.setAttribute('onclick', 'superDelete(this)');

    liste.append(li);

    // bonus : on remet à zero ou on redefinie la valeur de value
    input.value = "";

    input.style.borderColor = "initial";

  }else {

    // input.classList.add('error');
    input.style.borderColor = "red";
    
    alert('Veuillez saisir quelque chose');

  }

  // autre methode
  // if (input.value !== ""){

  //   const li = document.createElement('li');

  //   // input.value nous donne acces au contenu de l'attribut value et correspond a la saisie de l'utilisateur via l'input
  //   li.innerText = input.value;

  //   liste.append(li)

  // }
}

function supprimer() {
  const liste = document.getElementById('liste');

  console.log(liste);

  // on recupere le dernier enfant du conteneur
  console.log(liste.lastElementChild);

  // on supprime le dernier enfant du conteneur
  liste.lastElementChild.remove();
  // liste.removeChild(liste.lastElementChild);
}

// let monElement = 'toto'

// let elmnt2 = monElement;
//   console.log(elmnt2)


function deleteItem(elementThis) {
  console.log(elementThis);

  elementThis.remove();
}


// on réuni les 2 fonctions de suppression du dessus
function superDelete(elementThis = undefined) {
  

  const liste = document.getElementById('liste');

  console.log(liste.children);

  // if (elementThis) {
    
  //   elementThis.remove();

  // } else {
    
  //   liste.lastElementChild.remove();

  // }

  // bonus
  if (elementThis) {
    
    elementThis.remove();

  } else if(liste.children.length > 0) { // on verifie qu'il y a des li dans l'ul

    liste.lastElementChild.remove();

  } else {
    
    alert('Il n\'y plus rien à supprimer')

  }

}