<?php
  require_once 'config/config.php';
  include_once 'functions/helpers.php';


  $idUrl = needGET('id');

  # AFFICHAGE
  try{
    
    $ville = makeSelect('SELECT v_nom, v_superficie FROM ville WHERE v_id = :idUrl', ['idUrl'=> $idUrl]);
    $nains = makeSelect('SELECT n_id, n_nom FROM nain WHERE n_ville_fk = :idUrl ORDER BY n_nom', ['idUrl'=> $idUrl]);
    $tavernes = makeSelect('SELECT t_id, t_nom FROM taverne WHERE t_ville_fk = :idUrl ORDER BY t_nom', ['idUrl'=> $idUrl]);
    $tunnels = makeSelect('SELECT tunnel.*, depart.v_nom AS v_depart, arrivee.v_nom AS v_arrivee
                           FROM tunnel
                           JOIN ville AS depart ON t_villedepart_fk = depart.v_id
                           JOIN ville AS arrivee ON t_villearrivee_fk = arrivee.v_id
                           WHERE t_villedepart_fk = :idDepart 
                           OR t_villearrivee_fk = :idArrivee', ['idDepart'=> $idUrl, 'idArrivee'=> $idUrl,]);

  }catch(PDOException $e){
    die($e->getMessage());
  }


  
  $page = 'Ville ' . $ville['v_nom'];
  require_once 'inc/head.php';
 
?>

<h1 class="title has-text-left"> <?= $ville['v_nom']?>, <?= $ville['v_superficie']?> km² </h1>
  <div class="columns is-multiline">


  
    <div class="column is-4">
      <div class="card ">
        <header class="card-header">
          <p class="card-header-title">Habitants</p>
        </header>
        <div class="card-content">
          <div class="content">
          <?php foreach($nains as $nain): ?>
              <p><a href="nain.php?id=<?= $nain['n_id'] ?>"><?= $nain['n_nom'] ?></a></p>
            <?php endforeach;?>
          </div>

        </div>
      </div>
      <div class="card ">
        <header class="card-header">
          <p class="card-header-title">Tavernes locales</p>
        </header>
        <div class="card-content">
          <div class="content">
            <?php if(isset($tavernes[0]) && is_array($tavernes[0])): ?> 
            <?php foreach($tavernes as $taverne): ?>
              <p><a href="taverne.php?id=<?= $taverne['t_id'] ?>"><?= $taverne['t_nom'] ?></a></p>
            <?php endforeach;?>
            <?php else: ?>
              <p><a href="taverne.php?id=<?= $tavernes['t_id'] ?>"><?= $tavernes['t_nom'] ?></a></p>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </div>

    <div class="column ">
      <div class="card fullheight">
        <header class="card-header">
          <p class="card-header-title">Etat des tunnels</p>
        </header>
        <div class="card-content">
          <div class="content">
            
              <?php 

                foreach($tunnels as $tunnel){

                  if($idUrl == $tunnel['t_villedepart_fk']){
                    $idVille = $tunnel['t_villearrivee_fk'];
                    $nomVille = $tunnel['v_arrivee'];
                  }else{
                    $idVille = $tunnel['t_villedepart_fk'];
                    $nomVille = $tunnel['v_depart'];
                  }

                  if($tunnel['t_progres'] == 100){
                    $progres = '<span class="tag is-success">Ouvert</span>';
                  }else{
                    $progres = '<span class="tag is-warning">'. $tunnel['t_progres'] .'%</span>';
                  }

             

                  echo '<p>Tunnel vers <a href="ville.php?id='. $idVille . '"> '.$nomVille .'</a> : '. $progres .' </p> ';
                }


              ?>



            
          </div>

        </div>
      </div>
     
    </div>

  </div>

<?php


  dump($tavernes);

  require_once 'inc/foot.php';

?>