function ajouter() {
  //Code à écrire

  // on vérifie dans un premier temps que la fonction marche
  console.log('ok');

  // 1. on sélectionne l'élément qui a l'id liste
  const liste = document.getElementById('liste');
  // const liste = document.querySelector('#liste');
  console.log(liste);

  // 2. creer un element et lui affecter un texte
  const item = document.createElement('li');

  // on affecte du texte a l'élément que l'on vient de créer 
  item.innerText = 'texte suplémentaire';

  // 3. insérer l'élément item dans l'ul liste

  // peut ajouter seulement un noeud
  // liste.appendChild(item)

  // peut ajouter un noeud ou une chaine de caractères
  liste.append(item)

  // insére avant le premier enfant du parent donc ici avant <li>item 1</li>
  // liste.prepend(item)

}