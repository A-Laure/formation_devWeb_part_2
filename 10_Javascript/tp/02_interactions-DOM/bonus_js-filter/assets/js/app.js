const students = [
  {
    name: 'John Doe',
    avatar: './assets/img/avatar_webuser.jpg',
    session: 'Designer Web',
    year: '2020'
  },

  {
    name: 'Jane Doe',
    avatar: './assets/img/avatar_webuser.jpg',
    session: 'Designer UI/UX',
    year: '2020'
  },
  {
    name: 'Toto Doe',
    avatar: './assets/img/avatar_webuser.jpg',
    session: 'Designer Web',
    year: '2019'
  },
  {
    name: 'Tata Doe',
    avatar: './assets/img/avatar_webuser.jpg',
    session: 'Developper Web',
    year: '2018'
  }
];


const studentsList = document.querySelector('.studentslist');

function displayStudents(students){

  if(students.length > 0){
    for( const student of students ){

      const studentCard = document.createElement('div');
      studentCard.classList ='col-3 my-3';

      studentCard.innerHTML = `
        <div class="card">
          <img src="${student.avatar}" class="card-img-top img-fluid" alt="...">
          <div class="card-body">
            <h5 class="card-title">${student.name}</h5>
            <p class="card-text">${student.session}</p>
            <p class="card-text">${student.year}</p>
            <a href="#" class="btn btn-primary">Voir profile</a>
          </div>
        </div>
      `;

      studentsList.appendChild(studentCard)

    }
  }else{

    studentsList.innerHTML = `<p class="lead my-5 mx-3">Désolé aucune correspondance pour cette combinaison</p>`

  }

  

}

displayStudents(students);

// const result = students.filter( student => (student.session === 'Designer Web'));
const result = students.filter( student => (student.session === 'Designer Web' && student.year === '2020'));

console.log(result);

const filterForm = document.querySelector('.filter');

filterForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const sessionSelect = document.getElementById('session');
  const yearSelect = document.getElementById('year');

  studentFilter(sessionSelect.value, yearSelect.value)

});


function studentFilter(session, year){

  studentsList.innerHTML = '';

  if(session === 'all' && year === 'all'){

    displayStudents(students)

  }else if(session === 'all'){

    let yearFilter = students.filter( student => student.year === year);
    displayStudents(yearFilter);
    
  }else if(year === 'all'){
    let sessionFilter = students.filter( student => student.session === session);
    displayStudents(sessionFilter);
  }else{

    let bothFilter = students.filter( student => (student.session === session && student.year === year));
    displayStudents(bothFilter);
  }

}


