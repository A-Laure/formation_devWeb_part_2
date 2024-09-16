<?php 

// Sert a rien ici pour l'exo 
// fonctionnement simple de recherche dans la navbar qui amenera au bonne endroit avec l'url personnalisé en fonction de la demande 

$_POST['search'] = 'Sophie';

foreach($_POST as $key => $value){
  if($key === 'search'){
    $getUrl = $key . '='.$value;
  }
}

if($_POST['filter'] == 'users'){

  header('Location: usersList.php?'. $getUrl);

}elseif($_POST['filter'] == 'posts'){

  header('Location: postsList.php?'. $getUrl);

}else{
  
  header('Location: searchResult.php?'. $getUrl);

}

