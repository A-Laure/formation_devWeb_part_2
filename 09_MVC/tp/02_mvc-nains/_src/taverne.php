<?php
  require_once 'config/config.php';
  include_once 'functions/helpers.php';


  $idUrl = needGET('id');

  # AFFICHAGE
  try{
    $sql = 'SELECT taverne.*, v_nom, (t_chambres - COUNT(n_id)) AS chambresLibres
            FROM taverne
            JOIN ville ON t_ville_fk = v_id
            LEFT JOIN groupe ON t_id = g_taverne_fk
            LEFT JOIN nain ON g_id = n_groupe_fk
            WHERE t_id = :idUrl';
    // les 2 dernieres jointure servent a recuperer les noms des villes de épart et d'arrvivée via les foreign key de la table tunnel qui correspondent a l'id d'un ville (v_id) ici on crée des alias (depart, arrivee) afin d'avoir du contexte et de nous facilité la tache (on a des reflexives), puis dans le select on viendra refaire un alias pour le nom des villes afin d'avoir des clés plus propre pour notre tableau associatif  
    $taverne = makeSelect($sql, ['idUrl'=> $idUrl]);

  }catch(PDOException $e){
    die($e->getMessage());
  }

  $taverne['t_blonde'] = 1;

  $beers = []; 
  $taverne['t_blonde'] ? $beers[] = 'blonde' : ''; 
  $taverne['t_brune'] ? $beers[] = 'brune' : '';
  $taverne['t_rousse'] ? $beers[] = 'rousse' : '';
  $last = array_pop($beers); 
  
  $page = 'Taverne ' . $taverne['t_nom'];
  require_once 'inc/head.php';
 
?>

<h1 class="title has-text-centered">Fiche de la taverne <?= $taverne['t_nom']?> </h1>

<div class="columns is-centered">

  <div class="column is-half">
    <div class="card">
      <header class="card-header">
          <p class="card-header-title"><?= $taverne['t_nom']?></p>
      </header>
      <div class="card-content">
        <div class="content">

          <p>Taverne se trouvant à <a href="ville.php?id=<?= $taverne['t_ville_fk']?>"> <?= $taverne['v_nom']?></a></p>

          <p>Nous possédons de la bière <?= count($beers) > 0 ? implode(', ', $beers) . ' et '. $last : $last; ?>.</p>

          <p>La taverne a <?= $taverne['t_chambres'] ?> chambres, dont <?= $taverne['chambresLibres'] ?> libres.</p>

        </div>
    </div>
    </div>

  </div>
</div>

<?php


  dump($taverne);

  require_once 'inc/foot.php';

?>