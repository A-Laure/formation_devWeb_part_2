function changeList() {
  // selection du ul
  const ul = document.querySelector('ul');
  console.log(ul);

  // changement du style des puces
  // ul.setAttribute('type', 'disk');
  ul.style.listStyleType = 'square';

  // selection de tous les li, on récupère un tableau
  const items = document.querySelectorAll('li');
  console.log(items);

  // vu que items est un tableau on peut affiché un li en particulier
  console.log(items[0]);

  for (let i = 0; i < items.length; i++) {
    console.log(items[i]);

    // on change pour chaque li son contenu par blabla
    items[i].textContent = 'blabla';
    items[i].textContent = `blabla ${i + 1}`;

    // on utilise innerHTML si on veut rajouter du html dans le li
    // items[i].innerHTML = '<a href="#">blabla</a>';

    // on ajoute l'attribut onclick et la fonction alert avec le numero de l'item
    items[i].setAttribute('onclick', 'alert("Bonjour item ' + (i + 1) + '")');

    // on ajoute l'attribut onclick et la fonction alert on affiche le contenu texte de l'élément sur lequel on a cliqué
    // items[i].setAttribute('onclick', 'alert(this.textContent)');
  }
}
