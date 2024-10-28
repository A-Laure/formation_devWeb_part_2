const form = document.getElementById('addform');
const taskList = document.getElementById('tasklist');
const addInput = document.getElementById('addinput');

form.addEventListener('submit', addTask);
taskList.addEventListener('click', deleteTask);
taskList.addEventListener('click', completeTask);
taskList.addEventListener('click', editTask);



// Fonction : Ajouter une tâche
function addTask(e) {
  
  // on annule le comportement par default du formulaire
  e.preventDefault();

  if (addInput.value.trim() === '') {
    // on ajoute la class is-invalid ce qui affichera le message d'erreur contenu dans le HTML (small)
    addInput.classList.toggle('is-invalid');
  } else {

    // on enlève la class is-invalid pour ne pas qu'elle reste affiché si il y a eu une erreur avant
    addInput.classList.remove('is-invalid');

    const newTask = document.createElement('li');

    newTask.className = "d-inline-flex align-items-center p-3 mb-3 bg-white rounded shadow-sm";

    // console.log(addInput.value);
    // newTask.innerText = addInput.value;

    // on ajoute du HTML dans le li que l'on vient de créer (newTask) 
    // addInput.value est la valeur saisie par l'utilisateur
    newTask.innerHTML = `
    <input type="checkbox" class="mr-3 check">
    <label for="" class="m-0">${addInput.value}</label>
    <div class="ml-auto">
      <i class="fa fa-edit mx-3 edit"></i>
      <i class="fa fa-trash text-danger delete"></i>
    </div>
  `;

    // on ajoute le li dans l'ul
    taskList.appendChild(newTask);

    addInput.value = '';

  }
}


// Fonction : Supprimer une tâche
function deleteTask(e) {

  // e.target = élément sur lequel on a cliqué => ici l'icon trash
  // console.log(e.target);

  // on vient verifier que l'élément sur lequel on a cliqué contient bien la class delete
  if(e.target.classList.contains('delete')){

    // console.log('click sur delete');

    if(confirm('Voulez vous vraiment supprimer cette tâche ?')){

      // console.log(e.target.parentElement.parentElement);

      // on récupère le li de l'icon trash sur lequel nous avons cliqué (on remonte 2 fois car il est contenu dans une div puis dans le li)
      const li = e.target.parentElement.parentElement;

      // on supprime le li ciblé
      li.remove();

    }
  }
}


// Fonction : Completer une tâche
function completeTask(e) {
  if (e.target.classList.contains('check')) {
    
    // e.target = élément sur lequel on a cliqué => ici la checkbox
    const checkboxBtn = e.target;

    // const li = e.target.parentElement;
    const li = checkboxBtn.parentElement;

    li.classList.toggle('completed');

  }
}


// Fonction : Modifier une tâche
function editTask(e) {
  
  if (e.target.classList.contains('edit')) {
    
    // on selectionne le li parent
    const li = e.target.parentElement.parentElement;
    // on selectionne le label
    const label = li.querySelector('label');

    // on créé l'élément input 
    const editInput = document.createElement('input');

    // on stocke le texte contenu dans le label 
    let textLabel = label.innerText;
    // on défini la value de l'input pour qu'elle soit égale au texte du label
    editInput.value = textLabel;
    editInput.type = 'text';

    // on insert l'input avant le label
    li.insertBefore(editInput, label);
    // on supprime le label
    label.remove();
    // on ajoute le focus sur le label
    editInput.focus();

    
    
    document.addEventListener('keyup', (e) => {

      // si la touche entée (code 13) est pressée
      if(e.keyCode === 13){

        // on insert le label avant  l'input
        li.insertBefore(label, editInput);
        // on stocke le texte contenu dans le input 
        let textInput = editInput.value;
        // on défini le texte du label pour qu'elle soit égale a la value de l'input
        label.innerText = textInput;
        // on supprime l'input
        editInput.remove();
      }
    });

  }

}